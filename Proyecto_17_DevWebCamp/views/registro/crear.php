<main class="paquetes">
    <h2 class="paquetes__heading"><?php echo $titulo ?></h2>
    <p class="paquetes__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>

            <form action="/finalizar-registro/gratis" method="post">
                <input type="submit" class="paquetes__submit" value="Inscripcion Gratis">
            </form>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>


        </div>
    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AVzRG4PP36FsF_VVDXq5bLnZSGibRG21DLAhXxJjVL6r_U2sZNVMtHdzGJSF-kbsMtszcxOTfNZPeN9W"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'pay',
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "1",
                        "amount": {
                            "currency_code": "USD",
                            "value": 199
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    const datos = new FormData();
                    datos.append("paquete_id", orderData.purchase_units[0].description);
                    datos.append("pago_id", orderData.purchase_units[0].payments.captures[0].id);
                    fetch("/finalizar-registro/pagar", {
                            method: "POST",
                            body: datos
                        })
                        .then(respuesta => respuesta.json())
                        .then(resultado => {
                            if (resultado.resultado) {
                                window.location.href = "/finalizar-registro/conferencias";
                            }
                        })


                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }

    initPayPalButton();
</script>