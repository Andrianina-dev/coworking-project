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
<div class="chiffre-affaire-container">
    <h1>Chiffre d'affaire par jour</h1>

    <!-- Formulaire de sélection de dates -->
    <form action="{{ route('afficheChiffreAffaire') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="date" name="datedebut" id="dateChiffreAffaire" required>
            <input type="date" name="dateFin" id="dateFinChiffreAffaire" required>
            <button type="submit">Sélectionner</button>
        </div>
    </form>

    <!-- Affichage des messages d'erreur -->
    @if(session('error'))
        <p class="error-message">{{ session('error') }}</p>
    @endif

    <!-- Affichage des données -->
    @if(isset($dateChoisie) && isset($voirChiffreAffaire) && count($voirChiffreAffaire) > 0)
        <div class="data-container">
            <!-- Affichage conditionnel des dates -->
            <p class="selected-date">
                Période sélectionnée :
                <strong>
                    @if($dateChoisie == $datefinchoice)
                        {{ $dateChoisie }}
                    @else
                        du {{ $dateChoisie }} au {{ $datefinchoice }}
                    @endif
                </strong>
            </p>

            <!-- Tableau des données -->
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Chiffre d'affaires (Ar)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSum = 0; // Initialiser la somme totale
                    @endphp
                    @foreach($voirChiffreAffaire as $data)
                        @php
                            $totalSum += $data->totalSumPrice; // Ajouter chaque valeur à la somme totale
                        @endphp
                        <tr>
                            <td>{{ $data->dates }}</td>
                            <td>{{ number_format($data->totalSumPrice, 0, ',', ' ') }} Ar</td>
                        </tr>
                    @endforeach
                    <!-- Ligne pour afficher la somme totale -->
                    <tr class="total-row">
                        <td><strong>Total</strong></td>
                        <td><strong>{{ number_format($totalSum, 0, ',', ' ') }} Ar</strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- Graphique -->
            <div class="chart-container">
                <canvas id="chiffreAffaireChart"></canvas>
            </div>
        </div>
    @else
        <p class="no-data-message">Aucune donnée disponible pour la période sélectionnée.</p>
    @endif
</div>

<!-- Script pour le graphique -->
<script>
    const voirChiffreAffaire = @json($voirChiffreAffaire ?? []);
</script>
<script src="{{ asset('fronts/assets/js/chartt.js') }}"></script>
@endsection
