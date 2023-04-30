<?php
require_once("controllers/rol.php");
require_once("controllers/privilegio.php");
include_once("views/header.php");
include_once("views/menu.php");
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $rol->new($data);
            if ($cantidad) {
                $rol->flash('success', 'Registro dado de alta con éxito');
                $data = $rol->get(null);
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', 'Algo fallo');
                include('views/rol/form.php');
            }
        } else {
            include('views/rol/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_rol'];
            $cantidad = $rol->edit($id, $data);
            if ($cantidad) {
                $rol->flash('success', 'Registro actualizado con éxito');
                $data = $rol->get(null);
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', 'Algo fallo');
                $data = $rol->get(null);
                include('views/rol/index.php');
            }
        } else {
            $data = $rol->get($id);
            include('views/rol/form.php');
        }
        break;
    case 'delete':
        $cantidad = $rol->delete($id);
        if ($cantidad) {
            $rol->flash('success', 'Registro con el id= ' . $id . ' eliminado con éxito');
            $data = $rol->get(null);
            include('views/rol/index.php');
        } else {
            $rol->flash('danger', 'Algo fallo');
            $data = $rol->get(null);
            include('views/rol/index.php');
        }
        break;
        case 'newPrivilegio':
            $data_privilegio = $privilegio->get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_rol'];
            $cantidad = $rol->newPrivilegio($id,$data);
            if ($cantidad) {
                $rol->flash('success', 'Registro dado de alta con éxito');
                $data = $rol->get(null);
                include('views/rol/index.php');
            } else {
                $rol->flash('danger', 'Algo fallo');
                include('views/rol/privilegio_form.php');
            }
        } else {
            $data = $rol->get($id);
            include('views/rol/privilegio_form.php');
        }
        break;
    case 'getAll':
    default:
        $data = $rol->get(null);
        include("views/rol/index.php");
}
include("views/footer.php");
?>