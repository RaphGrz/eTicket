@extends('layouts.ap')

@section('cotent')

<div class="menu">
    <a href="{{ route('dashboard') }}" class="retour">Retour</a>
    <h1>Creation d'un ticket</h1>
</div>

<div class="form-ticket">
    <form method="POST" action="{{ route('store-ticket') }}">
        @csrf

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div>
            <label for="title">Titre du ticket:</label>
            <input id="title" type="text" name="title">
        </div>

        <div>
            <label for="content">Decrivez votre problème:</label>
        </div>
        <div>
            <textarea id="content" name="content" cols="30" rows="10"></textarea>
        </div>

        <div>
            <input type="radio" id="public" name="is_public" value="1" checked>
            <label for="public">Public</label>

            <input type="radio" id="private" name="is_public" value="0">
            <label for="priavte">Privé</label>
        </div>

        {{-- CHOIX DU SERVICE --}}
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
        <button type="submit">Créer un ticket</button>
    </form>
    
    {{-- Message d'erreur si champs pas rempli --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error_message">{{ $error }}</div>
        @endforeach
    @endif
</div>

    
@endsection