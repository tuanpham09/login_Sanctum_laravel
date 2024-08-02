<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPhishing;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function sendEmails(Request $request)
    {

        $request->validate([
            'language' => 'string',
            'file' => 'required|file|mimes:csv,xlsx',
        ]);

        $language = $request->input('language');
        $file = $request->file('file');
        $emails = Excel::toArray(new ExcelImportController(), $file);
        $emails = $emails[0];
        $emails = array_slice($emails, 2);


        $template = $this->getTemplateForLanguage($language);

        $filteredData = array_filter($emails, function($array) {
            return !empty(array_filter($array, function($value) {
                return !is_null($value);
            }));
        });


        $totalEmails = count($filteredData);
        setcookie('email_progress', 0, time() + 3600, "/");
        set_time_limit(3600);
        $id_email = "";
        try {
            foreach ($filteredData as $index => $emailData) {
                if (isset($emailData[2])){
                    $email = $emailData[2];
                    $details = [
                        'last_name' => $emailData[1],
                        'template' => $template,
                        'email' => $email
                    ];


//            Mail::to($email)  // To recipient
//            ->cc('')  // CC recipient
//            ->bcc($email) // BCC recipient
//            ->send(new MailPhishing($details));
                    $id_email = $index + 1;

                    Mail::to($email)->send(new MailPhishing($details));

                    $progress = round((($index + 1) / $totalEmails) * 100);
                    setcookie('email_progress', $progress, time() + 3600, "/");

                    Log::error($progress);

                }


            }
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'fail',
                'email_fail' => $id_email,
                'message_fail' => $e->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'success',
            'total_email' => $totalEmails
        ]);
    }

    private function getTemplateForLanguage($language)
    {
        switch ($language) {
            case 'fr':
                return 'mail.mail-phishing_fr';
            case 'de':
                return 'mail.mail-phishing_de';
            case 'es':
                return 'mail.mail-phishing_es';
            case 'en':
            default:
                return 'mail.mail-phishing_en';
        }
    }

    public function getEmailProgress()
    {
        $progress = isset($_COOKIE['email_progress']) ? $_COOKIE['email_progress'] : 0;
        return response()->json(['progress' => $progress]);
    }
}
