@extends('layouts')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des ordres de paiement</h2>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Table des ordres de paiement -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom du client</th>
                <th scope="col">Numéro de compte</th>
                <th scope="col">Montant</th>
                <th scope="col">Bénéficiaire</th>
                <th scope="col">Documents Fournirs</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)

                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>{{ $order->client_name }}</td>
                    <td>{{ $order->account_number }}</td>
                    <td>{{ number_format($order->amount, 2, ',', ' ') }} FCFA</td>
                    <td>{{ $order->beneficiary_name }}</td>


                    @if($order->documents)
                    @php
                        $documents = json_decode($order->documents, true);
                    @endphp
                        <td>
                            <ol>
                                @foreach($documents as  $doc)
                                    <li>
                                        <a href="{{ asset('storage/' .  $doc['path']) }}" target="_blank">
                                            {{ $doc['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                    @else
                        <p>Aucun document disponible.</p>
                    @endif
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning">En attente</span>
                        @elseif($order->status == 'confirmed')
                            <span class="badge bg-success">Confirmé</span>
                        @else
                            <span class="badge bg-secondary">Traité</span>
                        @endif
                    </td>
                    <td>
                        @if($order->status == 'pending')
                            <form action="{{ route('orders.validate', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary btn-sm">Valider</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Déjà validé</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination si nécessaire -->
    {{ $orders->links() }}
</div>
@endsection
