<?php 
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/proyecto.php');
$accion=$_SERVER["REQUEST_METHOD"];
$id=isset($_GET["id"])?$_GET["id"]:null;
switch ($accion){
    case "DELETE":
        $data['mensaje']='No existe el proyecto';
        if(!is_null($id)){
            $contador=$proyecto->delete($id);
            if($contador==1)
                $data['mensaje']='Se elimino el proyecto';
        }
        break;
    case "POST":
        $data=array();
        $data = $_POST['data'];
        if(is_null($id)){
            $cantidad = $proyecto->new($data);
            if($cantidad!=0)
                $data['mensaje']='Se inserto el proyecto';
            else
                $data['mensaje']='Ocurrio un error';
        }else{
            $cantidad=$proyecto->edit($id,$data);
            if($cantidad!=0)
                $data['mensaje']='Se modifico el proyecto';
            else
                $data['mensaje']='Ocurrio un error';
        }
        break;
    case "GET":
    default:  
    if(is_null($id))
        $data=$proyecto->get(); 
    else
        $data=$proyecto->get($id);
}
$data=json_encode($data);
echo $data;