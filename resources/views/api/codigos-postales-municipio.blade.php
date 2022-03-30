<div class="overflow-hidden content-section" id="content-get-cp-municipio">
            <h2>Codigos Postales Municipio</h2>
            <pre><code class="bash">
# un ejemplo de como usar la API en curl
curl \
-X POST {{env('APP_URL')}}/v1/cp_municipio \
-F 'api_key=tu_api_key' \
-F 'municipio=El Llano' \
-F 'estado=Aguascalientes' \
                </code></pre>
            <p>
                Para obtener los cp de un estado y un municipio mandar la siguiente peticion :<br>
                <code class="higlighted break-word">http://api.codigospostales.test/v1/cp_municipio</code>
            </p>
            <br>
            <pre><code class="json">
Respuesta :

{
    "data": {
        "codigos_postales": [
            "20330",
            "20333",
            "20334",
            "20335",
            "20336",
            "20337",
            "20338",
            "20339"
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
                    <td>Estado</td>
                    <td>String</td>
                    <td>Estado a buscar</td>
                </tr>
                <tr>
                    <td>Municipio</td>
                    <td>String</td>
                    <td>Municipio a buscar</td>
                </tr>
                </tbody>
            </table>
        </div>