<?php
require_once("controllers/empleado.php");
require_once("controllers/departamento.php");
include_once("views/header.php");
include_once("views/menu.php");

$action = (isset($_GET["action"])) ? $_GET["action"] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;


switch ($action) {
    case 'new':
        $data_departamento = $departamento->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $empleado->new($data);
            if ($cantidad) {
                $empleado->flash('success', 'Registro dado de alta con éxito');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                include('views/empleado/form.php');
            }
        } else {
            include('views/empleado/form.php');
        }
        break;
    case 'delete':
        $cantidad = $empleado->delete($id);
        if ($cantidad) {
            $empleado->flash('success', 'Registro con el id= ' . $id . ' eliminado con éxito');
            $data = $empleado->get(null);
            include('views/empleado/index.php');
        } else {
            $empleado->flash('danger', 'Algo fallo');
            $data = $empleado->get(null);
            include('views/empleado/index.php');
        }
        break;
    case 'edit':
        $data_departamento = $departamento->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_empleado'];
            $cantidad = $empleado->edit($id, $data);
            if ($cantidad) {
                $empleado->flash('success', 'Registro actualizado con éxito');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            }
        } else {
            $data = $empleado->get($id);
            include('views/empleado/form.php');
        }
        break;
        case 'foto':
            include('views/empleado/foto_form.php');
            break;
        case 'guardarFoto':
            //print_r($_POST);
            //die();
            $data['foto']=$_POST['image'];
            $data['id_empleado']=$id;
            $var=$empleado->guardarFoto($data);
            if ($var) {
                $empleado->flash('success', 'Registro dado de alta con éxito');
                $data = $empleado->get(null);
                include('views/empleado/index.php');
            } else {
                $empleado->flash('danger', 'Algo fallo');
                include('views/empleado/form.php');
            }
           // $data = $empleado->get(null);
            //include("views/empleado/index.php");
            break;    
        case 'getAll':
            default:
                $data = $empleado->get(null);
                include("views/empleado/index.php");
    }
    include("views/footer.php");
    ?>