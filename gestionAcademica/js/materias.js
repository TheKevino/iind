function agregarMateria(e) {
    let selectCarrera = document.getElementById('selectCarrera').value;
    let clave = document.getElementById('claveMateria').value;
    let nombreMateria = document.getElementById('nombreMateria').value;
    let satca = document.getElementById('satca').value;
    let caracterizacion = document.getElementById('caracterizacion').value;
    let intencion = document.getElementById('intencion').value;
    let previas = document.getElementById('previas').value;
    let genericas = document.getElementById('genericas').value;
    let especificas = document.getElementById('especificas').value;
    let fuentes = document.getElementById('fuentes').value;
    let apDidacticos = document.getElementById('apDidacticos').value;

    if (nombreMateria.length < 1 || clave.length < 1 || satca.length < 1) {
        Swal.fire({
            title: 'Error!',
            text: 'Faltan campos por llenar.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    } else if(clave.length != 8){
        Swal.fire({
            title: 'Error!',
            text: 'Longitud invalida en la clave de la materia (deben ser 8 caracteres incluyendo el guión. Ej: YYY-1234)',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    } else if(satca.length !=5 ){
        Swal.fire({
            title: 'Error!',
            text: 'Longitud invalida en el SATCA (Deben ser 5 caracteres incluyendo guiones. Ej: Z-Z-Z)',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    } else {

        //para mandar la informacion a php
        $.post('gestionAcademica/controller/agregarMateria.php', {
            selectCarrera: selectCarrera, claveMateria: clave, nombreMateria: nombreMateria,
            satca: satca, caracterizacion: caracterizacion, intencion: intencion, previas: previas, genericas: genericas, especificas: especificas, fuentes: fuentes,
            apDidacticos: apDidacticos
        }, function (data) {

            if (data != null) {

                Swal.fire({
                    title: 'Ok',
                    text: 'Materia registrada',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
                
                document.getElementById('claveMateria').value = "";
                document.getElementById('nombreMateria').value = "";
                document.getElementById('satca').value = "";
                document.getElementById('caracterizacion').value = "";
                document.getElementById('intencion').value = "";
                document.getElementById('previas').value = "";
                document.getElementById('genericas').value = "";
                document.getElementById('especificas').value = "";
                document.getElementById('fuentes').value = "";
                document.getElementById('apDidacticos').value = "";
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error guardando la materia.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }

        });

    }
}