$(document).on('click', '#btnBuscarCarrera', buscarCarreraConsulta)
$(document).on('keypress', '#buscador_carrera', function(event){
    if (event.key === "Enter") {
        buscarCarreraConsulta();
    }
})

function obtener_registros_carreras_consulta(carreras){
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

function buscarCarreraConsulta(){
    var valorBusqueda = $(document.getElementById('buscador_carrera')).val();
    if(valorBusqueda != ""){
        obtener_registros_carreras_consulta(valorBusqueda);
    } else{
        obtener_registros_carreras_consulta();
    }
}

function borrarCarrera(id){
    let respuesta = confirm("Seguro(a) que quieres eliminar la carrera?");

    if(respuesta){
        $.ajax({
            url: 'gestionAcademica/controller/bajaCarrera.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id }
        })
        .done(function(){
            buscarCarreraConsulta()
        });
    }

}