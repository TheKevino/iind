<?php
include('../../includes/db.php');

$idFormulario = $_GET['id'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$nombres = $_POST['nombres'];
$noControl = $_POST['nc'];
$nombreProyecto = $_POST['nombreProyecto'];
$producto = $_POST['comboProductoo'];

if($producto=="otro"){
    $producto = $_POST['esp'];
}

$query = "UPDATE formularios SET paternoAlumno = '$paterno', maternoAlumno = '$materno', nombresAlumno = '$nombres',
        noControl='$noControl', nombreProyecto='$nombreProyecto', producto='$producto' WHERE idFormulario=$idFormulario";
$result = mysqli_query($conn, $query);

if(!$result){
    die("Error");
}

header("Location: ../../redirection.php?op=index");

?>