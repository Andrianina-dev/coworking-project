{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des options payantes</title>
    <!-- Lien vers le fichier CSS externe -->

</head>
<body>
    <div class="options-container">
        <h1>Liste des options payantes</h1>

        <div class="options-grid">
            @foreach ($listOptionPayante as $getOption)
                <div class="option-card">
                    <div class="icon">
                        <i class="fas fa-star"></i> <!-- Icône pour chaque option -->
                    </div>
                    <h2>{{ $getOption->nomOption }}</h2>
                    <p>Profitez de cette option pour améliorer votre expérience.</p>
                    <p class="price">{{ $getOption->prixOption }} €</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html> --}}

@extends('baseTemplate.DashClientbase')
@section('nomHeader')
Administrateur
@endsection
@section('contentDaschClient')
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
<li>
    <a href="{{url('deletedBase')}}">
        <i class="zmdi zmdi-grid"></i> <span>Efface Base</span>
    </a>
</li>
@endsection
<div class="options-container">
    <h1>Liste des options payantes</h1>

    <div class="options-grid">
        @foreach ($listOptionPayante as $getOption)
            <div class="option-card">
                <div class="icon">
                    <i class="fas fa-gem"></i> <!-- Icône gemme pour une option premium -->
                </div>
                <h2>{{ $getOption->nomOption }}</h2>
                <p>Profitez de cette option pour améliorer votre expérience.</p>
                <p class="price">{{ $getOption->prixOption }} €</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
