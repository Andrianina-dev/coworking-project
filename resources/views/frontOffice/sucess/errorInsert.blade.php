<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur d'insertion</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif; /* Police moderne */
            background-color: #f8f9fa; /* Gris très clair */
            color: #333;
            line-height: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            padding: 20px; /* Espace autour du contenu */
        }

        /* Conteneur principal */
        .error-container {
            max-width: 500px; /* Largeur maximale */
            width: 100%;
            padding: 30px; /* Padding généreux */
            background-color: #fff;
            border-radius: 12px; /* Bordures arrondies */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombre légère */
            text-align: center;
            animation: fadeIn 0.5s ease; /* Animation d'apparition */
        }

        .error-container h1 {
            font-size: 28px; /* Taille de police */
            font-weight: 700;
            color: #dc3545; /* Rouge pour indiquer une erreur */
            margin-bottom: 20px; /* Espace sous le titre */
        }

        .error-container p {
            font-size: 16px; /* Taille de police */
            color: #6b7280; /* Gris foncé */
            margin-bottom: 20px; /* Espace sous le texte */
        }

        .error-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545; /* Rouge pour correspondre au thème */
            color: #fff;
            text-decoration: none;
            border-radius: 6px; /* Bordures arrondies */
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .error-container a:hover {
            background-color: #c82333; /* Rouge plus foncé au survol */
            transform: translateY(-2px); /* Légère élévation */
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <!-- Lien vers la police Inter (optionnel) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="error-container">
        <h1>Erreur d'insertion</h1>
        <p>Une erreur s'est produite lors de l'insertion des données. Veuillez réessayer.</p>
        <a href="{{url('lesImportations')}}">Retour à l'import</a>
    </div>
</body>
</html>
