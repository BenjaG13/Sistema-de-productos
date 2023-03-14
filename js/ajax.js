
const formularios_ajax = document.querySelectorAll(".formularioAjax");

function enviarFormulario(e) {
    e.preventDefault();

    let enviar = confirm("Quieres enviar el formulario?")

    if(enviar == true){

        let data = new FormData(this)
        let method = this.getAttribute("method")
        let action = this.getAttribute("action")

        let encabezados = new Headers()

        let config={
            method: method,
            headers: encabezados,
            mode: 'cors',
            cache: 'no-cache',
            body: data
        }

        fetch(action,config)
           .then(respuesta => respuesta.text())
           .then(respuesta => {
           let contenedor = document.querySelector('.formu');
           contenedor.innerHTML = respuesta;
        })
    }

}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit",enviarFormulario)
});