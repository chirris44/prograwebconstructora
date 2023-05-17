<?php 
header('Content-Type: application/json; charset=utf-8');
include_once(__DIR__.'/../admin/controllers/sistema.php');
include_once(__DIR__.'/../admin/controllers/casos_exito.php');
$accion=$_SERVER["REQUEST_METHOD"];
$id=isset($_GET["id"])?$_GET["id"]:null;
switch ($accion){
    case "DELETE":
        $data['mensaje']='No existe el casos_exito';
        if(!is_null($id)){
            $contador=$casos_exito->delete($id);
            if($contador==1)
                $data['mensaje']='Se elimino el casos_exito';
        }
        break;
    case "POST":
        $data=array();
        $data = $_POST['data'];
        if(is_null($id)){
            $cantidad = $casos_exito->new($data);
            if($cantidad!=0)
                $data['mensaje']='Se inserto el casos_exito';
            else
                $data['mensaje']='Ocurrio un error';
        }else{
            $cantidad=$casos_exito->edit($id,$data);
            if($cantidad!=0)
                $data['mensaje']='Se modifico el casos_exito';
            else
                $data['mensaje']='Ocurrio un error';
        }
        break;
    case "GET":
    default:  
    if(is_null($id))
        $data=$casos_exito->get(); 
    else
        $data=$casos_exito->get($id);
}
$data=json_encode($data);
echo $data;