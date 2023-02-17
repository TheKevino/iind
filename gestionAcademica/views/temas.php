<?php
include("../../includes/db.php");

$idMateria = $_GET['id'];

/*
$query = "SELECT idTema, noTema, nombre, temasSubtemas, actsAprendizaje, desCompGenericas, horasTeoricoPracticas FROM temas 
WHERE idMateria = $idMateria ORDER BY noTema ASC";
*/

$query = "SELECT idTema, noTema, temas.nombre as 'nombre', temasSubtemas, actsAprendizaje, desCompGenericas, satca FROM temas, materias 
    WHERE (temas.idMateria = materias.idMateria) AND temas.idMateria = $idMateria ORDER BY noTema ASC";


  
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Temas</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../../css/paleta.css">
    <link rel="stylesheet" href="../../css/tablas.css">
    <link rel="stylesheet" href="../css/temas.css">

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  
</head>
<body>

    
<div class="container mt-2">

    <h3>Temas</h3>
    <a class="btn btn-principal m-1" href="agregar_tema.php?id=<?= $idMateria; ?>" target="_blank">
        Nuevo Tema
    </a>

    <div class="container mt-4">

        <?php

        if($result->num_rows > 0){  
            while($row = mysqli_fetch_array($result)){
        ?>
            <p>
                <span class="tema-info">Tema No. </span> <?= $row["noTema"]?>. &nbsp;&nbsp; 
                <span class="tema-info">Nombre: </span> <?= utf8_decode($row["nombre"]);?> &nbsp;&nbsp; 

                <a class='btn btn-secundario' href='../editForms/edit_tema.php?id=<?= $row['idTema']; ?>&idm=<?= $idMateria; ?>' target="_blank">
					<i class='fa fa-pen'></i>
				</a>

                &nbsp;&nbsp; 

                <a href='../controller/baja_tema.php?id=<?= $row['idTema']; ?>&idm=<?= $idMateria; ?>'>
					<button class='btn btn-borrar' onclick='return confirmacion()'>
						<i class='fa fa-trash'></i>
					</button>
				</a>

            </p>

                <table class="table table-bordered">
                    <thead>
                        <th>Temas y subtemas para desarrollar la competencia especifica</th>
                        <th>Actividades de aprendizaje</th>
                        <th>Desarrollo de competencias genericas</th>
                        <th>Horas teorico-practicas</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?= utf8_decode($row["temasSubtemas"]); ?></td>
                            <td><?= utf8_decode($row["actsAprendizaje"]); ?></td>
                            <td><?= utf8_decode($row["desCompGenericas"]); ?></td>
                            <td><?= utf8_decode($row["satca"]); ?></td>
                        </tr>
                    </tbody>
                </table>

        <?php
            } 
        } else {
        ?>

        <h3>Sin Temas</h3>

        <?php } ?>
    </div>

</div>


</body>

<script>
function confirmacion(){   
    let respuesta = confirm("Seguro(a) que quieres eliminar el tema?");
        
    return respuesta;
}
</script>
</html>
