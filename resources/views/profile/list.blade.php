@extends('layouts.ap')

@section('cotent')

<div class="menu">
    <a href="{{ route('dashboard') }}" class="retour">Retour</a>
    <h1>Liste des profils</h1>
    <a href="{{ route('register') }}" class="create">Créer un profil +</a>
</div>

<div class="recherche-bar">
    <form action="{{ route('search-user') }}" method="post" id="search-form">
        <input type="text" id="q" name="q" placeholder="Rechercher un profil par nom">
        <button type="submit">Rechercher</button>
    </form>
</div>

{{-- AFFICHAGE DES PROFILS --}}
<div id="users">
    @if ($users->count() > 0)
        @foreach ($users as $user)
            <div class="ticket-home">
                <a href="{{ route('profile.edit', ['id' => $user->id]) }}">
                    <div class="ticket">
                        <h3>{{ $user->name}} {{ $user->last_name}}</h3>
                        <p>[{{ $user->role }}]
                            @foreach ($user->services as $service)
                                [{{ $service->name }}]
                            @endforeach
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <h1>Aucun profil</h1>
    @endif
</div>

<script src="{{ asset('build/assets/search-user.js') }}"></script>

@endsection