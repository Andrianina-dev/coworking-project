{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div>
        <h1>BIENVENUE CHEF NARDY</h1>
        <form action="{{url('loginAdmin')}}" method="post">
            @csrf
            <div>
                <label for="#">nom</label>
                <input type="text" name="nomAdmin" id="">
            </div>
            <div>
                <label for="#">mot de passe</label>
                <input type="password" name="motdepasse" id="">
            </div>
            <input type="submit" value="LOGIN">
        </form>
    </div>
</body>
</html> --}}


@extends('baseTemplate.loginBase')
@section('actionLogionForm')
    {{url('loginAdmin')}}
@endsection
@section('nomLogin')
    LOGIN ADMIN
@endsection

@section('inputForm')
<label for="exampleInputUsername" class="sr-only">Username</label>

<div class="position-relative has-icon-right">
    <input type="text" id="exampleInputUsername"  name="nomAdmin" class="form-control input-shadow" placeholder="Enter Username">
    <div class="form-control-position">
        <i class="icon-user"></i>
    </div>
 </div>

 <div class="form-group">
    <p>
        <label for="exampleInputPassword" class="sr-only">Password</label>
         <div class="position-relative has-icon-right">
            <input type="password" id="exampleInputPassword" name="motdepasse" class="form-control input-shadow" placeholder="Enter Password">
            <div class="form-control-position">
                <i class="icon-lock"></i>
            </div>
         </div>
        </div>
    </div>
 </p>

@endsection

@section('boutonLogin')
    LOG IN
@endsection
