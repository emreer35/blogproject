<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bize Ulaşın Mesajı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            color: #0056b3;
        }

        p {
            margin: 10px 0;
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
        <h1>İletişim Formu Mesajı</h1>
        <p><strong>Ad:</strong> {{ $name }}</p>
        <p><strong>E-posta:</strong> {{ $email }}</p>
        <p><strong>Mesaj:</strong></p>
        <p>{{ $content }}</p>
        <div class="footer">
            <p>Bu mesaj, web sitenizin iletişim formu üzerinden gönderilmiştir.</p>
        </div>
    </div>
</body>

</html>
