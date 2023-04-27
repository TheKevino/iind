<?php

    $idUsuario = $user->getIdUsuario();
    $imagen = "residencias/img/image.jpg";
    $imagenQR = "residencias/img/image.jpg";

    $query = "SELECT firma, firmaQR FROM usuarios WHERE idUsuario = $idUsuario";
    $result = mysqli_query($conn, $query);

    if( mysqli_num_rows($result) == 1 ){

        $row = mysqli_fetch_array($result);
        if($row['firma']!=NULL){
            $imagen = "residencias/".$row['firma'];
        }
        if($row['firmaQR']!=NULL){
            $imagenQR = "residencias/".$row['firmaQR'];
        }
        
    }

?>
<div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 center">
                <form action="residencias/controller/subir_firma.php?id=<?php echo $idUsuario ?>" method="POST" enctype="multipart/form-data">
                    <div class="card card-body">
                        <h2>Subir firma</h2>
                        <input type="file" name="file">
                        <input type="submit" name="btnFirma" class="boton btn-consulta mt-3" value="Subir firma">
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-8">
                        <p>Firma</p>
                        <input type="image" class="mt-4" src="<?php echo $imagen ?>" heigth="200" width="200">
                    </div>
                </div>

            </div>

            <div class="col-md-4 center">
                <form action="residencias/controller/subir_firma.php?id=<?php echo $idUsuario ?>" method="POST" enctype="multipart/form-data">
                    <div class="card card-body">
                        <h2>Subir firma QR</h2>
                        <input type="file" name="file">
                        <input type="submit" name="btnFirmaQR" class="boton btn-consulta mt-3" value="Subir firma QR">
                    </div>
                </form>
                
                <div class="row">
                    <div class="col-md-8">
                        <p>Firma QR</p>
                        <input type="image" class="mt-4" src="<?php echo $imagenQR ?>" heigth="200" width="200">
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>