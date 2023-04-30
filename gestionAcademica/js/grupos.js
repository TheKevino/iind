
function agregarGrupo(){
    
    let selectCarrera = document.getElementById('selectCarrera').value;
    let clave = document.getElementById('clave').value;
    let nombreGrupo = document.getElementById('nombre').value;

    if(nombreGrupo.length < 1 || clave.length < 1){
        alert("Faltan campos por llenar");
        e.preventDefault();
    } else {

        //para mandar la informacion a php
        $.post('gestionAcademica/controller/agregarGrupo.php', { selectCarrera: selectCarrera,
            clave: clave, nombre: nombreGrupo }, function(data){

                if(data!=null){
                    alert("Grupo guardado");
                    document.getElementById('clave').value = "";
                    document.getElementById('nombre').value = "";
                } else{
                    alert("Error guardando al grupo");
                }

        });

    }

}