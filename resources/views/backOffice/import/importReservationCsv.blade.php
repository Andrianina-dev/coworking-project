{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import CSV</title>
    <style>

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb; /* Gris clair moderne */
            color: #333;
        }


        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4F46E5; /* Bleu moderne */
            color: white;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar .links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .navbar a:hover {
            background-color: #4338CA; /* Plus foncé pour hover */
        }

        /* Contenu principal */
        #content {
            max-width: 600px;
            margin: 120px auto; /* Évite le chevauchement avec la navbar */
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        #content:hover {
            transform: translateY(-5px); /* Légère animation au hover */
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            color: #4F46E5; /* Même couleur que la navbar */
            margin-bottom: 20px;
        }

        .formulaire {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        input[type="file"] {
            padding: 12px;
            width: 100%;
            max-width: 400px;
            border: 2px dashed #d1d5db; /* Gris clair avec effet dashed */
            border-radius: 8px;
            background-color: #f3f4f6;
            cursor: pointer;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input[type="file"]:hover {
            border-color: #4F46E5; /* Change de couleur au survol */
            background-color: #e0e7ff; /* Légèrement bleu */
        }

        input[type="submit"] {
            padding: 12px 30px;
            background-color: #4F46E5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #4338CA; /* Plus foncé */
            transform: translateY(-3px); /* Légère élévation */
        }
    </style>

</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="links">
            <a href="{{url('lesImportations')}}">Espace</a>
            <a href="{{url('optionaImporter')}}">option</a>
            <a href="{{url('reservationCsvImporter')}}">reservation Csv</a>
        </div>
    </div>

    <div id="content">
        <h1>Importer le fichier CSV RESERVATION CSV</h1>
        <p class="description" style="color: #6b7280; margin-bottom: 20px;">
            Veuillez choisir un fichier au format CSV pour l'importer.
        </p>
        <div class="formulaire">
            <form action="{{url('reservationCsvImport')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csv_file" id="import-csv" required>
                <input type="submit" value="Importer">
            </form>
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
    <a href="{{url('lesImportations')}}">
      <i class="zmdi zmdi-grid"></i> <span>Import csv</span>
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
    <h1>Importez le fichier CSV RESERVATION</h1>
    <p class="description">
        Veuillez choisir un fichier au format CSV pour l'importer.
    </p>
    <div class="formulaire">
        <form action="{{url('reservationCsvImport')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="csv_file" id="import-csv" required>
            <input type="submit" value="Importer">
        </form>
    </div>

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

<div class="links-section">
    <h2>Autres Options</h2>
    <div class="links">
        <a href="{{url('lesImportations')}}">Espace</a>
        <a href="{{url('optionaImporter')}}">Option</a>
        <a href="{{url('paiementaImporter')}}">Paiement</a>
    </div>
</div>
@endsection
