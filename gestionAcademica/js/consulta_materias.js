
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

$(document).on('click', '#btnBuscarMateria', function(){
    var valorBusqueda = $(document.getElementById('buscador_materia')).val();
    if(valorBusqueda != ""){
        obtener_registros_materias_consulta(valorBusqueda);
    } else{
        obtener_registros_materias_consulta();
    }
})