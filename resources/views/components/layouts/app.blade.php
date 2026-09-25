<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Denzeru — Design & Develop ' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-[#f7f5f0] text-[#111827] antialiased">
    <x-layouts.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-layouts.footer />
</body>
</html>
