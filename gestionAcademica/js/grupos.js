
function agregarGrupo(e){
    
    let selectCarrera = document.getElementById('selectCarrera').value;
    let clave = document.getElementById('clave').value;
    let nombreGrupo = document.getElementById('nombre').value;

    if (nombreGrupo.length < 1 || clave.length < 1) {
        Swal.fire({
            title: 'Error!',
            text: 'Faltan campos por llenar.',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        e.preventDefault();
    } else {

        //para mandar la informacion a php
        $.post('gestionAcademica/controller/agregarGrupo.php', { selectCarrera: selectCarrera,
            clave: clave, nombre: nombreGrupo }, function(data){

                if(data!=null){

                    Swal.fire({
                        title: 'Guardado',
                        text: 'Grupo guardado',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })

                    document.getElementById('clave').value = "";
                    document.getElementById('nombre').value = "";
                } else{
                    alert("Error guardando al grupo");
                }

        });

    }

}