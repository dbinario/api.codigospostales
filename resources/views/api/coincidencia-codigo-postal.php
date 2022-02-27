<div class="overflow-hidden content-section" id="content-get-coincidencia-codigo-postal">
            <h2>Coincidencia codigo postal</h2>
            <pre><code class="bash">
# un ejemplo de como usar la API en curl
curl \
-X POST http://api.codigospostales.test/v1/buscar_cp \
-F 'api_key=tu_api_key' \
-F 'codigo_postal=0106' \
                </code></pre>
            <p>
                Para buscar una coincidencia con codigo postal enviar una peitcion POST a la siguiente URL :<br>
                <code class="higlighted break-word">http://api.codigospostales.test/v1/buscar_cp</code>
            </p>
            <br>
            <pre>
                <code class="json">
Respuesta:

{
    "data": {
        "codigos_postales": [
            "01060",
            "30106",
            "40106",
            "80106"
        ]
    }
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
                    <td>El codigo postal a buscar debe ser de 4 digitos</td>
                </tr>
                </tbody>
            </table>
        </div>