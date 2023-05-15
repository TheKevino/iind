$(document).on('click', '#btnBuscarUsuarioConsulta', buscarUsuarioConsulta)
$(document).on('keypress', '#buscador_usuario_consulta', function(event){
    if (event.key === "Enter") {
        buscarUsuarioConsulta();
    }
});

function obtener_registros_usuarios_consulta(usuarios){
    $.ajax({
        url: 'residencias/controller/peticion_usuarios.php',
        type: 'POST',
        dataType: 'html',
        data: { usuarios: usuarios }
    })
    .done(function(resultado){
        $("#tabla_usuarios_consulta").html(resultado);
    });
}

function buscarUsuarioConsulta(){
    var valorBusqueda = $(document.getElementById('buscador_usuario_consulta')).val();
    if(valorBusqueda != ""){
        obtener_registros_usuarios_consulta(valorBusqueda);
    } else{
        obtener_registros_usuarios_consulta();
    }
}