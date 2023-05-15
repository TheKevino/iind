$(document).on('click', '#btnBuscarGrupoConsulta', buscarCarreraConsulta)
$(document).on('keypress', '#buscador_grupo_consulta', function(event){
    if (event.key === "Enter") {
        buscarCarreraConsulta();
    }
})

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

function buscarCarreraConsulta(){
    var valorBusqueda = $(document.getElementById('buscador_grupo_consulta')).val();
    if(valorBusqueda != ""){
        obtener_registros_grupo_consulta(valorBusqueda);
    } else{
        obtener_registros_grupo_consulta();
    }
}