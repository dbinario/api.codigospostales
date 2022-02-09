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
            <div class="info"><b>Ultima Actualizacion:</b> 08/02/2022</div>
        </div>
        <ul>
            <li class="scroll-to-link active" data-target="content-get-bienvenidos">
                <a>BIENVENIDOS</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-buscar-codigo-postal">
                <a>Buscar un codigo postal</a>
            </li>
            <li class="scroll-to-link" data-target="content-get-estados">
                <a>Obtener Estados</a>
            </li>
            <li class="scroll-to-link" data-target="content-errors">
                <a>Errors</a>
            </li>
        </ul>
    </div>
</div>
<div class="content-page">
    <div class="content-code"></div>
    <div class="content">
        <div class="overflow-hidden content-section" id="content-get-bienvenidos">
            <h1>Bienvenidos</h1>
            <pre>
    API Endpoint

    http://api.codigospostales.test/v1
                </pre>
            <p>
                La API es una herramienta para poder obtener informacion de los codigos postales de México actualizados.
            </p>
            <p>
                Para usar la API usted necesita una <strong>API key</strong>. favor se solicitarla a <a href="mailto:dragon.binario@gmail.com">Fernando Ruiz</a>
            </p>
        </div>
        <div class="overflow-hidden content-section" id="content-get-buscar-codigo-postal">
            <h2>Buscar un codigo postal</h2>
            <pre><code class="bash">
# un ejemplo de como usar la API en curl
curl \
-X POST http://api.codigospostales.test/v1/codigo_postal \
-F 'api_key=tu_api_key' \
-F 'codigo_postal=06470' \
                </code></pre>
            <p>
                Para buscar un codigo postal se necesita hacer una llamada POST a la siguiente url :<br>
                <code class="higlighted break-word">http://api.codigospostales.test/v1/codigo_postal</code>
            </p>
            <br>
            <pre><code class="json">
Respuesta :

{
    "data": [
        {
            "codigo_postal": "06470",
            "asentamiento": "San Rafael",
            "tipo_asentamiento": "Colonia",
            "municipio": "Cuauhtémoc",
            "estado": "Ciudad de México",
            "ciudad": "Ciudad de México"
        }
    ]
}
                </code></pre>
            <h4>PARAMETROS</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>api_key</td>
                    <td>String</td>
                    <td>Tu API key.</td>
                </tr>
                <tr>
                    <td>codigo_postal</td>
                    <td>numerico</td>
                    <td>El codigo postal a buscar debe ser de 5 digitos</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-get-estados">
            <h2>Obtener Estados</h2>
            <pre><code class="bash">
# un ejemplo de como usar la API en curl
curl \
-X POST http://api.codigospostales.test/v1/estados \
-F 'api_key=tu_api_key' \
                </code></pre>
            <p>
                Para obtener los estados se debe enviar una peticion POST a la siguiente liga :<br>
                <code class="higlighted break-word">http://api.codigospostales.test/v1/estados</code>
            </p>
            <br>
            <pre><code class="json">
Respuesta :

{
    "data": {
        "estados": [
            "Aguascalientes",
            "Baja California",
            "Baja California Sur",
            "Campeche",
            "Chiapas",
            "Chihuahua",
            "Ciudad de México",
            "Coahuila de Zaragoza",
            "Colima",
            ...
            ...
            ...
        ]
    }
}
                </code></pre>
            <h4>PARAMETROS</h4>
            <table class="central-overflow-x">
                <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>api_key</td>
                    <td>String</td>
                    <td>Tu API key.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-errors">
            <h2>Errors</h2>
            <p>
                The Westeros API uses the following error codes:
            </p>
            <table>
                <thead>
                <tr>
                    <th>Error Code</th>
                    <th>Meaning</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>X000</td>
                    <td>
                        Some parameters are missing. This error appears when you don't pass every mandatory parameters.
                    </td>
                </tr>
                <tr>
                    <td>X001</td>
                    <td>
                        Unknown or unvalid <code class="higlighted">secret_key</code>. This error appears if you use an unknow API key or if your API key expired.
                    </td>
                </tr>
                <tr>
                    <td>X002</td>
                    <td>
                        Unvalid <code class="higlighted">secret_key</code> for this domain. This error appears if you use an  API key non specified for your domain. Developper or Universal API keys doesn't have domain checker.
                    </td>
                </tr>
                <tr>
                    <td>X003</td>
                    <td>
                        Unknown or unvalid user <code class="higlighted">token</code>. This error appears if you use an unknow user <code class="higlighted">token</code> or if the user <code class="higlighted">token</code> expired.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="content-code"></div>
</div>
<script src="js/script.js"></script>
</body>
</html>