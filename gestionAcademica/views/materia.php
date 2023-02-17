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
    <title>Materia</title>
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

      <form class="formulario" action="gestionAcademica/controller/agregarMateria.php" method="POST">
        
          <h1>Materia</h1>
            
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
              <input type="text" name="claveMateria" id="claveMateria" placeholder="Clave de la materia" />
            </div>
    
            <div class="input-contenedor">
              <i class="fa-solid fa-key icon"></i>
              <input type="text" name="nombreMateria" id="nombreMateria" placeholder="Nombre de la materia" />
            </div>

            <div class="input-contenedor">
              <i class="fa-solid fa-hashtag icon"></i>
              <input type="text" name="satca" id="satca" placeholder="SATCA. Ej: 2-3-5" />
            </div>

            <textarea name="caracterizacion" id="caracterizacion" placeholder="Caracterización de la asignatura (Opcional)"></textarea>

            <textarea name="intencion" id="intencion" placeholder="Intención didactica (Opcional)"></textarea>

            <textarea name="previas" id="previas" placeholder="Competencias previas (Opcional.)"></textarea>

            <textarea name="genericas" id="genericas" placeholder="Competencias genericas (Opcional.)"></textarea>

            <textarea name="especificas" id="especificas" placeholder="Competencias especificas (Opcional.)"></textarea>

            <textarea name="fuentes" id="fuentes" placeholder="Fuentes de información (Opcional.)"></textarea>

            <textarea name="apDidacticos" id="apDidacticos" placeholder="Apoyos didacticos (Opcional.)"></textarea>

            <div class="contenedorbtn">
              <input type="submit" value="Agregar" class="button" name="btnAgregarMateria" id="btnAgregarMateria">
            </div>

          </div>

        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="gestionAcademica/js/materias.js"></script>
  </body>
  </html>
