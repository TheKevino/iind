<?php

include('../../includes/db.php');
$idUsuario = $_GET['id'];

if(isset($_POST['update_password'])){

    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $confirmNewPass = $_POST['confirmNewPass'];

    if(empty($oldPass) || empty($newPass) || empty($confirmNewPass)){
        header("Location: ../redirection.php?op=4");
    }

    #Verificar que la pass actual sea correcta
    $query = "SELECT password FROM usuarios WHERE idUsuario=$idUsuario";
    $result = mysqli_query($conn, $query);

    if( mysqli_num_rows($result) == 1 ){
        $row = mysqli_fetch_array($result);
        $passVieja =$row['password'];
        if($row['password']!=$oldPass){
            header("Location: ../redirection.php?op=4");
        }
        
    }

    if($newPass != $confirmNewPass){
        header("Location: ../redirection.php?op=4");
    } 
    if($newPass == $confirmNewPass && $oldPass == $passVieja){
        $query = "UPDATE usuarios SET password = '$newPass' WHERE idUsuario=$idUsuario";
        $result = mysqli_query($conn, $query);
        header("Location: ../redirection.php?op=0");
    }
}

?>