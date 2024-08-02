<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="container mt-5">
    <h2>Email Sending Progress</h2>
    <div class="progress">
        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <p id="progress-text">0%</p>
</div>

<form id="emailForm" enctype="multipart/form-data">
    @csrf
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-[75vh] flex items-center justify-center">
        <div class="gap-5 flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="flex gap-3">
                <div class="flex items-center">
                    <input type="file" class="file-input w-full max-w-xs" name="file" id="file" accept=".csv, .xlsx" required/>
                </div>

                <select class="form-select min-w-24" name="language" id="language" required disabled>
                    <option selected disabled>Chọn ngôn ngữ</option>
                    <option value="en">Anh</option>
                    <option value="fr">Pháp</option>
                    <option value="es">Tây Ban Nha</option>
                    <option value="de">Đức</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary">Send Emails</button>
                <a class="btn btn-warning">Hủy Bỏ</a>
            </div>
        </div>
    </div>
</form>

</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('button[type="submit"]').addEventListener('click', function (event) {
            event.preventDefault();

            let formData = new FormData();
            let fileInput = document.getElementById('file');
            let languageSelect = document.getElementById('language');

            formData.append('file', fileInput.files[0]);
            formData.append('language', languageSelect.value);

            fetch('http://localhost:8000/api/send-emails', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    if (data.status === 'success') {
                        alert('Emails sent successfully!');
                    } else {
                        const progressBar = document.getElementById('progress-bar');
                        const progressText = document.getElementById('progress-text');
                        progressBar.style.width = '100%';
                        progressText.textContent = '100%';
                        alert('Failed to send emails. Error at email index: ' + data.email_fail);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    $(document).ready(function (){
        function getProgress(){

        }
    })
</script>