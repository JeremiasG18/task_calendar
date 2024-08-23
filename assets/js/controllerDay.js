if (window.location.href.includes('view=calendar') || window.location.href == 'http://localhost/task_calendar/') {
    
    const inputCheck = document.querySelectorAll('.checkbox');
    inputCheck.forEach(checkbox =>{
        checkbox.addEventListener('click', ()=>{
            let checkboxClicked = parseInt(checkbox.value);
            let formData = new FormData();
            formData.append("accion", "guardarTareaRealizada");
            formData.append("checkbox", checkboxClicked);
            const url = 'http://localhost/task_calendar/controller/controlador.php';
            fetch(url,{
                method: 'POST',
                body: formData
            })
            // Herramienta de desarrollo --> controlar respuestas del servidor y errores de sintaxis
            // .then(respuesta => respuesta.json())
            // .then(data =>{
            //     console.log(`Respuesta del servidor: ${data.datos}`);
                
            // })
            // .catch(error =>{
            //     console.error(`No se ha podido mandar los datos al servidor por el error: ${error}`);
                
            // })
        })
    })
}

const obtenerDia = ()=>{
    let fechaActual = new Date();
    let año = fechaActual.getFullYear();
    let mes = fechaActual.getMonth() + 1;
    if (mes < 10) {
        mes = '0' + mes;
    }
    let dia = fechaActual.getDate();
    if (dia < 10) {
        dia = '0' + dia;
    }
    let fechaFormateada = `${año}-${mes}-${dia}`;

    let hora = fechaActual.getHours();
    let min = fechaActual.getMinutes();
    let seg = fechaActual.getSeconds();

    if (hora < 10) hora = '0' + hora;
    if (min < 10) min = '0' + min;
    if (seg < 10) seg = '0' + seg;

    let tiempoFormateado = `${hora}:${min}:${seg}`;
    const formData = new FormData();
    formData.append("fecha", fechaFormateada);
    formData.append("accion", "guardarDia");

    if (tiempoFormateado == '00:00:00') {
        let url = 'http://localhost/task_calendar/controller/controlador.php';
        fetch(url, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error("Error al enviar los datos:", error);
        });
    }

}

setInterval(() => {
    obtenerDia()
    
}, 1000);