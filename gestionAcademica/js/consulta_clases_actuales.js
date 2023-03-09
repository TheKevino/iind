$(document).ready(obtener_registros_clases_actuales());

function obtener_registros_clases_actuales(clases){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_clases_actuales.php',
        type: 'POST',
        dataType: 'html',
        data: { clases: clases }
    })
    .done(function(resultado){
        $("#tabla_clases_actuales").html(resultado);
    });
}