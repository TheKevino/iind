<?php
    include("../../includes/db.php");
    include('../../includes/user.php');
	include('../../includes/user_session.php');
	$userSession = new UserSession();
	$user = new User();
	$user->setUser($userSession->getCurrentUser());
    $idReal = $user->getIdUsuario();

    $idReporte = base64_decode($_GET['id']);
    $idUsuario = base64_decode($_GET['idUs']);

    if($idReal != $idUsuario){
        header('Location: ../../menu.php');
    }

    $meses = array(
        "01" => "enero",
        "02" => "febrero",
        "03" => "marzo",
        "04" => "abril",
        "05" => "mayo",
        "06" => "junio",
        "07" => "julio",
        "08" => "agosto",
        "09" => "septiembre",
        "10" => "octubre",
        "11" => "noviembre",
        "12" => "diciembre",
    );

    $queryReporte = "SELECT estado, departamento, inicioSemestre, finalSemestre, nombreDocente, gruposAtendidos, asignaturasDiferentes
     FROM reportefinal WHERE idReporte = $idReporte AND idUsuario = $idUsuario";
    $resultReporte = mysqli_query($conn, $queryReporte);
    $rowReporte = mysqli_fetch_array($resultReporte);

    $fechaInicial = explode("-", $rowReporte['inicioSemestre']); //Primero anio, luego mes y a lo ultimo el dia
    $fechaFinal = explode("-", $rowReporte['finalSemestre']); //Primero anio, luego mes y a lo ultimo el dia

    $queryAsignProgs = "SELECT idAsignPrograma, asignatura, carrera, totalEstudiantes, primeraOp, segundaOp, totalAcreditados, 
    porcentajeAcreditados, estudiantesNoAcreditados, porcentajeNoAcreditados, desertores, porcentajeDesertores FROM asignprogramas WHERE idReporte = $idReporte";
    $resultAsignaturas = mysqli_query($conn, $queryAsignProgs);

    $queryTotal = "SELECT SUM(totalEstudiantes) as 'totalEst', SUM(primeraOp) as 'primeraOp', SUM(segundaOp) as 'segundaOp', SUM(totalAcreditados) as 'totalAcr', 
    SUM(estudiantesNoAcreditados) as 'noAcr', SUM(desertores) as 'desertores' FROM asignprogramas WHERE idReporte = $idReporte";
    $resultTotal = mysqli_query($conn, $queryTotal);
    $rowTotal = mysqli_fetch_array($resultTotal);

    if($rowTotal['totalEst']>0){
        $porcentajeAcreditados = round(($rowTotal['totalAcr']*100)/$rowTotal['totalEst'], 2);
        $porcentajeNoAcreditados = 100-$porcentajeAcreditados;
        $porcentajeDesertores = round(($rowTotal['desertores']*100)/$rowTotal['totalEst'], 2);
    } else{
        $porcentajeAcreditados = 0;
        $porcentajeNoAcreditados = 0;
        $porcentajeDesertores = 0;
    }
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico">
    <title>Vista del reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../css/paleta.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/tablas.css" />
    <!-- Extend Icon -->
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>

<style>

    .contenedor{
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

</style>

  <!-- Formulario -->
  <div class="contenedor mt-4">
 
        <div class="card card-body col-md-8 mt-2" id="containerForm">

            <div class="row col-md-12 mt-1">

                <div class="col-md-6 mt-2">
                    <label for="departamento"><strong>Departamento:</strong></label>
                    <input type="text" readonly class="form-control-plaintext" name="departamento" id="departamento" value="<?= $rowReporte['departamento']; ?>">
                </div>

                <div class="col-md-6 mt-2">
                    <label for="departamento"><strong>Reporte final del semestre:</strong></label>
                    <input type="text" readonly class="form-control-plaintext" name="semestre" id="semestre" 
                    value="<?= $fechaInicial[2]." de ". $meses[$fechaInicial[1]]." del ".$fechaInicial[0]. " al " . $fechaFinal[2]." de ". $meses[$fechaFinal[1]]." del ".$fechaFinal[0]; ?>">
                </div>

            </div>

            <div class="row col-md-12 mt-1">

                <div class="col-md-12 mt-2">
                    <label for="departamento"><strong>Docente:</strong></label>
                    <input type="text" readonly class="form-control-plaintext" name="docente" id="docente" value="<?= $rowReporte['nombreDocente']; ?>">
                </div>

            </div>

            <div class="row col-md-12 mt-1">

                <div class="col-md-6 mt-2">
                    <label for="departamento"><strong>No. de grupos atendidos:</strong></label>
                    <input type="text" readonly class="form-control-plaintext" name="gruposAtendidos" id="gruposAtendidos" value="<?= $rowReporte['gruposAtendidos']; ?>">
                </div>

                <div class="col-md-6 mt-2">
                    <label for="departamento"><strong>No. de asignaturas diferentes:</strong></label>
                    <input type="text" readonly class="form-control-plaintext" name="asignaturasDiferentes" id="asignaturasDiferentes" value="<?= $rowReporte['asignaturasDiferentes']; ?>">
                </div>

            </div>

            <?php if($rowReporte['estado'] == "pendiente") { ?>
            <div class="row col-md-12 mt-1">

                <div class="col-md-6 mt-2">
                    <a href='../controller/subir_reporte.php?idR=<?= $idReporte;?>&idU=<?= $idUsuario;?>'>
                        <button class="btn btn-principal" onclick='return confirmacionSubir()'>
                        <i class="fa fa-upload"></i>
                        Subir
                        </button>
                    </a>
                </div>

            </div>
            <?php } ?>

        </div><!-- FIN CONTENEDOR -->

        <div class="card card-body col-md-10 mt-2 container" id="containerForm">

            <table class="table table-striped tabla-reporte-final">
                <thead>
                    <th>Asignatura</th>
                    <th>Carrera</th>
                    <th>Total est. por materia</th>
                    <th>Acreditados 1ra Op</th>
                    <th>Acreditados 2da Op</th>
                    <th>% de acreditados</th>
                    <th>Num. No acreditados</th>
                    <th>% No acreditados</th>
                    <th>Num. Desertores</th>
                    <th>% desertores</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php while( $rowAsign = mysqli_fetch_array($resultAsignaturas) ){ ?>

                        <tr>
                            <td><?= utf8_decode($rowAsign['asignatura']); ?></td>
                            <td><?= $rowAsign['carrera']; ?></td>
                            <td><?= $rowAsign['totalEstudiantes']; ?></td>
                            <td><?= $rowAsign['primeraOp']; ?></td>
                            <td><?= $rowAsign['segundaOp']; ?></td>
                            <td><?= $rowAsign['porcentajeAcreditados']."%"; ?></td>
                            <td><?= $rowAsign['estudiantesNoAcreditados']; ?></td>
                            <td><?= $rowAsign['porcentajeNoAcreditados']."%"; ?></td>
                            <td><?= $rowAsign['desertores']; ?></td>
                            <td><?= $rowAsign['porcentajeDesertores']."%"; ?></td>

                            <?php if($rowReporte['estado'] == "pendiente") { ?>
                            <td>
                                <a href='../editForm/editar_asignatura_reporte.php?id=<?= base64_encode($idReporte); ?>&idUs=<?= base64_encode($idUsuario) ?>&idAsign=<?= base64_encode($rowAsign['idAsignPrograma']); ?>' class='btn btn-editar'>
                                    <i class='fa fa-pen'></i>
                                </a>
                            </td>
                            <td>
                                <a href='../controller/baja_asignatura_reporte.php?id=<?= $rowAsign['idAsignPrograma'];?>&idR=<?= $idReporte;?>&idU=<?= $idUsuario;?>'>
                                    <button class='btn btn-borrar' onclick='return confirmacionBorrar()'>
                                        <i class='fa fa-trash' aria-hidden='true'></i>
                                    </button>
                                </a>
                            </td>
                            <?php } else {?>
                                <td></td>
                                <td></td>
                            <?php } ?>
                        </tr>

                    <?php }?>
                    <tr>
                        <td colspan="2" >Total</td>
                        <td><?= $rowTotal['totalEst']; ?></td>
                        <td><?= $rowTotal['primeraOp']; ?></td>
                        <td><?= $rowTotal['segundaOp']; ?></td>
                        <td><?= $porcentajeAcreditados.'%'; ?></td>
                        <td><?= $rowTotal['noAcr']; ?></td>
                        <td><?= $porcentajeNoAcreditados."%"; ?></td>
                        <td><?= $rowTotal['desertores']; ?></td>
                        <td><?= $porcentajeDesertores."%"; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>  

        </div><!-- FIN CONTENEDOR -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
    function confirmacionBorrar(){   
        let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR LA ASIGNATURA DEL REPORTE?");
        return respuesta;
    }

    function confirmacionSubir(){   
        let respuesta = confirm("SEGURO(A) QUE QUIERES SUBIR EL REPORTE? ESTE REPORTE YA NO PODRÁ SER EDITADO UNA VEZ QUE LO SUBAS");
        return respuesta;
    }
    </script>
</body>
</html>
