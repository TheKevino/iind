<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.ico" />
    <title>Formulario Titulacion</title>
    <link rel="stylesheet" href="../css/formstyles.css">

</head>
<body>

<?php

include('../../includes/db.php');
include('../../includes/user.php');
include('../../includes/user_session.php');
include('../../includes/responsable.php');
$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());

$nombreEstudiante = "";
$nc = "";
$nombreProyecto = "";
$producto = "";
$fecha = "";

  if(!isset($_SESSION['user'])){
    header('Location: ../login.php');
  }

  if(isset($_GET['id'])){

    $id = base64_decode($_GET['id']);

    $query = "SELECT * FROM formularios, usuarios WHERE idFormulario = $id AND 
    (idAsesorInterno = idUsuario OR idRevisor1 = idUsuario OR idRevisor2 = idUsuario)";

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)){
      $nombreEstudiante = $row[1] ." ".$row[2]." ".$row[3];
      $nc = $row[5];
      $nombreProyecto = $row[6];
      $producto = $row[7];
      $fecha = $row[8];

      if($row[9] == $row[15]){
        $asesorInterno = new Responsable($row[9], $row[16]." ".$row[17]." ".$row[18] , $row[10]);
      } else if($row[11] == $row[15]){
        $revisor1 = new Responsable($row[11],$row[16]." ".$row[17]." ".$row[18] , $row[12]);
      }  else if($row[13] == $row[15]){
        $revisor2 = new Responsable($row[13], $row[16]." ".$row[17]." ".$row[18] , $row[14]);
      }
      
    }

    if(!isset($asesorInterno)) $asesorInterno = new Responsable(1, "" , null);
    if(!isset($revisor1)) $revisor1 = new Responsable(1, "" , null);
    if(!isset($revisor2)) $revisor2 = new Responsable(1, "" , null);

    if($asesorInterno->getIdUsuario()==1) $asesorInterno->setNombre("");
    if($revisor1->getIdUsuario()==1) $revisor1->setNombre("");
    if($revisor2->getIdUsuario()==1) $revisor2->setNombre("");

    $nombreEstudiante = strtoupper($nombreEstudiante);

    //Query para los encargados
    $jefeDivEstudiosProf;
    $jefeDeptoIngIndustrial;

    $query = "SELECT jefeDivisionEstudiosProf, jefeDeptoIngInd FROM encargados";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_array($result);
    $jefeDivEstudiosProf = $row['jefeDivisionEstudiosProf'];
    $jefeDeptoIngIndustrial = $row['jefeDeptoIngInd'];

  } //fin if
?>

  <section class="contenedor" style="margin-bottom: 30px;">
    <div class="formulario">

              
        <table border="1" style="width: 100%; border-collapse: collapse;">
          <tr>
              <td rowspan="4">
                  <span><img src="../img/formulario/logoith.jpg" alt=""></span>
              </td>
              <td rowspan="2">
                  <span>Formato de Liberacion del Proyecto para <br> Titulacion Integral</span>
              </td>
              <td> 
                  <span>Codigo: ITH-AC-PO-008-02</span>
              </td>
          </tr>

          <tr>
              <td>
                  <span>Revision 2</span>
              </td>
          </tr>

          <tr>
              <td rowspan="2">
                  <span>Referencia a la Norma ISO 9001:2015 <br> 8.5.1,8.5.5 </span>
              </td>
              <td>
                  <span>Pagina 1 de 1</span>
              </td>
          </tr>
        </table>

        <br><br><br>
        <div class="fechadoc">
          <p id="fecha"><?= $fecha ?></p>
        </div>
        <br/>

        <div class="encargado">
          <h1><?= $jefeDivEstudiosProf ?></h1>
          <h2>JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES</h2>
          <h2>PRESENTE</h2>
        </div>
        <br/>
        <p>Por este medio le informo que ha sido liberado el siguiente proyecto para la Titulación integral:</p>
        <br/>

        <table style="width: 100%; border-collapse: collapse;" border="1">
          <tr>
            <td>
              <span>a) Nombre del Estudiante: </span>
            </td>
            <td>
              <p><strong><?= $nombreEstudiante ?></strong></p>
            </td>
          </tr>

          <tr>
            <td>
              <span>b) Carrera: </span>
            </td>
            <td>
              <span>Ingenieria Industrial</span>
            </td>
          </tr>

          <tr>
            <td>
              <span>c) No. de Control: </span>
            </td>
            <td>
              <p><?= $nc ?></p>
            </td>
          </tr>

          <tr>
            <td>
              <span>d) Nombre del proyecto: </span>
            </td>
            <td width="500px">
              <p><?= $nombreProyecto ?></p>
            </td>
          </tr>

          <tr>
            <td>
              <span>e) Producto: </span>
            </td>
            <td><?= $producto ?></td>
          </tr>
        </table>

          <div class="sectionfirm">
          <br/>
          <p>Agradezco de antemano su valioso apoyo en esta importante actividad para la 
            formación <br> profesional de nuestros egresados
          </p>  
          <br>
          <h1>Atentamente</h1>
            <h2>Excelencia en Educacion Tecnologica</h2>
            <h2>"En el Esfuerzo Comun, La Grandeza de Todos"</h2>

          <div class="info-departamental">
            <div class="jefe-depa">
              <h2><?= $jefeDeptoIngIndustrial ?><br>
              JEFE DEL DEPTO. DE ING. INDUSTRIAL</h2>
            </div>

            <div class="sello">

            </div>

          </div>
        </div>

     <br/>

     <table class="tablefirm" style="width: 100%; border-collapse: collapse;" border="1">
          <tr>
            <td>
              <span>NOMBRE Y FIRMA DEL <br> ASESOR INTERNO </span>
            </td>
            <td>
              <span>NOMBRE Y FIRMA DEL <br> REVISOR</span>
            </td>
            <td>
              <span>NOMBRE Y FIRMA DEL <br> REVISOR</span>
            </td>
          </tr>


          <tr>
            <td width="100px">
              <p><?= strtoupper($asesorInterno->getNombre()); ?></p>
            </td>
            <td width="100px">
              <p><?= strtoupper($revisor1->getNombre()); ?></p>
            </td>
            <td width="100px">
              <p><?= strtoupper($revisor2->getNombre()); ?></p>
            </td>
          </tr>


          <tr>
            <td>
              <img src="<?php if($asesorInterno->getFirma()==NULL){
                echo "../img/image.jpg";
              } else{
                echo "../".$asesorInterno->getFirma();
              } ?>">
            </td>
            <td>
            <img src="<?php if($revisor1->getFirma()==NULL){
                echo "../img/image.jpg";
              } else{
                echo "../".$revisor1->getFirma();
              } ?>">
            </td>
            <td>
            <img src="<?php if($revisor2->getFirma()==NULL){
                echo "../img/image.jpg";
              } else{
                echo "../".$revisor2->getFirma();
              } ?>">
            </td>
          </tr>

          <?php
          if($user->getTipo() == 1){ ?>
          <form action="../controller/firmar.php?id=<?php echo $id; ?>&idU=<?php echo $user->getIdUsuario(); ?>" method="POST">
            <tr>

              <td>
                <?php if($user->getIdUsuario() == $asesorInterno->getIdUsuario()) { ?>
                <input type="submit" name="asesorFirma" value="Firmar"/>
                <input type="submit" name="asesorFirmaQR" value="Firmar con QR"/>
                <?php } ?>

              </td>

              <td>
                <?php if($user->getIdUsuario() == $revisor1->getIdUsuario()) { ?>
                <input type="submit" name="revisor1Firma" value="Firmar"/>
                <input type="submit" name="revisor1FirmaQR" value="Firmar con QR"/>
                <?php } ?>
              </td>

              <td>
                <?php if($user->getIdUsuario() == $revisor2->getIdUsuario()) { ?>
                <input type="submit" name="revisor2Firma" value="Firmar"/>
                <input type="submit" name="revisor2FirmaQR" value="Firmar con QR"/>
                <?php } ?>
              </td>

            </tr>
          </form>
          <?php } ?>
  
     </table>
    
     <div class="footer">
      <p>ITH-AC-PO-008-02</p>
      <P>Rev. 2</P>
     </div>

    </div>
  </section>


   <!-- JavaScript Bundle with Popper -->
</body>
</html>