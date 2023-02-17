<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="redirection.php?op=0"><i class="fa fa-home"></i>  Usuario: <?php echo $user->getNombre(); ?></a>

      <ul class="nav justify-content-end">
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="redirection.php?op=3">Editar Firma</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Clases</a>
          <ul class="dropdown-menu">

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="redirection.php?op=17">Clases actuales</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="redirection.php?op=16">Historial de clases</a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Cerrar sesion</a>
        </li>
        
      </ul>

    </div>
</nav>