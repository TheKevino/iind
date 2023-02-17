$(document).ready(obtener_registros());

function obtener_registros(materias){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_materias.php',
        type: 'POST',
        dataType: 'html',
        data: { materias: materias }
    })
    .done(function(resultado){
        $("#tabla_materias").html(resultado);
    });
}

$(document).on('click', '#btnBuscarMateria', function(){
    var valorBusqueda = $(document.getElementById('buscador_materia')).val();
    if(valorBusqueda != ""){
        obtener_registros(valorBusqueda);
    } else{
        obtener_registros();
    }
})