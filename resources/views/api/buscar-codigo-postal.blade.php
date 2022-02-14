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
            <pre>
                <code class="json">
Respuesta:

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
                </code>
            </pre>
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
                    <td>Numeric</td>
                    <td>El codigo postal a buscar debe ser de 5 digitos</td>
                </tr>
                </tbody>
            </table>
        </div>