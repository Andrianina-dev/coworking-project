
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
@endsection

@section('contentDaschClient')
<div class="reservation-form-container">
    <!-- Messages de succès ou d'erreur -->
    @if (session('success'))
    <div class="success-message">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="error-message">{{ session('error') }}</div>
    @endif

    <!-- Formulaire -->
    <form action="{{ url('insertReservation') }}" method="post">
        @csrf

        <!-- Informations sur le client -->
        @if (!empty($clientList))
        @foreach ($clientList as $client)
        <input type="hidden" name="idClient" value="{{ $client->idClient }}">
        <p>Client : <b>{{ $client->nomClient }}</b></p>
            @endforeach
        @else
            <p class="error-message">Aucun client trouvé.</p>
        @endif

        <!-- Informations sur l’espace de travail -->
        @if (!empty($espaceTravailList))
        @foreach ($espaceTravailList as $workspace)
        <input type="hidden" name="idespaceTravail" value="{{ $workspace->idEspaceTravail }}">
        <h1>{{ $workspace->nomEspaceTravail }}</h1>
        @endforeach
        @else
        <p class="error-message">Aucun espace de travail trouvé.</p>
        @endif

        <label for="#">Les clients</label>
        <select name="lesClients" id="">
    @foreach ($allClients as $getClients)
        <option value="{{ $getClients->idClient }}"
            @if($getClients->idClient == $clientIdConnecte) selected @endif>
            {{ $getClients->nomClient }}
        </option>
    @endforeach
</select>

        <!-- Champ pour la date -->
        <div>
            <label for="dateResa">
                <i class="fas fa-calendar-alt"></i> Date
            </label>
            <input type="date" name="dateResa" id="dateResa" required>
        </div>

        <!-- Heure de début -->
        <div>
            <label for="heureDebut">
                <i class="fas fa-clock"></i> Heure de début
            </label>
            <select name="heureDebut" id="heureDebut" required>
                @for ($i = 8; $i <= 18; $i++)
                    <option value="{{ $i }}">{{ $i }}h</option>
                @endfor
            </select>
        </div>

        <!-- Durée -->
        <div>
            <label for="duree">
                <i class="fas fa-hourglass-half"></i> Durée (heures)
            </label>
            <select name="duree" id="duree" required>
                @for ($i = 1; $i <= 7; $i++)
                    <option value="{{ $i }}">{{ $i }} heure(s)</option>
                @endfor
            </select>
        </div>

        <!-- Options -->
        <div class="options-container">
            <label>
                <i class="fas fa-cogs"></i> Options :
            </label>
            <div class="options-grid">
                @if (!empty($listOption))
                    @foreach ($listOption as $option)
                        <div>
                            <input type="checkbox" name="options[]" value="{{ $option->idlesOptions }}">
                            <label>{{ $option->nomOption }}</label>
                        </div>
                    @endforeach
                @else
                    <p class="error-message">Aucune option disponible.</p>
                @endif
            </div>
        </div>

        <button type="submit">
            <i class="fas fa-check"></i> Réserver
        </button>
    </form>
</div>
@endsection
