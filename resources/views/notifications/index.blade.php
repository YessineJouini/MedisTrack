@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notifications</h1>

    @if($notifications->isEmpty())
        <p>Aucune notification.</p>
    @else
        <ul>
            @foreach($notifications as $notif)
                <li style="margin-bottom: 10px; {{ $notif->read_at ? '' : 'font-weight: bold;' }}">
                    {{ $notif->data['message'] ?? 'Nouvelle notification' }}
                    <small>({{ $notif->created_at->diffForHumans() }})</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
