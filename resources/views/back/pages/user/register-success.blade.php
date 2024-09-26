<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Réussie</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #d7a8ff, #a6f1d9f);
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reg-success {
            text-align: center;
            padding: 2rem;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
        }

        .reg-success h1 {
            font-size: 2.5em;
            color: #4caf50;
            margin: 0;
            margin-bottom: 1rem;
        }

        .reg-success p {
            font-size: 1.1em;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .button-link {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1.1em;
            text-align: center;
            color: #ffffff;
            background: #007bff;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .button-link:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        .button-link:active {
            background-color: #004080;
            transform: scale(0.98);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .reg-success span {
            display: block;
            font-size: 4em;
            color: #4caf50;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="reg-success">
        <span>&#10003;</span> <!-- Checkmark symbol -->
        <h1>Inscription Réussie !</h1>
        <p>Nous avons envoyé un lien d'activation à votre adresse e-mail. Veuillez consulter votre boîte de réception et cliquer sur le lien pour confirmer l'activation de votre compte.</p>
        <a href="{{ route('user.login') }}" class="button-link">Accédez à votre compte</a>
    </div>
</body>
</html>
