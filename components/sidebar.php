    <div class="logo-details">
      <img src="assets/Images/deer.png">
      <span class="logo_name">IIND</span>
    </div>

    <ul class="nav-links">

      <li>
        <a id="residencias">
          <i class='bx bx-file-blank'></i>
          <span class="link_name">Residencias</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Residencias</a></li>
        </ul>
      </li>

      <li>
        <a id="planeacion">
          <i class='bx bx-notepad'></i>
          <span class="link_name">Planeaciones</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Planeaciones</a></li>
        </ul>
      </li>
      
      <li>
        <a id="reportes">
            <i class='bx bx-table'></i>
            <span class="link_name">Reporte</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Reporte final</a></li>
        </ul>
      </li>

      <li>

        <div class="iocn-link">

          <a>
            <i class='bx bx-user'></i>
            <span class="link_name">Usuarios</span>
          </a>

          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">Usuarios</a></li>
          <li><a id="encargados">Encargados</a></li>
          <li><a id="registrar-usuario">Registrar usuario</a></li>
          <li><a id="consultar-usuario">Consultar usuarios</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-book-content'></i>
            <span class="link_name">Materias</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">Materias</a></li>
          <li><a id="agregar-materia">Agregar materia</a></li>
          <li><a id="consultar-materia">Consultar materia</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-bookmarks'></i>
            <span class="link_name">Carreras</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">Carreras</a></li>
          <li><a id="agregar-carrera">Agregar carrera</a></li>
          <li><a id="consultar-carrera">Consultar carrera</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-group' ></i>
            <span class="link_name">Grupos</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">Grupos</a></li>
          <li><a id="agregar-grupo">Agregar grupo</a></li>
          <li><a id="consultar-grupo">Consultar grupos</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a>
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Clases</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name">Clases</a></li>
          <li><a id="crear-clase">Crear clase</a></li>
          <li><a id="consultar-clase">Ver clase</a></li>
        </ul>
      </li>

    <div class="profile-details">
      <div class="profile-content">
        <img src="assets/Images/user.png" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name"><?php echo $user->getPrimerNombre(); ?></div>
      </div>
      <a href="logout.php"><i class='bx bx-log-out' ></i></a>
    </div>

  </li>
</ul>