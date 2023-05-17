$(document).on('click', '#btnBuscarGrupoConsulta', buscarGrupoConsulta)
$(document).on('keypress', '#buscador_grupo_consulta', function(event){
    if (event.key === "Enter") {
        buscarGrupoConsulta();
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

function buscarGrupoConsulta(){
    var valorBusqueda = $(document.getElementById('buscador_grupo_consulta')).val();
    if(valorBusqueda != ""){
        obtener_registros_grupo_consulta(valorBusqueda);
    } else{
        obtener_registros_grupo_consulta();
    }
}

function borrarGrupo(id){
    let respuesta = confirm("Seguro(a) que quieres eliminar al grupo?");

    if(respuesta){
        $.ajax({
            url: 'gestionAcademica/controller/baja_grupo.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id }
        })
        .done(function(){
            buscarGrupoConsulta()
        });
    }

}