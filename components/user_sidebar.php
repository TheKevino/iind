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
          <li><a class="link_name">Residencias</a></li>
        </ul>
      </li>

      <li>
        <a id="planeacion">
          <i class='bx bx-notepad'></i>
          <span class="link_name">Planeaciones</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name">Planeaciones</a></li>
        </ul>
      </li>
      
      <li>
        <a id="reportes">
            <i class='bx bx-table'></i>
            <span class="link_name">Reporte</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name">Reporte final</a></li>
        </ul>
      </li>

      <li>
        <a id="clases">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Clases</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name">Clases</a></li>
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