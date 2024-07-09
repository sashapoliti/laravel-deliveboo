<!DOCTYPE html>
<html>
<head>
    <title>Nuovo Pagamento Ricevuto</title>
</head>
<body>
    <h1>Nuovo Pagamento Ricevuto</h1>
    <p>Gentile Ristorante,</p>
    <p>L'utente <strong>{{ $name }} {{ $surname }}</strong> ha effettuato un acquisto.</p>
    <p>Dettagli dell'ordine:</p>
    <ul>
        <li>Nome: {{ $name }}</li>
        <li>Cognome: {{ $surname }}</li>
        <li>Email: {{ $email }}</li>
        <li>Telefono: {{ $phone }}</li>
        <li>Indirizzo: {{ $address }}</li>
        <li>Importo Speso: {{ $amount }} €</li>
        <li>ID Transazione: {{ $transactionId }}</li>
    </ul>
    <p>Grazie per la vostra attenzione.</p>
</body>
</html>
