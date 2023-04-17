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
?>

