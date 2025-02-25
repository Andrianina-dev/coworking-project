<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Succès</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        body {
            font-family: 'Race Sport';
            background-color: #ffebee; /* Doux rose pastel */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px; /* Plus arrondi */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Ombre plus douce */
            text-align: center;
            width: 80%;
            max-width: 500px;
        }

        h1 {
            color: #f06292; /* Rose vif */
            margin-bottom: 20px;
            font-size: 2.5em;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        a {
            background-color: #a7c0cd; /* Bleu grisâtre doux */
            color: white;
            padding: 15px 30px; /* Bouton plus grand */
            border: none;
            border-radius: 30px; /* Forme encore plus arrondie */
            text-decoration: none;
            margin-top: 30px;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        a:hover {
            background-color: #78909c; /* Bleu grisâtre plus foncé au survol */
            transform: scale(1.05); /* Léger effet de zoom */
        }

        /* Using CSS to create a checkmark */
        .success-icon {
          position: relative;
          margin: 20px auto;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          background-color: #a5d6a7; /* Light green */
        }

        .success-icon::after {
          content: '';
          position: absolute;
          top: 50%;
          left: 20%;
          transform: translate(-50%, -50%) rotate(45deg);
          width: 20px;
          height: 35px;
          border-bottom: 5px solid white;
          border-right: 5px solid white;
        }

        /* Stars using Unicode characters */
        .stars {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 2em;
            color: #ffca28; /* Yellow */
        }

        /* Hearts using Unicode characters */
        .hearts {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 2em;
            color: #e91e63; /* Pink */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="stars">✨</div>
        <div class="hearts">💖</div>
        <div class="success-icon"></div>
        <h1>Les données sont insérées avec succès !</h1>
        <a href="{{ url('afficheEspaceTravail') }}">Espace de travail</a>
    </div>
</body>
</html>
