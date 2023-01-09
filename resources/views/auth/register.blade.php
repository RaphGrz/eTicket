@extends('layouts.ap')

@section('cotent')

<div class="menu">
    <a href="{{ route('profile.list') }}" class="retour">Retour</a>
    <h1>Creation d'un compte</h1>
</div>

<div class="container-ticket">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="ticket">
                {{-- PRENOM --}}
            <div>
                <label for="name">Prénom:</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- NOM --}}
            <div>
                <label for="last_name">Nom:</label>
                <input id="last_name" type="text" name="last_name" :value="old('last_name')" required>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>

            {{-- DATE DE NAISSANCE --}}
                <label for="birth_date">Date de naissance</label>
                <input type="date" id="birth_date" name="birth_date" value="" min="1900-01-01" max="2004-01-01">

            {{-- SERVICE --}}
            <div>
                <label for="service_id">Service:</label>
                <select name="service_id">
                    @forelse($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @empty
                        <option value="0">Aucun service créé</option>
                    @endforelse
                </select>
            </div>
            
            {{-- ROLE --}}
            <div>
                <label for="role">Rôle:</label>
                <input type="radio" id="utilisateur" name="role" value="utilisateur" checked>
                <label for="utilisateur">Utilisateur</label>
                <input type="radio" id="gestionnaire" name="role" value="gestionnaire">
                <label for="gestionnaire">Gestionnaire</label>
                <input type="radio" id="admin" name="role" value="admin">
                <label for="admin">Administrateur</label>
            </div>

            {{-- ADRESSE MAIL --}}
            <div>
                <label for="email">Adresse mail:</label>
                <input id="email" type="email" name="email" :value="old('email')" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- MOT DE PASSE -->
            <div>
                <label for="password">Mot de passe:</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- CONFIRMER MOT DE PASSE -->
            <div>
                <label for="password_confirmation">Confirmation du mot de passe:</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit">Créer le compte</button>

            {{-- Message d'erreur si champs pas rempli --}}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error_message">{{ $error }}</div>
                @endforeach
            @endif

        </div>
        
    </form>
</div>
    
@endsection