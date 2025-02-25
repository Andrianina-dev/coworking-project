<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réservation Annulée</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styles pour le corps de la page */
        body {
            font-family: 'Inter', sans-serif; /* Police moderne */
            background-color: #f8f9fa; /* Fond gris clair */
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Titre principal */
        h1 {
            font-size: 32px; /* Taille de police augmentée */
            font-weight: 700;
            color: #dc3545; /* Rouge pour indiquer une annulation */
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: #dc3545; /* Ligne rouge sous le titre */
            margin: 10px auto 0;
            border-radius: 2px;
        }

        /* Bouton de retour (optionnel) */
        .btn-return {
            padding: 10px 20px;
            background-color: #6c757d; /* Gris pour le bouton */
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-return:hover {
            background-color: #5a6268; /* Gris plus foncé au survol */
            transform: translateY(-2px); /* Légère élévation */
        }

        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 24px; /* Taille de police réduite pour les petits écrans */
            }

            .btn-return {
                font-size: 12px;
                padding: 8px 16px;
            }
        }
    </style>
    <!-- Lien vers la police Inter (optionnel) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Réservation Annulée</h1>
    <!-- Bouton de retour (optionnel) -->
    <a href="{{url('afficheEspaceTravail')}}" class="btn-return">Retour à l'accueil</a>
</body>
</html>
