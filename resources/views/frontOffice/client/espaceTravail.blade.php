@extends('baseTemplate.DashClientbase')

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
    {{ url('listEspaceTravail') }}
@endsection
    @section('rechercheInput')
    <button type="submit" name="dateAction" value="previous">Date précédente</button>
<input
    type="date"
    name="dateEspaceTravail"
    id="dateEspaceTravail"
    value="{{ $selectedDate ?? date('Y-m-d') }}"/>

    <button type="submit" name="dateAction" value="next">Date suivante</button>

<button type="submit">Afficher</button>
@endsection

@section('contentDaschClient')

@if (!empty($errorMessage))
    <div class="error-message">{{ $errorMessage }}</div>
@else
    <h1>Disponibilité des Espaces de Travail pour le {{ $selectedDate }}</h1>

    <div class="table-container">
        @foreach ($sommeDuree as $totalDure )
            <p>la somme:{{$totalDure->totalDuree}}</p>
        @endforeach
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    @for ($i = 8; $i <= 18; $i++)
                        <th>{{ $i }}h</th>
                    @endfor
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservationMap as $nomEspace => $heures)
                    <tr>
                        <td>{{ $nomEspace }}</td>
                        @for ($i = 8; $i <= 18; $i++)
                            @php
                                $class = $classMap[$nomEspace][$i] ?? 'statut-1'; // Classe CSS par défaut
                            @endphp
                            <td class="{{ $class }}">
                                @if ($class === 'highlight')
                                    <span class="cross">&#10006;</span> <!-- Croix rouge si réservé par l'utilisateur -->
                                @endif
                            </td>
                        @endfor
                        <td>
                            <a href="{{ url('makeReservation') }}?idEspaceTravail={{ $listAfficheEspace->firstWhere('nomEspaceTravail', $nomEspace)?->idEspaceTravail }}">
                                Réservez
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
