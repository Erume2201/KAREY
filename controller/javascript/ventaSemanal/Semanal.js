clientes = document.querySelectorAll('.nombrewhat');
seleccion = document.querySelector("#ClienteWha");
function DatosWhatsApp() {
    document.getElementById('datosWhatsApp').style.display = 'block';
    llenarCamposEnvio();


}

function CerrarWhatsApp() {
    document.getElementById('datosWhatsApp').style.display = 'none';
}

function llenarCamposEnvio() {
    let opcionesHTML = '<option value="0"> Seleciona un cliente</option>';;
    clientes.forEach(function (cliente) {
        opcionesHTML += '<option  value="' + cliente.id + '">' + cliente.value + '</option>';
    });
    seleccion.innerHTML = opcionesHTML;
}

seleccion.addEventListener('change', function () {
    var selectedValue = seleccion.value;
    // Aquí puedes ejecutar acciones adicionales según la selección del usuario
    cel = document.querySelector("#cel" + selectedValue);
    Numero = document.querySelector("#NumeroCliente");
    Enviar = document.querySelector("#NumeroRecivido");
    if (selectedValue == 0) {
        console.log(selectedValue);
        Numero.textContent = "";
        Enviar.value = 0;
    } else {
        Numero.textContent = cel.value;
        Enviar.value = cel.value;
        console.log(cel.value);
    }
});

function EjecutarWhat() {
    Enviar = document.querySelector("#NumeroRecivido");
    if (Enviar.value == 0) {
        Alerta = document.querySelector("#Alerta");
        Alerta.innerHTML = `<div class="alert alert-danger" role="alert">
                                Primero debe de escoger el cliente!
                            </div>`
    } else {
        MandarMensaje = document.querySelector("#DatosWhatsApp");
        MandarMensaje.submit();
    }
}