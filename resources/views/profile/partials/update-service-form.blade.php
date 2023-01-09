<div class="ticket">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Les services</h2>
        <p class="mt-1 text-sm text-gray-600">Modification des services de votre profil</p>
    </header>

    {{-- LES SERVICES --}}
    @if ($user->services->count() > 0)
        @foreach ($user->services as $service)
            <div class="commentaire">
                <span>{{ $service->name}}</span>
                <form method="POST" action="{{ route('profile.service-destroy', ['id' => $user->id]) }}">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button type="submit"">Supprimer</button>
                </form>
            </div>
        @endforeach
    @else
        <div class="commentaire">Aucun service.</div>
    @endif

    {{--AJOUTER SERVICES --}}
    <form method="POST" action="{{ route('profile.service-update', ['id' => $user->id]) }}">
        @csrf
        <label for="service_id">Service:</label>
        <select name="service_id">
            @forelse($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @empty
                <option value="0">Aucun service créé</option>
            @endforelse
        </select>
        <button type="submit">Ajouter ce service</button>
    </form>
</div>