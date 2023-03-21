<?php
/*
* Enrutador proyecto
*/
require_once("controllers/proyecto.php"); //!mandamos llamar a las los archivos
require_once("controllers/departamento.php"); //!de controladores y views
include_once('views/header.php'); 
include_once('views/menu.php');


$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? ($_GET['id']) : null;
switch ($action) {
    case 'new':
        $datadepartamentos= $departamento->get();
        if (isset($_POST['enviar'])) {
            //$proyecto->uploadfile('x','y');
            $data = $_POST['data'];
            //$data['file']=$_FILES['archivo'];
            $cantidad = $proyecto->new($data);
            if ($cantidad) {
                $proyecto->flash('success', "Registro dado de alta con éxito");
                $data = $proyecto->get();
                include('views/proyecto/index.php');
            } else {
                $proyecto->flash('danger', "Algo fallo");
                include('views/proyecto/form.php');
            }
        } else {
            include('views/proyecto/form.php');
        }
        break;
    case 'edit':
        $datadepartamentos= $departamento->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_proyecto'];
            $cantidad = $proyecto->edit($id, $data);
            if ($cantidad) {
                $proyecto->flash('success', "Registro actualizado con éxito");
                $data = $proyecto->get();
                include('views/proyecto/index.php');
            } else {
                $web->flash('warning', "Algo fallo o no hubo cambios");
                $data = $proyecto->get();
                include('views/proyecto/index.php');
            }
        } else {
            $data = $proyecto->get($id);
            include('views/proyecto/form.php');
        }
        break;
    case 'delete':
        $cantidad = $proyecto->delete($id);
        if ($cantidad) {
            $proyecto->flash('success', "Registro eliminado con éxito");
            $data = $proyecto->get();
            include('views/proyecto/index.php');
        } else {
            $proyecto->flash('danger', "Algo fallo");
            $data = $proyecto->get();
            include('views/proyecto/index.php');
        }
        break;
    case 'get':
    default:
        $data = $proyecto->get();
        include("views/proyecto/index.php");
}
include_once('views/footer.php');
?>
