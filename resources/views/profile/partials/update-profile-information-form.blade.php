<section class="ticket">
    <header>
        <h2 class="text-lg font-medium text-gray-900">Profil</h2>
        <p class="mt-1 text-sm text-gray-600">Modification des informations de votre profil</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update', $user->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- PRENOM --}}
        <div>
            <x-input-label for="name" :value="__('Prénom')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- NOM --}}
        <div>
            <x-input-label for="last_name" :value="__('Nom')" />
            <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name', $user->last_name)" required/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        {{-- ROLE --}}
        @if(Gate::allows('access-admin'))
            <div>
                <label for="role">Rôle:</label>
                <input type="radio" id="utilisateur" name="role" value="utilisateur" 
                    @if ($user->role == 'utilisateur')
                        checked
                    @endif
                >
                <label for="utilisateur">Utilisateur</label>
                <input type="radio" id="gestionnaire" name="role" value="gestionnaire"
                    @if ($user->role == 'gestionnaire')
                        checked
                    @endif
                >
                <label for="gestionnaire">Gestionnaire</label>
                <input type="radio" id="admin" name="role" value="admin"
                    @if ($user->role == 'admin')
                        checked
                    @endif
                >
                <label for="admin">Administrateur</label>
            </div>
        @else
            <input type="hidden" name="role" value="{{ $user->role }}">
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Sauvegardé.</p>
            @endif
        </div>
    </form>
</section>
