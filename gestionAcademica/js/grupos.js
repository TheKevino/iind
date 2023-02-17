let btnAgregarGrupo = document.getElementById('btnAgregarGrupo');

btnAgregarGrupo.addEventListener('click', (e)=>{
    let clave = document.getElementById('clave').value;
    let nombreGrupo = document.getElementById('nombre').value;

    if(nombreGrupo.length < 1 || clave.length < 1){
        alert("Faltan campos por llenar");
        e.preventDefault();
    }

});