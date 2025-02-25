@extends('baseTemplate.DashClientbase')

@section('rechercheInput')
    <form action="{{ url('formJFetWE') }}" method="GET">
        <input type="date" name="dateDebut" id="dateDebut">
        <input type="date" name="dateFin" id="dateFin">
        <button type="submit">Afficher</button>
    </form>
@endsection

@section('navigation')
    <li>
        <a href="{{ url('afficheEspaceTravail') }}">
            <i class="zmdi zmdi-view-dashboard"></i> <span>Espace Travail</span>
        </a>
    </li>
    <li>
        <a href="{{ url('myreservation') }}">
            <i class="zmdi zmdi-grid"></i> <span>Mes Reservations</span>
        </a>
    </li>
    <li>
        <a href="{{ url('espacebyJFetWE') }}">
            <i class="zmdi zmdi-grid"></i> <span>Espace Travail JE et WE</span>
        </a>
    </li>
@endsection

@section('actionForm')
    {{ url('formJFetWE') }}
@endsection

@section('contentDaschClient')
    <style>
        .libre { background-color: green; color: white; }
        .orange { background-color: orange; color: white; }
        .violet { background-color: violet; color: white; }
        .rouge { background-color: red; color: white; }
        .table-container {
            overflow-x: auto; /* Barre de défilement horizontale */
            overflow-y: auto; /* Barre de défilement verticale */
            max-height: 500px; /* Hauteur maximale du conteneur */
        }
    </style>

    <h1>Calendrier des réservations</h1>

    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>Espace de travail</th>
                    @php
                        $dateDebut = \Carbon\Carbon::parse(request('dateDebut'));
                        $dateFin = \Carbon\Carbon::parse(request('dateFin'));
                        $dateCourante = $dateDebut->copy();
                    @endphp
                    @while ($dateCourante->lte($dateFin))
                        <th>{{ $dateCourante->toDateString() }}<br>{{ $dateCourante->locale('fr_FR')->dayName }}</th>
                        @php
                            $dateCourante->addDay();
                        @endphp
                    @endwhile
                </tr>
            </thead>
            <tbody>
                @foreach ($listAfficheEspace as $espace)
                    <tr>
                        <td>{{ $espace->nomEspaceTravail }}</td>
                        @php
                            $dateDebut = \Carbon\Carbon::parse(request('dateDebut'));
                            $dateFin = \Carbon\Carbon::parse(request('dateFin'));
                            $dateCourante = $dateDebut->copy();
                        @endphp
                        @while ($dateCourante->lte($dateFin))
                            @php
                                $dateString = $dateCourante->toDateString();
                                $statut = $disponibiliteParEspace[$espace->nomEspaceTravail][$dateString];
                            @endphp
                            <td class="{{ $statut }}">
                                @if ($statut === 'libre')
                                    Libre
                                @elseif ($statut === 'orange')
                                    Jour férié
                                @elseif ($statut === 'violet')
                                    Week-end
                                @elseif ($statut === 'rouge')
                                    Réservé
                                @endif
                            </td>
                            @php
                                $dateCourante->addDay();
                            @endphp
                        @endwhile
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
