<?php

  $query = "SELECT * FROM carreras";

  $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

?>

<div>

      <form class="formulario" action="gestionAcademica/controller/agregarMateria.php" method="POST">
        
          <h3>Materia</h3>
            
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

            <textarea name="intencion" id="intencion" placeholder="Intención didactica (Opcional)."></textarea>

            <textarea name="previas" id="previas" placeholder="Competencias previas (Opcional)."></textarea>

            <textarea name="genericas" id="genericas" placeholder="Competencias genericas (Opcional)."></textarea>

            <textarea name="especificas" id="especificas" placeholder="Competencias especificas (Opcional)."></textarea>

            <textarea name="fuentes" id="fuentes" placeholder="Fuentes de información (Opcional)."></textarea>

            <textarea name="apDidacticos" id="apDidacticos" placeholder="Apoyos didacticos (Opcional)."></textarea>

            <div class="contenedorbtn">
              <input type="submit" value="Agregar" class="button" name="btnAgregarMateria" id="btnAgregarMateria">
            </div>

      </form>

        <script src="gestionAcademica/js/materias.js"></script>
</div>