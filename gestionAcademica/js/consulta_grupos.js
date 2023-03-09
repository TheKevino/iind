function obtener_registros_grupo_consulta(grupos){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_grupos.php',
        type: 'POST',
        dataType: 'html',
        data: { grupos: grupos }
    })
    .done(function(resultado){
        $("#tabla_grupos_consulta").html(resultado);
    });
}

$(document).on('click', '#btnBuscarGrupoConsulta', function(){
    var valorBusqueda = $(document.getElementById('buscador_grupo_consulta')).val();
    if(valorBusqueda != ""){
        obtener_registros_grupo_consulta(valorBusqueda);
    } else{
        obtener_registros_grupo_consulta();
    }
})