let productos = document.getElementById('comboProductoo');
let producto;
let boton = document.getElementById('btnEditar');

productos.addEventListener('change', ()=>{
    producto = productos.value;

    if(producto == "otro"){
        document.getElementById('especifique').style.display = 'block';
    } else{
        document.getElementById('especifique').style.display = 'none';
        document.getElementById('esp').value="";
    }

});


boton.addEventListener('click', (event)=>{

    //obteniendo las variables
let paterno = document.getElementById('paterno').value;
let materno = document.getElementById('materno').value;
let nombres = document.getElementById('nombres').value;
let nc = document.getElementById('nc').value;
let nombreProyecto = document.getElementById('nombreProyecto').value;
let producto_form
//cambiando el valor si el producto es 'otro' o no
if(producto == "otro"){
    producto_form = document.getElementById('esp').value;
} else{
    producto_form = productos.value;
}

//verificanodo que los campos esten llenos
if( paterno.length < 1 || materno.length < 1 || nombres.length < 1 || nombreProyecto.length < 1 || producto_form.length < 1){

    event.preventDefault();
    alert("Faltan campos por llenar");
    
} else if( nc.length !=8 ){
    event.preventDefault();
    alert("Numero de control invalido");
} else{
    alert("Se ha editado el formulario");
}

});