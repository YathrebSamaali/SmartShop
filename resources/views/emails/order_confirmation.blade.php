<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de commande</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Merci pour votre commande !</h1>
        </div>

        <div class="content">
            <p>Bonjour {{ $order->customer_first_name }},</p>

            <p>Votre commande <strong>#{{ $order->order_number }}</strong> a bien été enregistrée.</p>

            <h3>Détails de la commande :</h3>
            <ul>
                <li>Date : {{ $order->created_at->format('d/m/Y H:i') }}</li>
                <li>Total : {{ number_format($order->total, 2) }} DT</li>
                <li>Mode de livraison : {{ $order->delivery_method === 'express' ? 'Express' : 'Standard' }}</li>
            </ul>

            <p>Vous pouvez suivre l'état de votre commande en vous connectant à votre compte.</p>
        </div>

        <div class="footer">
            <p>Cordialement,<br>L'équipe de SmartShop</p>
            <p><small>Si vous n'êtes pas à l'origine de cette commande, veuillez nous contacter.</small></p>
        </div>
    </div>
</body>
</html>
