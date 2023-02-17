var selectMateria = document.getElementById("selectMateria");

$(document).ready(function(){
    var idMateria = document.getElementById("selectMateria").value.split('_');
    obtener_carrera(idMateria[0]);
    obtener_grupo(idMateria[1]);
});

selectMateria.addEventListener("change", ()=>{
    var idMateria = document.getElementById("selectMateria").value.split('_');
    obtener_carrera(idMateria[0]);
    obtener_grupo(idMateria[1]);
});

function obtener_carrera(idMateria){
    $.ajax({
        url: '../controller/peticion_carrera.php',
        type: 'POST',
        dataType: 'html',
        data: { idMateria: idMateria }
    })
    .done(function(resultado){
        $("#carrera").html(resultado);
    });
}

function obtener_grupo(idGrupo){
    $.ajax({
        url: '../controller/peticion_grupo.php',
        type: 'POST',
        dataType: 'html',
        data: { idGrupo: idGrupo }
    })
    .done(function(resultado){
        $("#grupo").html(resultado);
    });
}