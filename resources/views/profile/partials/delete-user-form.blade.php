<section class="ticket">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Supprimer le compte</h2>
        <p class="mt-1 text-sm text-gray-600">Une fois le compte supprimer, toutes les données seront effacées définitivement.</p>
    </header>

    <form method="POST" action="{{ route('profile.destroy', ['id' => $user->id]) }}">
        @csrf
        @method("DELETE")
        <button type="submit">Supprimer le compte</button>    
    </form>
    
</section>
