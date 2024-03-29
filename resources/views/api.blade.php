<!--
 API Documentation HTML Template  - 1.0.1
 Copyright © 2016 Florian Nicolas
 Licensed under the MIT license.
 https://github.com/ticlekiwi/API-Documentation-HTML-Template
 !-->
 <!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>API - Codigos Postales</title>
    <meta name="description" content="">
    <meta name="author" content="ticlekiwi">

    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/hightlightjs-dark.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/style.css" media="all">
    <script>hljs.initHighlightingOnLoad();</script>
</head>

<body>
<div class="left-menu">
    <div class="content-logo">
        <div class="logo">
            <img alt="API Codigos Postales" title="API Codigos Postales" src="images/api.png" height="36" />
            <span>Codigos Postales</span>
        </div>
        <button class="burger-menu-icon" id="button-menu-mobile">
            <svg width="34" height="34" viewBox="0 0 100 100"><path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"></path><path class="line line2" d="M 20,50 H 80"></path><path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"></path></svg>
        </button>
    </div>
    <div class="mobile-menu-closer"></div>
    <div class="content-menu">
        <div class="content-infos">
            <div class="info"><b>Version:</b> 1.0.0</div>
            <div class="info"><b>Ultima Actualizacion:</b> 28/03/2022</div>
        </div>
        <ul>
            <li class="scroll-to-link active" data-target="content-get-bienvenidos">
                <a>BIENVENIDOS</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-buscar-codigo-postal">
                <a>Buscar un codigo postal</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-coincidencia-codigo-postal">
                <a>Coincidencia codigo postal</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-estados">
                <a>Obtener Estados</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-cp-municipio">
                <a>Codigos Postales Municipio</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-colonia-cp">
                <a>Colonia Codigo Postal</a>
            </li>
            <li class="scroll-to-link" data-target="content-errors">
                <a>Errores</a>
            </li>
        </ul>
    </div>
</div>
<div class="content-page">
    <div class="content-code"></div>
    <div class="content">
        <!--- se documenta la api -->
       @include('api.bienvenidos')
       @include('api.buscar-codigo-postal')
       @include('api.coincidencia-codigo-postal')
       @include('api.estados')
       @include('api.codigos-postales-municipio')
       @include('api.cp-colonia')
       @include('api.errores')

    </div>
    <div class="content-code"></div>
</div>
<script src="js/script.js"></script>
</body>
</html>