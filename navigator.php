<!-- Navbar -->
  <nav class="navbar navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="redirection.php?op=0"><i class="fa fa-home">&nbsp;</i>  Usuario: <?php echo $user->getNombre(); ?></a>
      <ul class="nav justify-content-end">
      <li class="nav-item">
          <a class="nav-link nav-title" href="redirection.php?op=7">Encargados</a>
      </li>

        <li class="nav-item dropdown">
          <a class="nav-link nav-title dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Usuarios</a>
          <ul class="dropdown-menu">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="redirection.php?op=1">Agregar Usuario</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=2">Consultar Usuario</a>
            </li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link nav-title dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Gestion academica</a>
          <ul class="dropdown-menu">
            
            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=14">Crear Clase</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=15">Ver Clases</a>
            </li>

            <div class="dropdown-divider"></div>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=8">Agregar Materia</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=13">Consultar Materias</a>
            </li>

            <div class="dropdown-divider"></div>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=10">Agregar Carrera</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=11">Consultar Carreras</a>
            </li>

            <div class="dropdown-divider"></div>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=9">Agregar Grupo</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=12">Consultar Grupos</a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-title" href="logout.php">Cerrar sesion</a>
        </li>
      </ul>
    </div>
  </nav>