{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login Client</title>
</head>
<body>
    <h1>LOGIN CLIENT</h1>
    <form action="{{url('loginClient')}}" method="post">
        @csrf
        <label for="">Login Client</label>
        <input type="text" name="numeroTel" id="telephone">
        <input type="submit" value="se connectez">
    </form>
</body>
</html>
 --}}

@extends('baseTemplate.loginBase')

@section('nomLogin')
    LOG IN CLIENT
@endsection

@section('actionLogionForm')
    {{url('loginClient')}}
@endsection
@section('place')

@endsection

@section('inputForm')
    <input type="text" name="numeroTel" id="exampleInputUsername" class="form-control input-shadow" placeholder="Votre numero de telephone">
    <div class="form-control-position">
        <i class="icon-user"></i>
    </div>
@endsection
@section('boutonLogin')
    se connectez
@endsection
