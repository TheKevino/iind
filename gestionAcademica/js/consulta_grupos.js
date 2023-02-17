$(document).ready(obtener_registros());

function obtener_registros(grupos){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_grupos.php',
        type: 'POST',
        dataType: 'html',
        data: { grupos: grupos }
    })
    .done(function(resultado){
        $("#tabla_grupos").html(resultado);
    });
}

$(document).on('click', '#btnBuscarGrupo', function(){
    var valorBusqueda = $(document.getElementById('buscador_grupo')).val();
    if(valorBusqueda != ""){
        obtener_registros(valorBusqueda);
    } else{
        obtener_registros();
    }
})