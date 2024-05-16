<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>G-Feed</title>
        <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
        @vite('resources/css/app.css')
        @yield('css-view')
    </head>

    <body class="h-screen overflow-hidden flex items-center " style="background: #edf2f7;">
        @include('templates.menu-lateral')
 
        
        <div id="view-conteudo" class="flex-1 ml-[300px] p-6">
            @yield('conteudo-view')
        </div>

    </body>
    
    <script type="text/javascript">
        function dropdown() {
            document.querySelector("#submenu").classList.toggle("hidden");
            document.querySelector("#arrow").classList.toggle("rotate-0");
        }
        dropdown();

        
        document.querySelectorAll('.teste').forEach(function(elemento) {
            elemento.addEventListener('click', function() {
                
                //this.classList.toggle('hidden');
                
            });
        });

        function openSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
        }
    </script>
    @yield('js-view')
</html>