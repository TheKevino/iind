// selecciona todos los elementos cuyos ID empiezan con "index"
var elementos_index = $('[id^="index-"]');

function buscarElemento(id){

  elementos_index.map(function() {
    if(this.id == id){
      $(this).css({
        "visibility": "visible",
        "display" : "block"
      });
    } else {
      $(this).css({
        "visibility": "hidden",
        "display" : "none"
      });
    }
  });

}

$('#residencias').click(function(){ buscarElemento("index-residencias") });
$('#planeacion').click(function(){ buscarElemento("index-planeacion") });
$('#reportes').click(function(){ buscarElemento("index-reporte") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#encargados').click(function(){ buscarElemento("index-encargados") });
$('#registrar-usuario').click(function(){ buscarElemento("index-registrar-usuarios") });
$('#consultar-usuario').click(function(){ buscarElemento("index-consultar-usuarios") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#crear-clase').click(function(){ buscarElemento("index-crear-clase") });
$('#consultar-clase').click(function(){ buscarElemento("index-consultar-clase") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#agregar-materia').click(function(){ buscarElemento("index-agregar-materia") });
$('#consultar-materia').click(function(){ buscarElemento("index-consultar-materia") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#agregar-carrera').click(function(){ buscarElemento("index-agregar-carrera") });
$('#consultar-carrera').click(function(){ buscarElemento("index-consultar-carrera") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#agregar-grupo').click(function(){ buscarElemento("index-agregar-grupo") });
$('#consultar-grupo').click(function(){ buscarElemento("index-consultar-grupo") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#clases').click(function(){ buscarElemento("index-clases-actuales") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------

$('#firma').click(function(){ buscarElemento("index-firma") });

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------