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
            max-width: 800px;
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
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .user::before {
            content: "💁 ";
            margin-right: 5px;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
        }
        .item-details::before {
            content: "🍽️ ";
            margin-right: 5px;
        }

        .item-details span {
            display: inline-block;
        }
       

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🍽️ Nuovo Pagamento Ricevuto</h1>
        <p>Gentile {{ $restaurant_name }},</p>
        <p>L'utente <strong>{{ $name }} {{ $surname }}</strong> ha effettuato un acquisto.</p>
        <p>Dettagli dell'ordine:</p>
        <div class="order-details">
            <ul class="user">
                <li><strong>Nome:</strong> {{ $name }}</li>
                <li><strong>Cognome:</strong> {{ $surname }}</li>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Telefono:</strong> {{ $phone }}</li>
                <li><strong>Indirizzo:</strong> {{ $address }}</li>
                <li><strong>Importo Speso:</strong> {{ $amount }} €</li>
                <li><strong>ID Transazione:</strong> {{ $transactionId }}</li>
            </ul>
            <h2>🍲 Dettagli dei Piatti Ordinati:</h2>
            <ul>
                @foreach ($cart as $item)
                <li>
                    <div class="item-details">
                        <span>{{ $item['product']['name'] }} - {{ $item['quantity'] }} x {{ $item['product']['price'] }} €</span>
                        <span>Totale: {{ number_format($item['quantity'] * $item['product']['price'], 2) }} €</span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <p>Grazie per la vostra attenzione.</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Munchi 🍪. Tutti i diritti riservati.</p>
        </div>
    </div>
</body>

</html>
