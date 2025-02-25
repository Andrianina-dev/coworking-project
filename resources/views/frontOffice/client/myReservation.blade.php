@extends('baseTemplate.DashClientbase')

@section('navigation')
<li>
    <a href="{{url('afficheEspaceTravail')}}">
      <i class="zmdi zmdi-view-dashboard"></i> <span>Espace Travail</span>
    </a>
</li>
<li>
    <a href="{{url('myreservation')}}">
      <i class="zmdi zmdi-grid"></i> <span>Mes Reservations</span>
    </a>
</li>
<li>
    <a href="{{ url('espacebyJFetWE') }}">
        <i class="zmdi zmdi-grid"></i> <span>Espace Travail JE et WE</span>
    </a>
</li>
@endsection

@section('contentDaschClient')
<div class="workspace-table">
    <h1>Liste des Espaces de Travail</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Nom Espace</th>
                <th>Option(s)</th>
                <th>Durée</th>
                <th>FAIT PAR</th>
                <th>Montant</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($getEspaceTravailbyDate as $espace)
            <tr>
                <td>{{ $espace->dates }}</td>
                <td>{{ $espace->heureDebut }}</td>
                <td>{{ $espace->heureFin }}</td>
                <td>{{ $espace->nomEspaceTravail }}</td>
                <td>{{ $espace->allOption }}</td>
                <td>{{ $espace->duree }}</td>
                <td>{{ $espace->nomClient }}</td>
                <td>{{ $espace->totalPrice }}</td>
                <td>{!! $espace->statusHtml !!}</td>
                <td>{!! $espace->actionsHtml !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
