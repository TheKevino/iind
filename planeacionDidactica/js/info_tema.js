var btnAgregar = document.getElementById("btnAgregarInfo");

btnAgregar.addEventListener('click', (e) => {
    let opUno = document.getElementById("opUno").value;
    let opDos = document.getElementById("opDos").value;

    if( isNaN(opUno) || isNaN(opDos) ){
        alert("Porcentajes invalidos");
        e.preventDefault();
    } else if( opUno < 0 || opDos < 0 ){
        alert("Porcentajes negativos");
        e.preventDefault();
    }
});