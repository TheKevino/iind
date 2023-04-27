<?php

include('../../includes/db.php');

$id = $_GET['id'];
$directorio = "firmas/";
$archivo = $directorio.$id. basename($_FILES["file"]["name"]);

$tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
$size = getimagesize($_FILES["file"]["tmp_name"]); #Sirve para ver si es una imagen

    if($size!=false || !empty($size)){

        if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "png"){

            if(move_uploaded_file($_FILES["file"]["tmp_name"], "../".$archivo)){

                if(isset($_POST['btnFirma'])){
                    $query = "SELECT firma FROM usuarios WHERE idUsuario = $id";
                    $query2 = "UPDATE usuarios SET firma = '$archivo' WHERE idUsuario = $id ";
                }
                
                if(isset($_POST['btnFirmaQR'])){
                    $query = "SELECT firmaQR FROM usuarios WHERE idUsuario = $id";
                    $query2 = "UPDATE usuarios SET firmaQR = '$archivo' WHERE idUsuario = $id ";
                }

                #Borrar el archivo antiguo
                $result = mysqli_query($conn, $query);

                if( mysqli_num_rows($result) == 1 ){
                    $row = mysqli_fetch_array($result);
                    if($row['firma']!=NULL){
                        unlink("../".$row['firma']);
                    }
                    
                }
                
                #subir el archivo nuevo
                $result = mysqli_query($conn, $query2);
                if(!$result){
                    die("Query failed");
                } else{
                    header("Location: ../../redirection.php");
                }

            } else{
                echo "Ocurrio un error";
            }

        } else{
            echo "Solo se permiten archivos JPG, JPEG, y PNG.";
        }

    } else{
        echo "El documento no es una imagen";
    }

?>