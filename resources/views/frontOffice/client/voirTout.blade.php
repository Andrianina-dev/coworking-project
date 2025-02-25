@extends('baseTemplate.DashClientbase')

@section('navigation')
<li>
    <a href="{{url('afficheEspaceTravail')}}">
      <i class="zmdi zmdi-view-dashboard"></i> <span>Espace Travail</span>
    </a>
  </li>
@endsection
@section('contentDaschClient')
    <h1>Bienvenue chers clients..</h1>
@endsection
