<?php 
if(!isset($_SESSION['user']) || $user->getTipo()!=2){
  header('Location: ../login.php');
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
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="residencias/css/login.css" />
    <link rel="stylesheet" href="css/paleta.css" />
    <link rel="stylesheet" href="css/tablas.css" />
</head>
<body>

<style>

    :root {
      --Primario: #143F6B;
      --Secundario: #FEB139;
      --Complementario-A: #F55353;
      --Complementario-B: #F6F54D;
      --Complementario-C: #069A8E;
    }

    .contenedor{
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

</style>

    <!-- Navbar -->
  <?php include('navigator.php'); ?>
  </script>

  <div class="contenedor">

    <div class="card card-body col-md-8 mt-4 mb-4">
        <div class="row">
          <div class="col-md-8">
            <input type="text" class="form-control" id="buscador_usuario" name="buscador_usuario" autocomplete="off" placeholder="Nombre, apellidos, usuario, etc.">
            <!-- <input type="submit" class="btn btn-warning mt-4" name="btnBuscarUsuario" id="btnBuscarUsuario" value="Buscar"> -->
            <button class="btn btn-secundario mt-2" name="btnBuscarUsuario" id="btnBuscarUsuario">Buscar</button>
          </div>
        </div>
    </div>

  </div>

  <div class="container">
    <section id="tabla_usuarios">

    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="residencias/js/consulta_usuarios.js"></script>
  </body>
</html>
