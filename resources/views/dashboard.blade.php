@extends('layouts')

@section('content')
<div class="container">
    <h1>Bienvenue, {{ Auth::user()->name }} !</h1>
    <p>Ceci est votre tableau de bord.</p>
</div>
@endsection
