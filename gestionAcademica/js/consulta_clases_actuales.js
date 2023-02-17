$(document).ready(obtener_registros());

function obtener_registros(clases){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_clases_actuales.php',
        type: 'POST',
        dataType: 'html',
        data: { clases: clases }
    })
    .done(function(resultado){
        $("#tabla_clases").html(resultado);
    });
}