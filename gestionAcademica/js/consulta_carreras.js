$(document).ready(obtener_registros());

function obtener_registros(carreras){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_carreras.php',
        type: 'POST',
        dataType: 'html',
        data: { carreras: carreras }
    })
    .done(function(resultado){
        $("#tabla_carreras").html(resultado);
    });
}

$(document).on('click', '#btnBuscarCarrera', function(){
    var valorBusqueda = $(document.getElementById('buscador_carrera')).val();
    if(valorBusqueda != ""){
        obtener_registros(valorBusqueda);
    } else{
        obtener_registros();
    }
})