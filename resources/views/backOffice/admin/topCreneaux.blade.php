{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les Top Créneaux</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'ajouter le bon chemin vers votre fichier CSS -->
</head>
<body>
    <div class="creneaux-card-container">
        <h1 class="creneaux-card-title">Voici les Top 3 Créneaux Horaires</h1>
        <div class="creneaux-card-grid">
            @foreach ($topCreneaux as $allTopCreneaux)
                <div class="creneaux-card">
                    <div class="creneaux-card-time">{{$allTopCreneaux->heureDebut}}:00</div>
                    <div class="creneaux-card-reservations">{{$allTopCreneaux->nombreReservations}} réservations</div>
                    <div class="creneaux-card-text">Créneau populaire</div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
 --}}
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
    <a href="{{url('lesImportations')}}">
      <i class="zmdi zmdi-grid"></i> <span>Import csv</span>
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
 <div class="creneaux-card-container">
     <h1 class="creneaux-card-title">Voici les Top 3 Créneaux Horaires</h1>
     <div class="creneaux-card-grid">
         @foreach ($topCreneaux as $allTopCreneaux)
             <div class="creneaux-card">
                 <div class="creneaux-card-time">{{$allTopCreneaux->heure}}:00</div>
                 <div class="creneaux-card-reservations">{{$allTopCreneaux->nombreReservations}} réservations</div>
                 <div class="creneaux-card-text">Créneau populaire</div>
             </div>
         @endforeach
     </div>
 </div>
 @endsection
