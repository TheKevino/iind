<?php
    include("includes/db.php");

    if(!isset($_SESSION['user']) || $user->getTipo()!=1){
        header('Location: ../../login.php');
    }

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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Consulta usuarios</title>
    <link rel="stylesheet" href="residencias/css/jquery-ui.css">
    <script src="residencias/js/jquery-ui.js"></script>
    <script src="residencias/js/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="residencias/css/login.css">
    <link rel="stylesheet" href="css/paleta.css" />
    <link rel="stylesheet" href="css/tablas.css" />
</head>
<body>

    <!-- Navbar -->
  <?php include('user_navigator.php'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 center">
            <form action="residencias/controller/subir_firma.php?id=<?php echo $idUsuario ?>" method="POST" enctype="multipart/form-data">
                <div class="card card-body">
                    <h2>Subir firma</h2>
                    <input type="file" name="file">
                    <input type="submit" name="btnFirma" class="btn btn-principal boton mt-4" value="Subir firma">
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
                    <input type="submit" name="btnFirmaQR" class="btn btn-principal boton mt-4" value="Subir firma QR">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>

</body>
</html>