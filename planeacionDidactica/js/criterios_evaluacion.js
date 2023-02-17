var btnAgregar = document.getElementById("btnAgregar");

btnAgregar.addEventListener('click', (e) => {
    let evidencia = document.getElementById("evidencia").value;
    let porcentaje = document.getElementById("porcentaje").value;

    if(evidencia.length < 1 || porcentaje.length < 1){
        alert("Faltan campos por llenar.");
        e.preventDefault();
    } else if(isNaN(porcentaje)){
        alert("El porcentaje debe ser un numero.");
        e.preventDefault();
    } else if(porcentaje < 0){
        alert("El porcentaje debe ser positivo.");
        e.preventDefault();
    }
});