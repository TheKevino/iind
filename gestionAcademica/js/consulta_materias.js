$(document).on('click', '#btnBuscarMateria', buscarMateriaConsulta)
$(document).on('keypress', '#buscador_materia', function(event){
    if (event.key === "Enter") {
        buscarMateriaConsulta();
    }
})


function obtener_registros_materias_consulta(materias){
    $.ajax({
        url: 'gestionAcademica/controller/peticion_materias.php',
        type: 'POST',
        dataType: 'html',
        data: { materias: materias }
    })
    .done(function(resultado){
        $("#tabla_materias").html(resultado);
    });
}

function buscarMateriaConsulta(){
    var valorBusqueda = $(document.getElementById('buscador_materia')).val();
    if(valorBusqueda != ""){
        obtener_registros_materias_consulta(valorBusqueda);
    } else{
        obtener_registros_materias_consulta();
    }
}

function borrarMateria(id){
    let respuesta = confirm("Seguro(a) que quieres eliminar la asignatura?");

    if(respuesta){
        $.ajax({
            url: 'gestionAcademica/controller/baja_materia.php',
            type: 'POST',
            dataType: 'html',
            data: { id: id }
        })
        .done(function(){
            buscarMateriaConsulta()
        });
    }

}