<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-head/>
</head>
<body>

    <section id="container">

        <x-logo/>

        <x-header/>

        <x-nav/>

        {{ $slot }}

        <x-footer/>

    </section>
    {{-- <livewire:livewire-test /> --}}
    @livewireScripts
</body>
</html>

