<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ \App\Models\SchoolSetting::get('school_name', 'Website Madrasah') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body style="font-family:'Plus Jakarta Sans',sans-serif; min-height:100vh; background-color: #006227; background-image: url('https://www.transparenttextures.com/patterns/arabesque.png'), linear-gradient(135deg, #004d1f 0%, #006227 40%, #007a7a 100%); background-attachment: fixed;">

<div class="min-h-screen flex items-center justify-center p-4">
    {{ $slot }}
</div>

@livewireScripts
</body>
</html>
