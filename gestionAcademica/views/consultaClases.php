<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="residencias/img/favicon.ico" />
    <title>Lista de clases</title>
    <link rel="stylesheet" href="residencias/css/jquery'ui.css">
    <script src="residencias/js/jquery-ui.js"></script>
    <script src="residencias/js/jquery-3.6.0.min.js"></script>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
      <link rel="stylesheet" href="css/paleta.css">
    <link rel="stylesheet" href="css/tablas.css" />

      <!-- Extend Icon -->
      <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
</head>
<body>

 <!-- Navbar -->
 <?php include('navigator.php'); ?>
    
<div class="container mt-2">

    <h3>Consulta Clases</h3>
    <div class="row md-12">

        <div class="card card-body col-md-12 mt-4 mb-4">
            <div class="row">
                <div class="col-md-12 justify-content-center">
                    <input type="text" class="form-control" id="buscador_clase" name="buscador_clase" autocomplete="off" placeholder="Informacion de la clase">
                    <button class="btn btn-secundario mt-4" name="btnBuscarClase" id="btnBuscarClase">Buscar</button>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="container">
    <section id="tabla_clases">

    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="gestionAcademica/js/consulta_clases.js"></script>
</body>
</html>