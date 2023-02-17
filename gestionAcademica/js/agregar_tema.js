var btnAgregar = document.getElementById('btnAgregarTema');

btnAgregar.addEventListener('click', (e)=>{
    let noTema = document.getElementById('noTema').value;
    let nombreTema = document.getElementById('nombreTema').value;
    let temasSubtemas = document.getElementById('temasSubtemas').value;
    let actsAprendizaje = document.getElementById('actsAprendizaje').value;
    let desCompGenericas = document.getElementById('desCompGenericas').value;
    let horas = document.getElementById('horas').value;

    if(noTema.length < 1 || nombreTema.length < 1 || temasSubtemas.length < 1 || actsAprendizaje.length < 1 ||
        desCompGenericas.length < 1 || horas.length < 1 ){

            alert("Faltan campos por llenar");
            e.preventDefault();

    }//fin if

});