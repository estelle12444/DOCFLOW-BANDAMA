@extends('layouts')

@section('content')
    <div class="container">
        <h3>Notifications</h3>
        @foreach($notifications as $notification)
            <div class="alert {{ $notification->status == 'confirmed' ? 'alert-success' : 'alert-danger' }}">
                {{ $notification->data['message'] }}
                <small class="text-muted">Ordre N°: {{ $notification->data['order_id'] }}</small>
            </div>
        @endforeach
    </div>
@endsection
