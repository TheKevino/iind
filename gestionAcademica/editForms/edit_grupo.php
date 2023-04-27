<?php

  include("../../includes/db.php");

  if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = "SELECT idCarrera, nombre FROM carreras";
    $query2 = "SELECT idCarrera, clave, nombre FROM grupos WHERE idGrupo = $id";
  
    $result = mysqli_query($conn, $query);
  
      if(!$result){
          die("Query failed");
      }
  
      $result2 = mysqli_query($conn, $query2);
  
      if(!$result){
          die("Query failed");
      }
  
      $row2 = mysqli_fetch_array($result2);

  }

  if(isset($_POST['btnAgregarGrupo'])){
    $id = $_GET['idG'];
    $carrera = $_POST['selectCarrera'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];

    $query = "UPDATE grupos SET idCarrera = '$carrera', clave = '$clave', nombre = '$nombre' WHERE idGrupo=$id ";
    $result = mysqli_query($conn, $query);
    header("Location: edit_grupo.php?id=".$id);
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <title>Editar Grupo</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/Styleform.css">
    
        <!-- Extend Icon -->
        <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  
</head>
<body>

    <form class="formulario" action="edit_grupo.php?idG=<?= $id; ?>" method="POST">
        <h1>Grupo</h1>
        <div class="imgposition">
          <img class="imgicon-form" src="/img/login/iconuser.png" alt="">
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-message icon"></i>

          <select name="selectCarrera" id="selectCarrera" >
            <!-- PARTE PARA LLENAR EL SELECT DEL FORMULARIO CON LAS CARRERAS -->
            <?php while($row = mysqli_fetch_array($result)){ ?>

              <option <?php if($row2['idCarrera'] == $row['idCarrera']){
                  echo "selected";
              } ?> value=<?= $row['idCarrera']; ?>><?= $row['nombre']; ?></option>
                        
            <?php } ?>

          </select>
        </div>
  
          <div class="input-contenedor">
            <i class="fa-solid fa-key icon"></i>
            <input type="text" placeholder="Clave del grupo" name="clave" id="clave" value="<?= $row2['clave']?>" />
          </div>

          <div class="input-contenedor">
            <i class="fa-solid fa-message icon"></i>
            <input type="text" placeholder="Nombre del grupo" name="nombre" id="nombre" value="<?= $row2['nombre']?>" />
          </div>

        </div>
        <div class="contenedorbtn">
          <input type="submit" value="Agregar" class="button" name="btnAgregarGrupo" id="btnAgregarGrupo">
        </div>     
     </div>
      </form>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="../js/grupos.js"></script>
</body>
</html>