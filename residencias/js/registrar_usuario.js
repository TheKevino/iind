function guardarUsuario() {

    //obteniendo las variables
    let paterno = document.getElementById('paterno').value;
    let materno = document.getElementById('materno').value;
    let nombres = document.getElementById('nombres').value;
    let email = document.getElementById('email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    //verificanodo que los campos esten llenos
    if (paterno.length < 1 || materno.length < 1 || nombres.length < 1) {
        Swal.fire({
            title: 'Error!',
            text: 'Faltan campos por llenar.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else if( email.length > 0 && !emailRegex.test(email) ){
        Swal.fire({
            title: 'Error!',
            text: 'Formato de correo incorrecto.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    } else {
        //para mandar la informacion a php
        $.post('residencias/controller/alta_usuario.php', {
            paterno: paterno, materno: materno, nombres: nombres,
            email: email
        }, function (data) {

            if (data != null) {
                Swal.fire({
                    title: 'Ok',
                    text: 'Usuario registrado',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
                document.getElementById('paterno').value = "";
                document.getElementById('materno').value = "";
                document.getElementById('nombres').value = "";
                document.getElementById('email').value = "";
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error guardando al usuario.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }

        });

    }

}