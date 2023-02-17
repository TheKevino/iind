let btnAgregarMateria = document.getElementById('btnAgregarMateria');

btnAgregarMateria.addEventListener('click', (e)=>{
    let clave = document.getElementById('claveMateria').value;
    let nombreMateria = document.getElementById('nombreMateria').value;

    if(nombreMateria.length < 1 || clave.length < 1){
        alert("Faltan campos por llenar");
        e.preventDefault();
    }

});