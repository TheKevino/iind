<?php
  $query = "SELECT * FROM carreras";

  $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

?>
<div>

  <form class="formulario" action="gestionAcademica/controller/agregarGrupo.php" method="POST">
    <h3>Grupo</h3>
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

    <div class="contenedorbtn">
      <input type="submit" value="Agregar" class="button" name="btnAgregarGrupo" id="btnAgregarGrupo">
    </div>

  </form>
  <script src="gestionAcademica/js/grupos.js"></script>
</div>