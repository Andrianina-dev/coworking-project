{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Verfiez, votre base de donnee n'est pas encore effacee</h1>
</body>
</html> --}}
@extends('baseTemplate.DashClientbase')
@section('contentDaschClient')
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
        .warning-container {
            max-width: 500px; /* Largeur maximale */
            width: 100%;
            padding: 30px; /* Padding généreux */
            background-color: #fff;
            border-radius: 12px; /* Bordures arrondies */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombre légère */
            text-align: center;
            animation: fadeIn 0.5s ease; /* Animation d'apparition */
        }

        .warning-container h1 {
            font-size: 28px; /* Taille de police */
            font-weight: 700;
            color: #ffc107; /* Jaune pour indiquer un avertissement */
            margin-bottom: 20px; /* Espace sous le titre */
        }

        .warning-container p {
            font-size: 16px; /* Taille de police */
            color: #6b7280; /* Gris foncé */
            margin-bottom: 20px; /* Espace sous le texte */
        }

        .warning-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffc107; /* Jaune pour correspondre au thème */
            color: #333;
            text-decoration: none;
            border-radius: 6px; /* Bordures arrondies */
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .warning-container a:hover {
            background-color: #e0a800; /* Jaune plus foncé au survol */
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
<div class="warning-container">
    <h1>Base de données non effacée</h1>
    <p>Votre base de données n'a pas encore été effacée. Veuillez vérifier.</p>
    <a href="{{url('lesImportations')}}">Retour à la gestion de la base</a>
</div>
@endsection
