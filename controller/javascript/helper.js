//operaciones para el formulario de agregar documento
const text = document.querySelector("#mensaje");
const charCount = document.getElementById('charCount');
const maximoCaracteres = 100;
text.addEventListener("keyup", () => {
    const caracteres = text.value.length;
    charCount.textContent = caracteres + ' / ' + maximoCaracteres + ' caracteres';
    if (caracteres >= maximoCaracteres) {
        text.value = text.value.substring(0, maximoCaracteres); // Trunca el texto al límite máximo de caracteres
        event.preventDefault(); // Evita que se agreguen más caracteres al textarea
        text.blur(); // Retira el enfoque del textarea para que no se pueda seguir escribiendo
    }
})


function VentanaEmergente() {
    document.getElementById('popup').style.display = 'block';
}

function CerrarEmergente() {
    document.getElementById('popup').style.display = 'none';
}
//se despliega el formulario para agregar
function ventanaFormulario(event) {
    event.preventDefault();
    document.getElementById('ventana').style.display = 'block';
}
//se cierra el formulario
function CerrarFormulario() {
    document.getElementById('ventana').style.display = 'none';
}
//operaciones para la eliminacion de documento
//metodo para hacer que solo se pueda selecionar un archivo
const checkboxes = document.querySelectorAll('.bt-5');
marcado = false;
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            // Desactivar los demás checkboxes
            marcado = checkbox;
            checkboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.disabled = true;
                }
            });
        } else {
            // Habilitar los demás checkboxes
            marcado = false;
            checkboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.disabled = false;
                }
            });
        }
    });
});

//clave para eliminar un documento
function Eliminar(event) {
    event.preventDefault();
    const formulario = document.querySelector("#FormularioEliminar"+marcado.value);
    
    if (marcado == false) {
        console.log(marcado);
        Swal.fire('Es necesario marcar un documento para borrar')
    } else {
        Swal.fire({
            icon: 'info',
            title: 'Esta seguro de que quiere eliminar el documentos?',
            showCancelButton: true,
            confirmButtonText: 'borrar',
          }).then((result) => {
            if (result.isConfirmed) {
              formulario.submit();
            } else if (result.isDenied) {
            
            }
          })
    }
}
//funciones para el boton modificar
function Modificar(event) {
    event.preventDefault();
    if(marcado!=false){
      formulario = document.querySelector("#FormularioEliminar"+marcado.value);
      console.log(formulario);
      h4= formulario.getElementsByClassName('NombreModifica');
      precioVenta =formulario.getElementsByClassName('PrecioVModificar');
      precioCosto= formulario.getElementsByClassName('PrecioModifica');
;     Descripcion = formulario.getElementsByClassName('descripcionModifi');
      tipo = formulario.getElementsByClassName('TipoModifica');
      
      nombre =  h4[0].textContent;
      valorcosto  = precioCosto[0].value;
      valorventa= precioVenta[0].textContent;
      informacion = Descripcion[0].value;
      ValorTipo = tipo[0].value;
      ventanaFormulario(event)

    }else{
        Swal.fire('Es necesario marcar un documento para modificarlo')   
    }
    
}