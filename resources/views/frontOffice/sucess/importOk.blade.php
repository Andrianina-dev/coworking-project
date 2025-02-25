{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Import reussi....</h1>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import Réussi</title>
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
        .success-container {
            max-width: 500px; /* Largeur maximale */
            width: 100%;
            padding: 30px; /* Padding généreux */
            background-color: #fff;
            border-radius: 12px; /* Bordures arrondies */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombre légère */
            text-align: center;
            animation: fadeIn 0.5s ease; /* Animation d'apparition */
        }

        .success-container h1 {
            font-size: 28px; /* Taille de police */
            font-weight: 700;
            color: #4F46E5; /* Bleu moderne */
            margin-bottom: 20px; /* Espace sous le titre */
        }

        .success-container p {
            font-size: 16px; /* Taille de police */
            color: #6b7280; /* Gris foncé */
            margin-bottom: 20px; /* Espace sous le texte */
        }

        .success-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4F46E5;
            color: #fff;
            text-decoration: none;
            border-radius: 6px; /* Bordures arrondies */
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .success-container a:hover {
            background-color: #4338CA; /* Bleu plus foncé au survol */
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
    <div class="success-container">
        <h1>Import Réussi !</h1>
        <p>Votre fichier a été importé avec succès.</p>
        <a href="{{url('lesImportations')}}">Retour à l'import</a>
    </div>
</body>
</html>
