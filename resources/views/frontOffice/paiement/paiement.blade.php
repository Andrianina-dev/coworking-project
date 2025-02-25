
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
<div class="paiement-container">
    <h1>PAIEMENT</h1>

    <div class="reservation-info">
        <p>Information sur la réservation non payée :</p>
        @foreach ($listReservationId as $getReservationId)
            <input type="hidden" name="reservationId" value="{{$getReservationId->refReservation}}">
            <p>Le client : <b>{{$getReservationId->nomClient}}</b></p>
            <p>Le nom de l'espace : <b>{{$getReservationId->nomEspaceTravail}}</b></p>
            <p>Le statut : <b>{{$getReservationId->nomStatut}}</b></p>
            <p>Total option et espace : <b>{{$getReservationId->totalPrice}}</b></p>
            <p>La date de réservation : <b>{{$getReservationId->dates}}</b></p>
        @endforeach
    </div>

    <form action="{{url('getReferencePaiement')}}" method="post">
        @csrf
        <label for="refPaiement">
            Référence paiement :
            <input type="text" name="refPaiement" id="refPaiement" placeholder="Entrez votre refercence paiement" required>
        </label>

        <input type="submit" value="Payez">
    </form>
</div>
@endsection
