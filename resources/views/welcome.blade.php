<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<form action="{{ route('send.emails') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-[75vh] flex items-center justify-center">
        <div class="gap-5 flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="flex gap-3">
                <div class="flex items-center">
                    <input type="file" class="file-input w-full max-w-xs" name="file" id="file" accept=".csv, .xlsx" required/>
                </div>

                <select class="form-select min-w-24" disabled name="language" id="language">
                    <option selected disabled>Chọn ngôn ngữ</option>
                    <option value="en">Anh</option>
                    <option value="fr" disabled>Pháp</option>
                    <option value="3" disabled>Hàn</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit">Send Emails</button>
                <a class="btn btn-warning">Hủy Bỏ</a>
            </div>
        </div>
    </div>
</form>

</body>

</html>
