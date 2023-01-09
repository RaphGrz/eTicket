<div class="content">
    <div class="menu">
        
        <a href="{{ route('create-ticket') }}" class="create">Creer un ticket +</a>
        <h1>Liste des tickets</h1>
        @if(Gate::allows('access-admin'))
            <a href="{{ route('service') }}" class="create">Service</a>
            <a href="{{ route('profile.list') }}" class="create">Liste des profils</a>
        @endif

    </div>

    <div class="recherche-bar">
        <form action="{{ route('search-ticket') }}" method="post" id="search-form">
            <input type="text" id="q" name="q" placeholder="Rechercher un ou plusieurs tickets">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    
    <div id="tickets">
        @if ($tickets->count() > 0)
            @foreach ($tickets as $ticket)
                @if (Gate::allows('access-ticket', $ticket) || Gate::allows('access-admin'))
                    <div class="ticket-home">
                        <a href="{{ route('ticket', ['id' => $ticket->id]) }}">
                            <div class="ticket">
                                <h3>
                                    [{{ $ticket->Service->name }}] {{ $ticket->title}}
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
                                <p>| Créé par {{ $ticket->User->name }} {{ $ticket->User->last_name}}, à {{ $ticket->created_at->format('H:i')}} le {{ $ticket->created_at->format('d/m/Y') }}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        @else
            <h1>Aucun ticket</h1>
        @endif 
    </div>
    
</div>

<script src="{{ asset('build/assets/search-ticket.js') }}"></script>