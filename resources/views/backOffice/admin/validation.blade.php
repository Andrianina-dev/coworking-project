
@extends('baseTemplate.DashClientbase')
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
<h1 class="new-validation-title">Les données à valider</h1>
<table class="new-validation-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Nom Client</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Nom Espace</th>
            <th>Durée</th>
            <th>Statut</th>
            <th>Référence paiement</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listAttentePaiementRef as $listPaiementRef)
            <tr>
                <td>{{$listPaiementRef->dates}}</td>
                <td>{{$listPaiementRef->nomClient}}</td>
                <td>{{$listPaiementRef->heureDebut}}</td>
                <td>{{$listPaiementRef->heureFin}}</td>
                <td>{{$listPaiementRef->nomEspaceTravail}}</td>
                <td>{{$listPaiementRef->duree}}</td>
                <td>{{$listPaiementRef->nomStatut}}</td>
                <td>{{$listPaiementRef->referencePaiement}}</td>
                <td>
                    <a href="{{url('validationPaiement')}}?idResa={{$listPaiementRef->idAttentePaiement}}" class="new-btn-validation">Valider</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
