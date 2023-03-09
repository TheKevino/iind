<?php 
  if(!isset($_SESSION['user']) || $user->getTipo()!=2){
    header('Location: ../../login.php');
  }
?>
  <div>

    <form action="residencias/controller/alta_usuario.php" method="post" class="formulario">
      <h2>Registrar usuario</h2>
      <div class="imgposition">
        <img class="imgicon-form" src="img/login/iconlogin.png" alt="">
      </div>
      <div class="contenedor">
        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="paterno" placeholder="Apellido paterno" />
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="materno" placeholder="Apellido materno (opcional)" />
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="nombres" placeholder="Nombre(s)" />
        </div>

        <div class="input-contenedor">
          <input type="email" class="form-control" name="email" placeholder="Correo Electronico" />
        </div>

        <input type="submit" value="Registrar" name="alta_usuario" class="button">
      </div>
    </form>

  </div>
