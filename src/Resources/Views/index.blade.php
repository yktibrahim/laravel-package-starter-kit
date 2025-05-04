<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Package title from configuration - Yapılandırmadan paket başlığı --}}
    <title>{{ config('laravelpackagestarterkit.name') }}</title>
    {{-- Bootstrap CSS for styling - Stil için Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                {{-- Main content card - Ana içerik kartı --}}
                <div class="card">
                    {{-- Card header with package name - Paket adıyla kart başlığı --}}
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ config('laravelpackagestarterkit.name') }}</h4>
                    </div>
                    {{-- Card body with welcome message - Karşılama mesajıyla kart gövdesi --}}
                    <div class="card-body">
                        <h5 class="card-title">Hoş Geldiniz! / Welcome!</h5>
                        <p class="card-text">Bu, Laravel paketiniz için bir başlangıç şablonudur. / This is a starter template for your Laravel package.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 