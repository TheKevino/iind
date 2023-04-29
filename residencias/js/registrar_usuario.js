function guardarUsuario(){

    //obteniendo las variables
    let paterno = document.getElementById('paterno').value;
    let materno = document.getElementById('materno').value;
    let nombres = document.getElementById('nombres').value;
    let email = document.getElementById('email').value;

    //verificanodo que los campos esten llenos
    if( paterno.length < 1 || materno.length < 1 || nombres.length < 1 ){
        alert("Faltan campos por llenar");
    } else {

        //para mandar la informacion a php
        $.post('residencias/controller/alta_usuario.php', { paterno:paterno, materno:materno, nombres:nombres,
            email:email }, function(data){

                if(data!=null){
                    alert("Usuario guardado");
                    document.getElementById('paterno').value = "";
                    document.getElementById('materno').value = "";
                    document.getElementById('nombres').value = "";
                    document.getElementById('email').value  = "";
                } else{
                    alert("Error guardando al usuario");
                }

        });
        
    }

}