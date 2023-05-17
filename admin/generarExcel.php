<?php
require("../SimpleXLSXGen/SimpleXLSXGen.php");
require_once(__DIR__."/controllers/departamento.php");
require_once(__DIR__."/controllers/proyecto.php");
require_once(__DIR__."/controllers/sistema.php");

$header = [['Departamento'
,'Proyecto'
,'Descripcion'
,'Fecha Inicial'
,'Fecha Final'
,'Tarea'
,'Avance']];
$action = (isset($_GET['action'])) ? $_GET['action'] : "getAll";
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$sistema->db();
switch ($action) {
    case 'proyecto':
        $sql = "select departamento,proyecto,descripcion,fecha_inicio
        ,fecha_fin,tarea,avance from vw_proyecto 
            where id_proyecto=:id";
            $st = $sistema->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 'calidad':
        $data = $cali->leer();
        break;
}

$resultado = array_merge($header, $data);

$xlsx = Shuchkin\SimpleXLSXGen::fromArray($resultado);
if ($action == 'reporte') {
    $xlsx->downloadAs('reporte.xlsx');
} else {
    $xlsx->downloadAs($data[0]["nombre_area"] . '.xlsx');
}
?>