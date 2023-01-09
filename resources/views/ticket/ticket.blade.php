@extends('layouts.ap')

@section('cotent')

<div class="menu">
    <a href="{{ route('dashboard') }}" class="retour">Retour</a>
    <h1>Ticket n°{{ $ticket->id }}</h1>
</div>

<div class="container-ticket">

    <div class="ticket">
        <h3>
            [{{ $ticket->Service->name }}] {{ $ticket->title }}
            @if ($ticket->is_public)
                [Public]
            @else
                [Privé]
            @endif
            <span
                @if ($ticket->status == 'non traité')
                    style="color:red"
                @elseif ($ticket->status == 'en cours' || $ticket->status == 'en attente de validation')
                    style="color:orange"
                @elseif ($ticket->status == 'terminé')
                    style="color:green"
                @endif
            >[{{ $ticket->status }}]</span> 
        </h3>
        <h4>{{ $ticket->content }}</h4>
        <p>| Créé par {{ $ticket->User->name }} {{ $ticket->User->last_name}}, le {{ $ticket->created_at->format('d/m/Y')}}</p>    

        {{-- ETAT TICKET --}}
            @if ( (Gate::allows('access-admin') || Gate::allows('access-gestionnaire', $ticket)) && $ticket->status != 'terminé')
                <form method="POST" action="{{ route('ticket.update', $ticket->id) }}">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="status">Status du ticket:</label>

                        <input 
                            type="radio" id="status" name="status" value="non traité" 
                            @if ($ticket->status == 'non traité')
                                checked  
                            @endif
                        >
                        <label for="non traité">Non traité</label>

                        <input 
                            type="radio" id="status" name="status" value="en cours"
                            @if ($ticket->status == 'en cours')
                                checked  
                            @endif
                        >
                        <label for="en cours">En cours</label>

                        <input 
                            type="radio" id="status" name="status" value="en attente de validation"
                            @if ($ticket->status == 'en attente de validation')
                                checked  
                            @endif
                        >
                        <label for="en attente de validation">En attente de validation</label>

                    </div>
                    <button type="submit">Mettre à jour</button>
                </form>
            @endif

        {{-- VALIDATION --}}
            @if ($ticket->status == 'en attente de validation' && Auth::user()->id == $ticket->user_id)
                <form method="POST" action="{{ route('ticket.update', $ticket->id) }}">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="status">Status du ticket:</label>

                        <input type="radio" id="status" name="status" value="en attente de validation" checked>
                        <label for="en attente de validation">En attente de validation</label>

                        <input type="radio" id="status" name="status" value="terminé">
                        <label for="terminé">Terminé</label>

                    </div>
                    <button type="submit">Mettre à jour</button>
                </form>
            @endif
        
    </div>
    {{-- LES MESSAGES --}}
    @forelse($ticket->comments as $comment)
        <hr width="100%" size="1px" color="#0074D9">
        <div class="commentaire">
            <h4>{{ $comment->content }}</h4>
            @if($comment->image != NULL)
                <a href="{{ route('download-file', $comment->id) }}">{{ $comment->image->path }}</a>
            @endif
            <p>
                | Ecrit par {{ $comment->User->name }} {{ $comment->User->last_name}}, à {{ $comment->created_at->format('H:i')}} le {{ $comment->created_at->format('d/m/Y') }}
            </p>  
        </div>
    @empty
        <hr width="100%" size="1px" color="#0074D9">
        <div class="commentaire">
            <p class="commentaire">Aucun commentaire pour ce ticket.</p>
        </div>
    @endforelse

    <hr width="100%" size="1px" color="#0074D9">

    {{-- ECRIRE UN MESSAGE --}}
    @if($ticket->status != 'terminé')
        <div class="form-comment">
            <form method="POST" action="{{ route('store-comment') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <div>
                    <textarea name="content" cols="160" rows="10"></textarea>
                </div>

                <div>
                    <label for="file">Joindre un document: </label>
                    <input type="file" id="file" name="file" accept="image/*, .pdf, .txt">
                </div>

                <div>
                    <button type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    @endif

    {{-- LES ERREURS SI CHAMPS PAS REMPLI --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error_message">{{ $error }}</div>
        @endforeach
    @endif

</div>
    
@endsection