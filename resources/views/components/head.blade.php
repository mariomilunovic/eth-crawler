<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'eth-crawler') }}</title>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Scripts -->
{{-- @toastScripts --}}
@vite(['resources/js/app.js'])

<!-- Styles -->
@vite(['resources/css/app.css'])
@livewireStyles
