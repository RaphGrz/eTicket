<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Connexion: E-Ticket</title>
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
	</head>
    <body class="body-form">
        <img class="imgETicket" alt="E-Ticket" src="{{ asset('images/e-ticket-logo-color-on-transparent-background.png') }}">
        <h2 class="sloganForm">Avec E-Ticket, résolvez vos problèmes.</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form class="form_log" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="inputs">
                <input id="email" type="email" name="email" placeholder="Adresse e-mail" :value="old('email')" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <input id="password" type="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

			<div class="btnSeConnecter">
                <button type="submit">
                    Se connecter
                </button>
			</div>
            <hr width="100%" size="1px" color="#FCDB5C">
            <div class="lienMdp">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>

		<footer>
		</footer>
    </body>
</html>