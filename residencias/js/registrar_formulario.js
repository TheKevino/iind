let productos = document.getElementById('comboProducto');
let producto;

var asesor = {
    id: null,
    nombre: null,
    correo: null
}

var revisor1 = {
    id: null,
    nombre: null,
    correo: null
}

var revisor2 = {
    id: null,
    nombre: null,
    correo: null
}
//metodos para que la tabla se recargue en tiempo real
function obtener_registros(usuarios) {
    $.ajax({
        url: 'residencias/controller/peticion_encargados.php',
        type: 'POST',
        dataType: 'html',
        data: { usuarios: usuarios }
    })
        .done(function (resultado) {
            $("#tabla_usuarios").html(resultado);
        });
}

$(document).on('click', '#btnBuscarUsuario', buscarUsuarioResidencias);
$(document).on('keypress', '#buscador_usuario', function(event){
    if (event.key === "Enter") {
        buscarUsuarioResidencias();
    }
});

function buscarUsuarioResidencias(){
    var valorBusqueda = $(document.getElementById('buscador_usuario')).val();
    if (valorBusqueda != "") {
        obtener_registros(valorBusqueda);
    } else {
        obtener_registros();
    }
}
//---------------------------------------------------------

productos.addEventListener('change', () => {
    producto = productos.value;

    if (producto == "otro") {
        document.getElementById('especifique').style.display = 'block';
    } else {
        document.getElementById('especifique').style.display = 'none';
    }

});

function paginaUno() {
    document.getElementById('containerForm').style.display = 'block';
    document.getElementById('containerTable').style.display = 'none';
}

function paginaDos() {
    document.getElementById('containerForm').style.display = 'none';
    document.getElementById('containerTable').style.display = 'block';
}

//funcion para mandar la informacion a php
function guardarFormulario() {

    //obteniendo las variables
    let paterno = document.getElementById('paterno').value;
    let materno = document.getElementById('materno').value;
    let nombres = document.getElementById('nombres').value;
    let nc = document.getElementById('nc').value;
    let nombreProyecto = document.getElementById('nombreProyecto').value;
    let producto_form
    //cambiando el valor si el producto es 'otro' o no
    if (producto == "otro") {
        producto_form = document.getElementById('esp').value;
    } else {
        producto_form = productos.value;
    }

    //verificanodo que los campos esten llenos
    if (paterno.length < 1 || materno.length < 1 || nombres.length < 1 || nombreProyecto.length < 1 || producto_form.length < 1) {

        Swal.fire({
            title: 'Error!',
            text: 'Faltan campos por llenar.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })

    } else if (nc.length != 8) {
        Swal.fire({
            title: 'Error!',
            text: 'Numero de control invalido.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else if (asesor['id'] == null && revisor1['id'] == null && revisor2['id'] == null) {
        Swal.fire({
            title: 'Error!',
            text: '"Favor de escoger minimo a un encargado."',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else {

        if (asesor['id'] == null) asesor['id'] = 1
        if (revisor1['id'] == null) revisor1['id'] = 1
        if (revisor2['id'] == null) revisor2['id'] = 1;

        //para mandar la informacion a php
        $.post('residencias/controller/alta_formulario.php', {
            paterno: paterno, materno: materno, nombres: nombres,
            nc: nc, nombreProyecto: nombreProyecto, producto: producto_form, idAsesor: asesor['id'],
            idRevisor1: revisor1['id'], idRevisor2: revisor2['id'], correoAsesor: asesor['correo'],
            correoRevisor1: revisor1['correo'], correoRevisor2: revisor2['correo']
        }, function (data) {

            if (data != null) {
                Swal.fire({
                    title: 'Éxito!',
                    text: 'Formulario guardado.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "redirection.php?op=5";
                    }
                })
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: '"Error guardando el formulario."',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }

        });

    }

}

function asignarAsesor(id, nombre, correo) {
    asesor['id'] = id;
    asesor['nombre'] = nombre;
    asesor['correo'] = correo;
    document.getElementById('asesor').value = asesor['nombre'];
}

function asignarRevisor1(id, nombre, correo) {
    revisor1['id'] = id;
    revisor1['nombre'] = nombre;
    revisor1['correo'] = correo;
    document.getElementById('revisor1').value = revisor1['nombre'];
}

function asignarRevisor2(id, nombre, correo) {
    revisor2['id'] = id;
    revisor2['nombre'] = nombre;
    revisor2['correo'] = correo;
    document.getElementById('revisor2').value = revisor2['nombre'];
}
