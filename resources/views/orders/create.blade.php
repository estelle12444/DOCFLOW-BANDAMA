@extends('layouts')

@section('content')
<div class="container">
    <h2>Créer un ordre de paiement</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="client_name">Nom du client</label>
            <input type="text" name="client_name" id="client_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="account_number">Numéro de compte</label>
            <input type="text" name="account_number" id="account_number" class="form-control">
        </div>
        <div class="form-group">
            <label for="amount">Montant</label>
            <input type="number" step="0.01" name="amount" id="amount" class="form-control">
        </div>
        <div class="form-group">
            <label for="beneficiary_name">Nom du bénéficiaire</label>
            <input type="text" name="beneficiary_name" id="beneficiary_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="documents">Documents justificatifs</label>
            <input type="file" name="documents[]" id="documents" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Créer l'ordre</button>
    </form>
</div>
@endsection
