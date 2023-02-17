<div class="card">
    <a href="Formularios/formulario1.php?id=<?php echo $formulario['idFormulario']; ?>"> 
        <div class="info">
            <p><?php echo $formulario['paternoAlumno']." ".$formulario['maternoAlumno']." ".
                $formulario['nombresAlumno']."<br>". $formulario['noControl']; ?></p>
            <span><?php echo $formulario['nombreProyecto']; ?></span>
        </div>
        <div class="botones-cards mt-2">
            <a class="btn btn-dark" style="background-color:#6c757e; color:white;" href=""><i class="fa fa-pen"></i></a>
        </div>
    </a>
</div>