const forms = document.querySelectorAll('.form');

forms.forEach(form => {
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        
        const formData = new FormData(form);
        const url = form.action
        fetch(url,{
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Procesa la respuesta como texto
        .then(data => {
            console.log('Respuesta del servidor:', data); // Muestra la respuesta del servidor en la consola
        })
        .catch(error => {
            console.error('Error:', error); // Manejo de errores
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
}

configCheckbox();