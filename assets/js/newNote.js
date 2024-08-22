if (window.location.href.includes('view=newTask')) {

    const forms = document.querySelectorAll('.form');

    forms.forEach(form => {
        form.addEventListener('submit',(e)=>{
            e.preventDefault();
            Swal.fire({
                title: "Estas seguro?",
                text: "Deseas agregar la tarea!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si deseo agregar la tarea!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);
                    const url = form.action
                    fetch(url,{
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json()) // Procesa la respuesta como texto
                    .then(data => {
                        if (data.icon === 'success') {
                            Swal.fire({
                                title: data.title,
                                text: data.text,
                                icon: data.icon
                            }).then(() => {
                                // Redirigir a la URL proporcionada en data.url
                                window.location.href = data.url;
                            });
                        } else {
                            Swal.fire({
                                title: data.title,
                                text: data.text,
                                icon: data.icon
                            });
                        }
                    })                
                    .catch(error => {
                        console.error('Error:', error); // Manejo de errores
                    });
                }
            });
        })
        
    });

    const checkboxEday = document.getElementById('everyDay');
    const day = document.querySelectorAll('.checkbox');
    const inputDate = document.getElementById('dia');

    const configCheckbox = ()=>{
        checkboxEday.addEventListener('click', ()=>{
            
            day.forEach(element => {
                element.checked = true;
            });
        })
        
        day.forEach(dia => {
            dia.addEventListener('click',()=>{
                if (checkboxEday.checked === true) {
                    checkboxEday.checked = false;
                }
                let cont = 0;
                day.forEach(dia => {
                    if (dia.checked === true) {
                        cont++;
                    }
                });
                if (cont === 7) {
                    checkboxEday.checked = true;
                } 
            }); 
        });
        
        addEventListener('click', ()=>{
            let contCheckboxFalse = 0;
            
            day.forEach(checkeoDia =>{
                if (checkeoDia.checked === false) {
                    contCheckboxFalse++;
                }
                if (contCheckboxFalse !== 7 || checkboxEday.checked === true) {
                    inputDate.disabled = true;
                }else{
                    inputDate.disabled = false;
                }
            });
        });

        inputDate.addEventListener('input', ()=>{
            day.forEach(dia => {
                dia.disabled = true;
                checkboxEday.disabled = true;
            });
        })
        
    }

    configCheckbox();

}