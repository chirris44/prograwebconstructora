<?php
require_once("controllers/casos_exito.php");
include_once("views/header.php");
include_once("views/menu.php");
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $casos_exito->new($data);
            if ($cantidad) {
                $casos_exito->flash('success', 'Registro dado de alta con éxito');
                $data = $casos_exito->get(null);
                include('views/casos_exito/index.php');
            } else {
                $casos_exito->flash('danger', 'Algo fallo');
                include('views/casos_exito/form.php');
            }
        } else {
            include('views/casos_exito/form.php');
        }
        break;
    case 'edit':
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_caso_exito'];
            $cantidad = $casos_exito->edit($id, $data);
            if ($cantidad) {
                $casos_exito->flash('success', 'Registro actualizado con éxito');
                $data = $casos_exito->get(null);
                include('views/casos_exito/index.php');
            } else {
                $casos_exito->flash('danger', 'Algo fallo');
                $data = $casos_exito->get(null);
                include('views/casos_exito/index.php');
            }
        } else {
            $data = $casos_exito->get($id);
            include('views/casos_exito/form.php');
        }
        break;
    case 'delete':
        $cantidad = $casos_exito->delete($id);
        if ($cantidad) {
            $casos_exito->flash('success', 'Registro con el id= ' . $id . ' eliminado con éxito');
            $data = $casos_exito->get(null);
            include('views/casos_exito/index.php');
        } else {
            $casos_exito->flash('danger', 'Algo fallo');
            $data = $casos_exito->get(null);
            include('views/casos_exito/index.php');
        }
        break;
    case 'getAll':
    default:
        $data = $casos_exito->get(null);
        include("views/casos_exito/index.php");
}
include("views/footer.php");
?>