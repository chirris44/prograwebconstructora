<?php
include('controllers/sistema.php');
include_once("views/header.php");

$action = (isset($_GET['action'])) ? $_GET['action'] : "login";

switch ($action) {
    case 'logout':
        $sistema->logout();
        include_once('views/login/index.php');
        break;
    case 'forgot':
<<<<<<< HEAD
        include_once('views/login/forgot.php');
        break;
    case 'send':
        if (isset($_POST['enviar'])) {
            $correo = $_POST['correo'];
            $send = $sistema->loginSend($correo);
            if ($send) {
                $sistema->flash('success', "Si el correo existe y está en la base de datos se le enviará un correo para la recuperación");
            } else {
                $sistema->flash('danger', "Error");
            }
            include_once('views/login/index.php');
        }
=======
        include('views/login/forgot.php');
>>>>>>> parent of 1b993b0 (1704423)
        break;
    case 'recovery':
            break;
    case 'send':
        //include('views/login/send.php');
        if(isset($_POST['enviar'])){
            $correo=$_POST['correo'];
            $cantidad=$sistema->loginSend($correo);
            if ($cantidad) {
                $sistema->flash('success', 'Si se envio');
                include('views/login/index.php');
            } else {
                $sistema->flash('danger', 'Tal vez se envio');
                include('views/login/index.php');
            }
        }
     break;
    case 'login':
    default:
        if (isset($_POST['enviar'])) {
            $data = $_POST;
            $login = $sistema->login($data['correo'], $data['contrasena']);
            if ($login) {
                header("Location: index.php");
            } else {
                include_once('views/login/index.php');
            }
<<<<<<< HEAD

        }
        include_once('views/login/index.php');
        break;

}
include_once("views/footer.php");
?>
=======
        }
        include('views/login/index.php');
        break;        
}
include('views/footer.php');
>>>>>>> parent of 1b993b0 (1704423)
