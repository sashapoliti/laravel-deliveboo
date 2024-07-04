<!DOCTYPE html>
<html>
<head>
    <title>🧾 Ricevuta di Pagamento</title>
</head>
<body>
    <h1>Grazie per il tuo acquisto, {{ $name }} {{ $surname }}! 🎉</h1>
    <p>Abbiamo ricevuto il tuo pagamento di €{{ number_format($amount, 2) }}. 💳</p>
    <p>ID Transazione: {{ $transactionId }}</p>
</body>
</html>
