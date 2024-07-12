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
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #ffb061;
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

        .item-details {
            display: flex;
            justify-content: space-between;
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
        <h1>Grazie per il tuo acquisto, {{ $name }} {{ $surname }}! 🎉</h1>
        <p>Abbiamo ricevuto il tuo pagamento di <span class="bold">€{{ number_format($amount, 2) }} 💳</span>.</p>
        <p>La tua email è <span class="bold">{{ $email }}</span>.</p>
        <p>Il tuo numero di telefono è <span class="bold">{{ $phone }}</span>.</p>
        <p>Il tuo indirizzo di spedizione è <span class="bold">{{ $address }}</span>.</p>
        <p>ID Transazione: <span class="bold">{{ $transactionId }}</span></p>
        
        <div class="order-details">
            <h2>🍽️ Dettagli dell'Ordine</h2>
            <p>Hai ordinato da: <span class="bold">{{ $restaurant_name }}</span></p>
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

        <div class="footer">
            <p>&copy; {{ date('Y') }} Munchi 🍪. Tutti i diritti riservati.</p>
        </div>
    </div>
</body>
</html>

