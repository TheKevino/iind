$(document).ready(obtener_registros());

function obtener_registros(usuarios){
    $.ajax({
        url: 'residencias/controller/peticion_usuarios.php',
        type: 'POST',
        dataType: 'html',
        data: { usuarios: usuarios }
    })
    .done(function(resultado){
        $("#tabla_usuarios").html(resultado);
    });
}

$(document).on('click', '#btnBuscarUsuario', function(){
    var valorBusqueda = $(document.getElementById('buscador_usuario')).val();
    if(valorBusqueda != ""){
        obtener_registros(valorBusqueda);
    } else{
        obtener_registros();
    }
})