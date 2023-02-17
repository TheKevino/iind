let btnAgregarCarrera = document.getElementById('btnAgregarCarrera');

btnAgregarCarrera.addEventListener('click', (e)=>{
    let nombreCarrera = document.getElementById('carrera').value;
    if(nombreCarrera.length < 1){
        alert("Escribe el nombre de la carrera");
        e.preventDefault();
    }
});