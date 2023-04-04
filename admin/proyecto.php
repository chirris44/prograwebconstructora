<?php
require_once("controllers/proyecto.php");
require_once("controllers/departamento.php");
include_once("views/header.php");
include_once("views/menu.php");
$proyecto -> validateRol('Lider');
$action = (isset($_GET["action"])) ? $_GET["action"] : null;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$id_tarea = (isset($_GET['id_tarea'])) ? $_GET['id_tarea'] : null;

switch ($action) {
    case 'new':
        $proyecto -> validatePrivilegio('Proyecto Crear');
        $dataDepartamentos = $departamento->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $proyecto->new($data);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro dado de alta con éxito');
                $data = $proyecto->get(null);
                include('views/proyecto/index.php');
            } else {
                $proyecto->flash('danger', 'Algo fallo');
                include('views/proyecto/form.php');
            }
        } else {
            include('views/proyecto/form.php');
        }
        break;
    case 'delete':
        $proyecto -> validatePrivilegio('Proyecto Borrar');
        $cantidad = $proyecto->delete($id);
        if ($cantidad) {
            $proyecto->flash('success', 'Registro con el id= ' . $id . ' eliminado con éxito');
            $data = $proyecto->get(null);
            include('views/proyecto/index.php');
        } else {
            $proyecto->flash('danger', 'Algo fallo');
            $data = $proyecto->get(null);
            include('views/proyecto/index.php');
        }
        break;
    case 'edit':
        $proyecto -> validatePrivilegio('Proyecto Actualizar');
        $dataDepartamentos = $departamento->get(null);
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_proyecto'];
            $cantidad = $proyecto->edit($id, $data);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro actualizado con éxito');
                $data = $proyecto->get(null);
                include('views/proyecto/index.php');
            } else {
                $proyecto->flash('danger', 'Algo fallo');
                $data = $proyecto->get(null);
                include('views/proyecto/index.php');
            }
        } else {
            $data = $proyecto->get($id);
            include('views/proyecto/form.php');
        }
        break;
    case 'task':
        $proyecto -> validatePrivilegio('Proyecto Leer');
        $data = $proyecto->get($id);
        $data_tarea = $proyecto->getTask($id);
        include('views/proyecto/tarea.php');
        break;
    case 'deletetask':
        $proyecto -> validatePrivilegio('Proyecto Borrar');
        $cantidad = $proyecto->deleteTask($id_tarea);
        if ($cantidad) {
            $proyecto->flash('success', 'Registro con el id= ' . $id_tarea . ' eliminado con éxito');
            $data = $proyecto->get($id);
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');
        } else {
            $proyecto->flash('danger', 'Algo fallo');
            $data = $proyecto->get($id);
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');
        }
        break;
    case 'newtask':
        $proyecto -> validatePrivilegio('Proyecto Crear');
        $data = $proyecto->get($id);
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $cantidad = $proyecto->newTask($id, $data2);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro dado de alta con éxito');

            } else {
                $proyecto->flash('danger', 'Algo fallo');
            }
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');
        } else {
            include('views/proyecto/tarea_form.php');
        }
        //$data_tarea = $proyecto->getTask($id);

        break;

    case 'edittask':
        $proyecto -> validatePrivilegio('Proyecto Actualizar');
        $data = $proyecto->get($id);
        if (isset($_POST['enviar'])) {
            $data2 = $_POST['data'];
            $id_tarea = $_POST['data']['id_tarea'];
            $cantidad = $proyecto->editTask($id,$id_tarea, $data2);
            if ($cantidad) {
                $proyecto->flash('success', 'Registro dado de alta con éxito');
            } else {
                $proyecto->flash('danger', 'Algo fallo');
            } 
            $data_tarea = $proyecto->getTask($id);
            include('views/proyecto/tarea.php');

        } else {
            $data_tarea = $proyecto->getTaskOne($id_tarea);
            include('views/proyecto/tarea_form.php');
        }
        break;

    case 'getAll':
    default:
    $proyecto -> validatePrivilegio('Proyecto Leer');
        $data = $proyecto->get(null);
        include("views/proyecto/index.php");
}
include("views/footer.php");
?>