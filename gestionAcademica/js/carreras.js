function agregarCarrera(){
    let carrera = document.getElementById('carrera').value;
    if(carrera.length < 1){
        alert("Escribe el nombre de la carrera");
        e.preventDefault();
    } else {

        //para mandar la informacion a php
        $.post('gestionAcademica/controller/agregarCarrera.php', { carrera:carrera}, function(data){

                if(data!=null){
                    alert("Carrera guardada");
                    document.getElementById('carrera').value = "";
                } else{
                    alert("Error guardando a la carrera");
                }

        });

    }
}