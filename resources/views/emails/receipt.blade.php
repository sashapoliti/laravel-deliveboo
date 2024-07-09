<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>🧾 Ricevuta di Pagamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007BFF;
        }
        p {
            font-size: 1.1em;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Grazie per il tuo acquisto, {{ $name }} {{ $surname }}! 🎉</h1>
        <p>Abbiamo ricevuto il tuo pagamento di <span class="bold">€{{ number_format($amount, 2) }} 💳</span>.</p>
        <p>La tua email è <span class="bold">{{ $email }}</span>.</p>
        <p>Il tuo numero di telefono è <span class="bold">{{ $phone }}</span>.</p>
        <p>Il tuo indirizzo di spedizione è <span class="bold">{{ $address }}</span>.</p>
        <p>ID Transazione: <span class="bold">{{ $transactionId }}</span></p>
    </div>
</body>
</html>
