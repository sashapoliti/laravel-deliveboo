<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>🍽️ Nuovo Pagamento Ricevuto</title>
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

        .order-details {
            margin-top: 20px;
        }

        .order-details ul {
            list-style-type: none;
            padding: 0;
        }

        .order-details li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🍽️ Nuovo Pagamento Ricevuto{{ $restaurant_name }}</h1>
        <p>Gentile Ristorante,</p>
        <p>L'utente <strong>{{ $name }} {{ $surname }}</strong> ha effettuato un acquisto.</p>
        <p>Dettagli dell'ordine:</p>
        <div class="order-details">
            <ul>
                <li><strong>Nome:</strong> {{ $name }}</li>
                <li><strong>Cognome:</strong> {{ $surname }}</li>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Telefono:</strong> {{ $phone }}</li>
                <li><strong>Indirizzo:</strong> {{ $address }}</li>
                <li><strong>Importo Speso:</strong> {{ $amount }} €</li>
                <li><strong>ID Transazione:</strong> {{ $transactionId }}</li>
            </ul>
            <h2>🍲 Dettagli dei Piatti Ordinati:</h2>
            @foreach ($cart as $item)
                <li>{{ $item['product']['name'] }} - {{ $item['quantity'] }} x {{ $item['product']['price'] }} €</li>
            @endforeach
        </div>
        <p>Grazie per la vostra attenzione.</p>
    </div>
</body>

</html>
