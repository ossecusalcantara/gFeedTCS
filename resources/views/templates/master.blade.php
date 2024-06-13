<!DOCTYPE html>
<html lang="pt-br">
    
     @include('templates.head')

    <body>

        @include('templates.header')
        
        @include('templates.menu-lateral')

        <main id="main" class="main">
            <!-- <iframe style="border:none; width:100%" src="#" name="frame_paginas" botder="0">
            </iframe> -->
                @yield('conteudo-view')
        </main>
        
        
        @include('templates.footer')
    <body>
        @yield('js-view')
</html>