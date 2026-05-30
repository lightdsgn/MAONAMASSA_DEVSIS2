<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mão na Massa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Sora', sans-serif; }
        body { background: linear-gradient(135deg, #fa4101 0%, #f97316 100%); min-height: 100vh; }
    </style>
</head>
<body>
    <nav class="navbar" style="background-color: rgba(0,0,0,0.2); height: 70px;">
        <div class="container">
            <a href="{{ route('home') }}">
                <img src="/logomaonamassa.png" height="44">
            </a>
        </div>
    </nav>
    <div class="container py-5">
        {{ $slot ?? '' }}
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
