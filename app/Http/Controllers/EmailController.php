<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPhishing;
use Maatwebsite\Excel\Facades\Excel;

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


        foreach ($emails as $emailData) {
            $email = $emailData[2];
            $details = [
                'last_name' => $emailData[1],
                'template' => $template,
                'email' => $email
            ];

            Mail::to($email)  // To recipient
            ->cc('')  // CC recipient
            ->bcc($email) // BCC recipient
            ->send(new MailPhishing($details));
        }

        return back()->with('success', 'Emails sent successfully!');
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
}
