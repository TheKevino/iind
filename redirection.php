<?php

include_once('includes/user.php');
include_once('includes/user_session.php');

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());

    if(isset($_GET['op'])){

        switch($_GET['op']){

            //----------------- LIBERACION DE RESIDENCIAS PROFESIONALES -------------------
            case 'index':
                include_once('residencias/index.php');
                break;

            case 1:
                include_once('residencias/Formularios/registrar_usuario.php');
                break;

            case 2:
                include_once('residencias/views/consulta_usuarios.php');
                break;

            case 3:
                include_once('residencias/views/editar_firmas.php');
                break;

            case 4:
                include_once('residencias/views/cambiar_pass.php');
                break;

            case 5:
                include_once('residencias/Formularios/registrar_formulario.php');
                break;

            case 6:
                include_once('residencias/controller/generar_excel.php');
                break;

            case 7:
                include_once('encargados/encargados.php');
                break;


            //----------------- GESTION ACADEMICA -------------------

            case 8:
                include_once('gestionAcademica/views/materia.php');
                break;

            case 9:
                include_once('gestionAcademica/views/grupo.php');
                break;

            case 10:
                include_once('gestionAcademica/views/carreras.php');
                break;

            case 11:
                include_once('gestionAcademica/views/consultaCarreras.php');
                break;

            case 12:
                include_once('gestionAcademica/views/consultaGrupos.php');
                break;
            
            case 13:
                include_once('gestionAcademica/views/consultaMaterias.php');
                break;

            case 14:
                include_once('gestionAcademica/views/usuarioImparte.php');
                break;

            case 15:
                include_once('gestionAcademica/views/consultaClases.php');
                break;

            case 16:
                include_once('gestionAcademica/views/historial_clases.php');
                break;

            case 17:
                include_once('gestionAcademica/views/clases_actuales.php');
                break;

            //----------------- REPORTE FINAL -------------------

            case 'reporteFinal':
                require_once('reporteFinalCurso/index.php');
                break;

            case 18:
                include_once('reporteFinalCurso/views/reporte_formulario.php');
                break;

            //----------------- PLANEACION DIDACTICA -------------------
            case 'planeacion':
                include_once('planeacionDidactica/index.php');
                break;

            case 19:
                include_once('planeacionDidactica/views/planeacion_didactica.php');
                break;
    
            default:
                include_once('menu.php');
                break;
    
        } 

    } else {
        include_once('menu.php');
    }
    
    
} else if(isset($_POST['login'])){
    
    $userForm = $_POST['usuario'];
    $passForm = $_POST['pass'];

    if($user->userExist($userForm, $passForm)){
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

        include_once('menu.php');
    } else {
        
        $errorLogin = "Datos incorrectos";
        header("Location: login.php");
    }

} else{
    header("Location: login.php");
}

?>