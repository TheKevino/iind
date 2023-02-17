$(document).ready(function(){
    $("#tabla").DataTable({
        "order": [[2, "asc"]],
			"language":{
				"lengthMenu": "Mostrar _MENU_ registros por pagina",
				"info": "Mostrando pagina _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros disponibles",
				"infoFiltered": "(filtrada de _MAX_ registros)",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search": "Buscar:",
				"zeroRecords":    "No se encontraron registros",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			},
      "bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "residencias/indexprocess.php"
    });
});