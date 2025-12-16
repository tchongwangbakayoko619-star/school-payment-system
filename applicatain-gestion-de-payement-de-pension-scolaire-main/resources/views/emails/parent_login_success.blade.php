<!-- resources/views/emails/parent_login_success.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Successful</h1>
        <p>Hello,</p>
        <p>Your login was successful.</p>
        <p>You can access your homepage by clicking the following link:</p>
        <p><a href="{{ $homePageLink }}">{{ $homePageLink }}</a></p>
        <p>Thank you for using our platform.</p>
        <div class="footer">
            <p>Admin SchoolLife</p>
            <p>If you have any questions, please contact us at <a href="nathanbakayoko237999999999@gmail.com">nathanbakayoko237999999999@gmail.com</a>.</p>
        </div>
    </div>
</body>
</html>
