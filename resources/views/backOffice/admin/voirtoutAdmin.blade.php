 @extends('baseTemplate.DashClientbase')

 @section('nomHeader')
    ADMINISTRATEUR
 @endsection

@section('navigation')
<li>
    <a href="{{url('rechercheChiffreAffaire')}}">
      <i class="zmdi zmdi-view-dashboard"></i> <span>chiffre d'affaire</span>
    </a>
  </li>
@endsection
@section('contentDaschClient')
<h1>BIENVENUE CHER ADMINISTRATEUR</h1>
@endsection
