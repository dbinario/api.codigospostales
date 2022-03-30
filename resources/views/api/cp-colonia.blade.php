<div class="overflow-hidden content-section" id="content-get-colonia-cp">
            <h2>Codigos Postales Municipio</h2>
            <pre><code class="bash">
# un ejemplo de como usar la API en curl
curl \
-X POST {{env('APP_URL')}}/v1/cp_colonia \
-F 'api_key=tu_api_key' \
-F 'codigo_postal=11300' \
                </code></pre>
            <p>
                Para obtener los cp de un estado y un municipio mandar la siguiente peticion :<br>
                <code class="higlighted break-word">http://api.codigospostales.test/v1/cp_colonia</code>
            </p>
            <br>
            <pre><code class="json">
Respuesta :

{
    "data": {
        "colonias": [
            "Verónica Anzures"
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
                <tr>
                    <td>codigo_postal</td>
                    <td>numeric</td>
                    <td>Codigo Postal a Buscar</td>
                </tr>
                </tbody>
            </table>
        </div>