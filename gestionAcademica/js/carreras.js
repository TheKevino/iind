function agregarCarrera(e){
    let carrera = document.getElementById('carrera').value;
    if (carrera.length < 1) {
        Swal.fire({
            title: 'Error!',
            text: 'Escribe el nombre de la carrera.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    } else if(!validarSoloLetras(carrera)){
        Swal.fire({
            title: 'Error!',
            text: 'Solo se permiten letras',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    } else {

        //para mandar la informacion a php
        $.post('gestionAcademica/controller/agregarCarrera.php', { carrera:carrera }, function(data){

                if(data!=null){
                    Swal.fire({
                        title: 'Ok',
                        text: 'Carrera registrada',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })

                    document.getElementById('carrera').value = "";
                } else{
                    alert("Error guardando a la carrera");
                }

        });

    }
}