<?php

if(!isset($_SESSION['user'])){
    header('Location: login.php');
  }

include_once('includes/user.php');
include 'includes/db.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="icon" href="residencias/img/favicon.ico" />
    <title>Inicio</title>
    <link rel="stylesheet" href="residencias/css/jquery-ui.css">
    <script src="residencias/js/jquery-ui.js"></script>
    <script src="residencias/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="datatable/DataTables/css/dataTables.bulma.min.css">
    <link rel="stylesheet" href="datatable/DataTables/css/bulma.min.css">
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>

    <link href="css/menu.css" rel="stylesheet"/>
    <link href="css/cards.css" rel="stylesheet"/>
    <link href="css/tablas.css" rel="stylesheet"/>
    <link href="residencias/css/residencias.css" rel="stylesheet"/>

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  </head>
  <body>
  
  <?php

    if($user->getTipo() == 2){
      include('navigator.php');
    } else{
      include('user_navigator.php');
    }
  ?>


    <div class="main">

    <div class="fondo"></div>

      <form class="contenedor" action="redirection.php" method="POST">

        <a class="carta-option" id="residencias" href="redirection.php?op=index">
          <div class="contenido-boton">

            <i class="fa fa-file"></i>
            <div class="carta-footer">
              <p>Residencias</p>
            </div>

          </div>
        </a>
        
        <a class="carta-option" id="planeacion" href="redirection.php?op=planeacion">
          <div class="contenido-boton">

            <i class="fa fa-address-book"></i>
            <div class="carta-footer">
              <p>Planeacion Didactica</p>
            </div>

          </div>
        </a>

        <a class="carta-option" id="reportes" href="redirection.php?op=reporteFinal">
          <div class="contenido-boton">

            <i class="fa fa-pencil-square"></i>
            <div class="carta-footer">
              <p>Reporte Final</p>
            </div>

          </div>
        </a>

      </form>

      <div class="content">

        <div class="window">
          <?php 
          include_once('residencias/index.php'); 
          //include_once('reporteFinalCurso/index.php');
          //include_once('planeacionDidactica/index.php');
          ?>
        </div>
      
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="datatable/datatables.min.js"></script>
    <script src="datatable/DataTables/js/dataTables.bulma.min.js"></script>
    <script src="js/menu.js"></script>
  </body>
</html>