<?php

  if(!isset($_SESSION['user'])){
    header('Location: login.php');
  }

  include_once('includes/user.php');
  include("includes/db.php");

  $query = "SELECT * FROM carreras";

  $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="residencias/img/favicon.ico" />
    <title>Agregar Grupo</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="gestionAcademica/css/Styleform.css">
    
        <!-- Extend Icon -->
        <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  
</head>
<body>

<?php include('navigator.php'); ?>

    <form class="formulario" action="gestionAcademica/controller/agregarGrupo.php" method="POST">
        <h1>Grupo</h1>
        <div class="imgposition">
          <img class="imgicon-form" src="/img/login/iconuser.png" alt="">
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-message icon"></i>

          <select name="selectCarrera" id="selectCarrera" >
            <!-- PARTE PARA LLENAR EL SELECT DEL FORMULARIO CON LAS CARRERAS -->
            <?php while($row = mysqli_fetch_array($result)){ ?>

              <option value=<?= $row['idCarrera']; ?>><?= $row['nombre']; ?></option>
                        
            <?php } ?>

          </select>
        </div>
  
          <div class="input-contenedor">
            <i class="fa-solid fa-key icon"></i>
            <input type="text" placeholder="Clave del grupo" name="clave" id="clave" />
          </div>

          <div class="input-contenedor">
            <i class="fa-solid fa-message icon"></i>
            <input type="text" placeholder="Nombre del grupo" name="nombre" id="nombre" />
          </div>

        </div>
        <div class="contenedorbtn">
          <input type="submit" value="Agregar" class="button" name="btnAgregarGrupo" id="btnAgregarGrupo">
        </div>     
     </div>
      </form>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="gestionAcademica/js/grupos.js"></script>
</body>
</html>