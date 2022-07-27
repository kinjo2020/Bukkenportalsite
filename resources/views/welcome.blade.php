<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Bukkenportalsite</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Bukkenportalsite') }}
                    </a>
                </div>
            </nav>
    
            <main class="py-4">
                <div class="container">
                    
                    <div class="py-5 my-5">
                        <h1 class="display-3 text-center">ようこそBukkenPortalSiteへ！！</h1>
                    </div>
                    
                    <div class="border py-3 my-3">
                        <div class="display-4 text-center">希望の物件を探そう</div>
                        <div class="py-4 text-center">
                            {!! link_to_route('user.index', '物件を探す', [], ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    </div>
                    
                    <div class="border py-3 my-3">
                        <div class="display-4 text-center">物件を掲載しよう</div>
                        <div class="py-4 text-center">
                            {!! link_to_route('estate.index', '物件を掲載する', [], ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
    
</html>
