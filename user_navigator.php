<!-- Navbar -->
<nav class="navbar navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="redirection.php?op=0"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo $user->getNombre(); ?></a>

      <ul class="nav justify-content-end">
        
        <li class="nav-item">
          <a class="nav-link nav-title" aria-current="page" href="redirection.php?op=3">Editar Firma</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link nav-title dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Clases</a>
          <ul class="dropdown-menu">

            <li class="nav-item">
              <a class="nav-link nav-title active" aria-current="page" href="redirection.php?op=17">Clases actuales</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-title" href="redirection.php?op=16">Historial de clases</a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-title" href="logout.php">Cerrar sesion</a>
        </li>
        
      </ul>

    </div>
</nav>