$(document).on('click', '#btnBuscarClase', buscarClaseConsulta)
$(document).on('keypress', '#buscador_clase', function(event){
    if (event.key === "Enter") {
        buscarClaseConsulta();
    }
})

function obtener_registros(clases){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_clases.php',
        type: 'POST',
        dataType: 'html',
        data: { clases: clases }
    })
    .done(function(resultado){
        $("#tabla_clases").html(resultado);
    });
}

function buscarClaseConsulta(){
    var valorBusqueda = $(document.getElementById('buscador_clase')).val();
    if(valorBusqueda != ""){
        obtener_registros(valorBusqueda);
    } else{
        obtener_registros();
    }
}

function borrarClase(id){
    let respuesta = confirm("Seguro(a) que quieres eliminar la clase?");

    if(respuesta){
        $.ajax({
            url: 'gestionAcademica/controller/baja_clase.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id }
        })
        .done(function(){
            buscarClaseConsulta()
        });
    }

}