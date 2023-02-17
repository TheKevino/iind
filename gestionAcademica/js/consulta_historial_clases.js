$(document).ready(obtener_registros());

function obtener_registros(clases){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_historial_clases.php',
        type: 'POST',
        dataType: 'html',
        data: { clases: clases }
    })
    .done(function(resultado){
        $("#tabla_clases").html(resultado);
    });
}

$(document).on('click', '#btnBuscarClase', function(){
    var valorBusqueda = $(document.getElementById('buscador_clases')).val();
    if(valorBusqueda != ""){
        obtener_registros(valorBusqueda);
    } else{
        obtener_registros();
    }
})