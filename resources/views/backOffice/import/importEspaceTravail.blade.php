{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import CSV</title>
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
        .csv-import-container {
            max-width: 500px; /* Réduit la largeur */
            width: 100%;
            padding: 20px; /* Padding réduit */
            background-color: #fff;
            border-radius: 12px; /* Bordure plus petite */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombre plus légère */
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 15px; /* Espace réduit entre le formulaire et les liens */
        }

        .csv-import-container:hover {
            transform: translateY(-3px); /* Animation plus subtile */
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        /* Titre */
        .csv-import-container h1 {
            font-size: 24px; /* Taille de police réduite */
            font-weight: 700;
            color: #4F46E5; /* Bleu moderne */
            margin-bottom: 15px; /* Marge réduite */
        }

        /* Description */
        .csv-import-container .description {
            color: #6b7280; /* Gris foncé pour le texte descriptif */
            margin-bottom: 20px; /* Marge réduite */
            font-size: 14px; /* Taille de police réduite */
        }

        /* Formulaire */
        .csv-import-container .formulaire {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px; /* Espacement réduit */
        }

        .csv-import-container input[type="file"] {
            padding: 10px; /* Padding réduit */
            width: 100%;
            max-width: 350px; /* Largeur réduite */
            border: 2px dashed #d1d5db; /* Gris clair avec effet dashed */
            border-radius: 6px; /* Bordure plus petite */
            background-color: #f3f4f6;
            cursor: pointer;
            transition: border-color 0.3s ease, background-color 0.3s ease;
            font-size: 13px; /* Taille de police réduite */
            color: #6b7280;
        }

        .csv-import-container input[type="file"]:hover {
            border-color: #4F46E5; /* Change de couleur au survol */
            background-color: #e0e7ff; /* Légèrement bleu */
        }

        .csv-import-container input[type="submit"] {
            padding: 10px 25px; /* Padding réduit */
            background-color: #4F46E5;
            color: #fff;
            border: none;
            border-radius: 6px; /* Bordure plus petite */
            font-size: 14px; /* Taille de police réduite */
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .csv-import-container input[type="submit"]:hover {
            background-color: #4338CA; /* Plus foncé */
            transform: translateY(-2px); /* Animation plus subtile */
        }

        /* Section des liens */
        .links-section {
            max-width: 500px; /* Largeur réduite */
            width: 100%;
            padding: 15px; /* Padding réduit */
            background-color: #fff;
            border-radius: 12px; /* Bordure plus petite */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Ombre plus légère */
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .links-section:hover {
            transform: translateY(-3px); /* Animation plus subtile */
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .links-section h2 {
            font-size: 20px; /* Taille de police réduite */
            font-weight: 600;
            color: #4F46E5; /* Bleu moderne */
            margin-bottom: 10px; /* Marge réduite */
        }

        .links-section .links {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espacement réduit */
            flex-wrap: wrap; /* Permet aux liens de passer à la ligne sur les petits écrans */
        }

        .links-section a {
            text-decoration: none;
            color: #4F46E5;
            font-weight: 500;
            padding: 8px 12px; /* Padding réduit */
            border: 2px solid #4F46E5;
            border-radius: 6px; /* Bordure plus petite */
            transition: all 0.3s ease;
        }

        .links-section a:hover {
            background-color: #4F46E5;
            color: #fff;
            transform: translateY(-2px); /* Animation plus subtile */
        }

        /* Message d'erreur ou succès */
        .csv-import-container .message {
            margin-top: 15px; /* Marge réduite */
            padding: 10px; /* Padding réduit */
            border-radius: 6px; /* Bordure plus petite */
            font-size: 13px; /* Taille de police réduite */
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .csv-import-container .message.success {
            background-color: #d1fae5; /* Vert clair pour succès */
            color: #065f46; /* Vert foncé */
        }

        .csv-import-container .message.error {
            background-color: #fee2e2; /* Rouge clair pour erreur */
            color: #991b1b; /* Rouge foncé */
        }

        /* Animation */
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
    <!-- Conteneur principal -->
    <div class="csv-import-container">
        <h1>Importez le fichier CSV ESPACE</h1>
        <p class="description">
            Veuillez choisir un fichier au format CSV pour l'importer.
        </p>
        <div class="formulaire">
            <form action="{{url('espaceImport')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csv_file" id="import-csv" required>
                <input type="submit" value="Importer">
            </form>
        </div>

        <!-- Message d'erreur ou succès (optionnel) -->
        @if(session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="message error">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Section des liens -->
    <div class="links-section">
        <h2>Autres Options</h2>
        <div class="links">
            <a href="{{url('optionaImporter')}}">Option</a>
            <a href="{{url('paiementaImporter')}}">Paiement</a>
            <a href="{{url('reservationCsvImporter')}}">Reservation CSV</a>
        </div>
    </div>
</body>
</html> --}}

@extends('baseTemplate.DashClientbase')
@section('nomHeader')
Administrateur
@endsection
@section('navigation')
<li>
    <a href="{{ url('rechercheChiffreAffaire') }}">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Chiffre d'affaire</span>
    </a>
</li>
<li>
    <a href="{{url('afficheAttentePaiement')}}">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Validation</span>
    </a>
</li>
<li>
    <a href="{{url('getAllOptions')}}">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Liste Option payante</span>
    </a>
</li>
<li>
    <a href="{{url('inputPayeeNonPayee')}}">
      <i class="zmdi zmdi-grid"></i> <span>Filtre</span>
    </a>
  </li>
  <li>
<li>
    <a href="{{url('lesImportations')}}">
        <i class="zmdi zmdi-grid"></i> <span>Import csv</span>
    </a>
</li>
<li>
    <a href="{{url('getTopCreneaux')}}">
      <i class="zmdi zmdi-grid"></i> <span>Top Creneaux horaires</span>
    </a>
  </li>
<li>
    <a href="{{url('deletedBase')}}">
      <i class="zmdi zmdi-grid"></i> <span>Efface Base</span>
    </a>
  </li>
@endsection

@section('contentDaschClient')
<div class="csv-import-container">
    <h1>Importez le fichier CSV ESPACE</h1>
    <p class="description">
        Veuillez choisir un fichier au format CSV pour l'importer.
    </p>
    <div class="formulaire">
        <form action="{{url('espaceImport')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="csv_file" id="import-csv" required>
            <input type="submit" value="Importer">
        </form>
    </div>

    <!-- Message d'erreur ou succès (optionnel) -->
    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif
</div>

<!-- Section des liens -->
<div class="links-section">
    <h2>Autres Options</h2>
    <div class="links">
        <a href="{{url('optionaImporter')}}">Option</a>
        <a href="{{url('paiementaImporter')}}">Paiement</a>
        <a href="{{url('reservationCsvImporter')}}">Reservation CSV</a>
    </div>
</div>
@endsection
