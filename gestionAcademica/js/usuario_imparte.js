// --------VARIABLES DE LOS CONTENEDORES------------------
let containerDocentes = document.getElementById('containerDocentes');
let containerMaterias = document.getElementById('containerMaterias');
let containerGrupos = document.getElementById('containerGrupos');
let containerGuardar = document.getElementById('containerGuardar');
let containerTable = document.getElementById('containerTable');

//----------OBJETOS A UTILIZAR --------------------------
var docente = {
    id: null,
    nombre: null
}

var materia = {
    id: null,
    nombre: null
}

var grupo = {
    id: null,
    nombre: null,
    clave: null
}

//---------- CAMBIO DE PAGINAS --------------------------
function paginaDocentes() {
    containerDocentes.style.display = 'block';
    containerMaterias.style.display = 'none';
    containerGrupos.style.display = 'none';
    containerGuardar.style.display = 'block';
    containerTable.style.display = 'block';
}

function paginaMaterias() {
    containerDocentes.style.display = 'none';
    containerMaterias.style.display = 'block';
    containerGrupos.style.display = 'none';
    containerGuardar.style.display = 'block';
    containerTable.style.display = 'block';
}

function paginaGrupos() {
    containerDocentes.style.display = 'none';
    containerMaterias.style.display = 'none';
    containerGrupos.style.display = 'block';
    containerGuardar.style.display = 'block';
    containerTable.style.display = 'block';
}

//---------PARA LA TABLA DE USUARIOS/DOCENTES-----------------
//metodos para que la tabla se recargue en tiempo real
function obtener_registros_usuarios(usuarios) {
    $.ajax({
        url: 'gestionAcademica/controller/peticion_docentes.php',
        type: 'POST',
        dataType: 'html',
        data: { usuarios: usuarios }
    })
        .done(function (resultado) {
            $("#tabla_usuarios_clases").html(resultado);
        });
}

$(document).on('click', '#btnBuscarUsuarioClase', buscarUsuarioClase);
$(document).on('keypress', '#buscador_usuario_clase', function(event){
    if (event.key === "Enter") {
        buscarUsuarioClase();
    }
});

function buscarUsuarioClase(){
    var valorBusqueda = $(document.getElementById('buscador_usuario_clase')).val();
    if (valorBusqueda != "") {
        obtener_registros_usuarios(valorBusqueda);
    } else {
        obtener_registros_usuarios();
    }
}

//---------PARA LA TABLA DE ASIGNATURAS-----------------

function obtener_registros_materia(materias) {
    $.ajax({
        url: 'gestionAcademica/controller/peticion_asignaturas.php',
        type: 'POST',
        dataType: 'html',
        data: { materias: materias }
    })
        .done(function (resultado) {
            $("#tabla_materia").html(resultado);
        });
}

$(document).on('click', '#btnBuscarMateriaImparte', buscarMateriaClase);
$(document).on('keypress', '#buscador_materia_imparte', function(event){
    if (event.key === "Enter") {
        buscarMateriaClase();
    }
});

function buscarMateriaClase(){
    var valorBusqueda = $(document.getElementById('buscador_materia_imparte')).val();
    if (valorBusqueda != "") {
        obtener_registros_materia(valorBusqueda);
    } else {
        obtener_registros_materia();
    }
}

//---------PARA LA TABLA DE GRUPOS-----------------

function obtener_registros_grupo(grupos) {
    $.ajax({
        url: 'gestionAcademica/controller/peticion_gruposAsignar.php',
        type: 'POST',
        dataType: 'html',
        data: { grupos: grupos }
    })
        .done(function (resultado) {
            $("#tabla_grupos").html(resultado);
        });
}

$(document).on('click', '#btnBuscarGrupoImparte', buscarGrupoClase);
$(document).on('keypress', '#buscador_grupo_imparte', function(event){
    if (event.key === "Enter") {
        buscarGrupoClase();
    }
});

function buscarGrupoClase(){
    var valorBusqueda = $(document.getElementById('buscador_grupo_imparte')).val();
    if (valorBusqueda != "") {
        obtener_registros_grupo(valorBusqueda);
    } else {
        obtener_registros_grupo();
    }
}

//-----------ASIGNAR ELEMENTOS ------------
function asignarDocente(id, nombre) {
    docente['id'] = id;
    docente['nombre'] = nombre;
    document.getElementById('docente').value = docente['nombre'];
}

function asignarMateria(id, nombre) {
    materia['id'] = id;
    materia['nombre'] = nombre;
    document.getElementById('asignatura').value = materia['nombre'];
}

function asignarGrupo(id, nombre, clave) {
    grupo['id'] = id;
    grupo['nombre'] = nombre;
    grupo['clave'] = clave;
    document.getElementById('grupo').value = grupo['nombre'] + " (" + grupo['clave'] + ")";
}

//------------GUARDAR FORMULARIO-------------
function guardarClase() {
    let fecha_inicio = document.getElementById('fecha_inicio').value;
    let fecha_fin = document.getElementById('fecha_fin').value;

    if (docente['id'] == null || materia['id'] == null || grupo['id'] == null || grupo['id'] == null) {
        Swal.fire({
            title: 'Error!',
            text: 'Faltan datos por seleccionar.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else if (fecha_inicio == null || fecha_fin == null) {
        Swal.fire({
            title: 'Error!',
            text: 'Falta seleccionar las fechas.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else if (fecha_inicio >= fecha_fin) {
        Swal.fire({
            title: 'Error!',
            text: 'Fechas invalidas.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else {
        //para mandar la informacion a php
        $.post('gestionAcademica/controller/alta_clase.php', {
            docente: docente['id'], asignatura: materia['id'], grupo: grupo['id'],
            fecha_inicio: fecha_inicio, fecha_final: fecha_fin
        }, function (data) {

            if (data != null) {
                
                Swal.fire({
                    title: 'Ok!',
                    text: 'Clase guardada',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })

                asignarDocente(null, null);
                asignarMateria(null, null);
                asignarGrupo(null, null, null);

                document.getElementById("buscador_usuario_clase").value = "";
                document.getElementById("buscador_materia_imparte").value = "";
                document.getElementById("buscador_grupo_imparte").value = "";

                document.getElementById("docente").value = "Sin asignar";
                document.getElementById("asignatura").value = "Sin asignar";
                document.getElementById("grupo").value = "Sin asignar";

            } else {
                alert("Error guardando la clase");
            }

        });
    }
} //fin metodo