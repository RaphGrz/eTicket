{{-- <!DOCTYPE html> --}}
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Gestionnaire de ticket</title>
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
        @include('layouts.navbar')
		<div class="content">
			@yield('cotent')
		</div>

		<footer></footer>
	</body>

</html>