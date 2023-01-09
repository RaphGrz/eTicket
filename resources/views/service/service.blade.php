@extends('layouts.ap')

@section('cotent')


    <div class="menu">
        <a href="{{ route('dashboard') }}" class="retour">Retour</a>
        <h1>Les services</h1>
    </div>
    
    <div class="container-ticket">

        {{-- LES SERVICES --}}
        @forelse($services as $service)
            <div class="commentaire">
                <span>{{ $service->name}}</span>
                <form method="POST" action="{{ route('service.destroy', ['id' => $service->id]) }}">
                    @csrf
                    @method("DELETE")
                    <button type="submit">Supprimer</button>    
                </form>
            </div>
        @empty
            <div class="commentaire">Aucun service.</div>
        @endforelse
    
        <hr width="100%" size="1px" color="#0074D9">
    
        {{-- CREER UN TICKET --}}
        <div class="form-comment">
            <form method="POST" action="{{ route('store-service') }}">
                @csrf

                <div>
                    <label for="name">Nom du service:</label>
                    <textarea id="name" name="name" cols="30" rows="1"></textarea>
                </div>

                <button type="submit">Creer le service</button>


            </form>
        </div>
    
        {{-- LES ERREURS SI CHAMPS PAS REMPLI --}}
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error_message">{{ $error }}</div>
            @endforeach
        @endif
    
    </div>

@endsection