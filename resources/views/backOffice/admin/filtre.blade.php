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
<div class="custom-container">
    <!-- Titre de la page -->
    <h1 class="custom-page-title">Filtre Payée et Non Payée</h1>

    <!-- Formulaire de filtre -->
    <div class="custom-filter-form">
        <form action="{{ url('filtrePayeeNonPayee') }}" method="post">
            @csrf <!-- Sécurité CSRF -->
            <label for="status">Statut :</label>
            <select name="idStatuts" id="status">
                <option value="2">Payée</option>
                <option value="3">Non payée</option>
            </select>
            <input type="submit" value="Voir">
        </form>
    </div>

    <!-- Section pour les montants payés -->
    @if(isset($idStatus) && $idStatus == 2)
        <div class="custom-results-section" id="payee">
            <h2><i class="fas fa-check-circle"></i> Montants Payés</h2>
            @if(isset($filtrePayeeNonPayee) && !empty($filtrePayeeNonPayee))
                @foreach ($filtrePayeeNonPayee as $filtrage)
                    <p>Montant total payé : <span class="amount">{{ number_format($filtrage->filtreReservation, 0, ',', ' ') }} Ar</span></p>
                @endforeach
            @else
                <p class="no-results">Aucun montant payé trouvé.</p>
            @endif
        </div>
    @endif

    <!-- Section pour les montants non payés -->
    @if(isset($idStatus) && $idStatus == 3)
        <div class="custom-results-section" id="nonPayee">
            <h2><i class="fas fa-times-circle"></i> Montants Non Payés</h2>
            @if(isset($filtrePayeeNonPayee) && !empty($filtrePayeeNonPayee))
                @foreach ($filtrePayeeNonPayee as $filtrage)
                    <p>Montant total non payé : <span class="amount">{{ number_format($filtrage->filtreReservation, 0, ',', ' ') }} Ar</span></p>
                @endforeach
            @else
                <p class="no-results">Aucun montant non payé trouvé.</p>
            @endif
        </div>
    @endif
</div>
@endsection
