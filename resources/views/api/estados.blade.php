<div class="overflow-hidden content-section" id="content-get-estados">
            <h2>Obtener Estados</h2>
            <pre><code class="bash">
# un ejemplo de como usar la API en curl
curl \
-X POST {{env('APP_URL')}}/v1/estados \
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