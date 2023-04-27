<?php

if(!isset($_SESSION['user'])){
    header('Location: login.php');
  }
  ob_start();

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
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css/sidebar.css">
    <link href="css/menu.css" rel="stylesheet"/>
    <link href="css/tablas.css" rel="stylesheet"/>
    <link href="css/cards.css" rel="stylesheet"/>

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  </head>
  <body>
  <div class="sidebar close">
    <?php 
    if($user->getTipo() == 2){
      include_once("components/sidebar.php"); 
    } else if ($user->getTipo() == 1){
      include_once("components/user_sidebar.php");
    }
    ?>
  </div>

  <section class="home-section">
    
    <div class="menu-button-box">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="home-contenido">

      <!-- LAS 3 HERRAMIENTAS PRINCIPALES -->

      <div class="window" id="index-residencias" style="visibility: visible;">
            <?php 
            include_once('residencias/index.php');
            ?>
      </div>

      <div class="window" id="index-planeacion" style="visibility: hidden;">
            <?php 
            include_once('planeacionDidactica/index.php');
            ?>
      </div>

      <div class="window" id="index-reporte" style="visibility: hidden;">
            <?php
            include_once('reporteFinalCurso/index.php');
            ?>
      </div>

      <!-- ----------------------------------- -->
      <?php
      if ($user->getTipo() == 1){
      ?>

      <!-- CLASES -->
      <div class="window" id="index-clases-actuales" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/clases_actuales.php');
            ?>
      </div>

      <!-- FIRMAS -->
      <div class="window" id="index-firma" style="visibility: hidden; display: none;">
            <?php
            include_once('residencias/views/editar_firmas.php');
            ?>
      </div>

      <?php
      }
      ?>
      <!-- ----------------------------------- -->

      <!-- ----------------------------------- -->
      <?php
      if ($user->getTipo() == 2){
      ?>

      <!-- GESTION DE USUARIOS -->
      <div class="window" id="index-encargados" style="visibility: hidden; display: none;">
            <?php
            include_once('encargados/encargados.php');
            ?>
      </div>

      <div class="window" id="index-registrar-usuarios" style="visibility: hidden; display: none;">
            <?php
            include_once('residencias/Formularios/registrar_usuario.php');
            ?>
      </div>

      <div class="window" id="index-consultar-usuarios" style="visibility: hidden; display: none;">
            <?php
            include_once('residencias/views/consulta_usuarios.php');
            ?>
      </div>

      <!-- GESTION DE MATERIAS -->
      <div class="window" id="index-agregar-materia" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/materia.php');
            ?>
      </div>

      <div class="window" id="index-consultar-materia" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/consultaMaterias.php');
            ?>
      </div>

      <!-- GESTION DE CARRERAS -->
      <div class="window" id="index-agregar-carrera" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/carreras.php');
            ?>
      </div>

      <div class="window" id="index-consultar-carrera" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/consultaCarreras.php');
            ?>
      </div>

      <!-- GESTION DE GRUPOS -->
      <div class="window" id="index-agregar-grupo" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/grupo.php');
            ?>
      </div>

      <div class="window" id="index-consultar-grupo" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/consultaGrupos.php');
            ?>
      </div>

      <!-- GESTION DE CLASES -->
      <div class="window" id="index-crear-clase" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/usuarioImparte.php');
            ?>
      </div>

      <div class="window" id="index-consultar-clase" style="visibility: hidden; display: none;">
            <?php
            include_once('gestionAcademica/views/consultaClases.php');
            ?>
      </div>

      <?php
      }
      ?>

    </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="datatable/datatables.min.js"></script>
    <script src="datatable/DataTables/js/dataTables.bulma.min.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/sidebar.js"></script>
  </body>
</html>