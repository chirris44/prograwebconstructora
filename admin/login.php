<?php 
include('controllers/sistema.php');
include('views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : "login";
switch($action){
    case 'logout':
        $sistema ->logout();
        include('views/login/index.php');
        break;
    case 'forgot':
        include('views/login/forgot.php');
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
        if(isset($_POST['enviar'])){
            $data=$_POST;
            if($sistema -> login($data['correo'],$data['contrasena'])){
                header("Location: index.php");
            }
        }
        include('views/login/index.php');
        break;        
}
include('views/footer.php');
