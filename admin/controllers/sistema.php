<?php
require_once('config.php');
class Sistema
{
  var $db = null;
  /**
   * Conexión a la base de datos
   *
   * @return PDOObject en $this->db
   * @param del archivo de configuracion config.php
   */
  public function db()
  {
    $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
    $this->db = new PDO($dsn, DBUSER, DBPASS);
  }
  /**
   * Imprime un mensaje usando alerts de bootstrap
   *
   * @param $color el color del alert
   *        $msg el mesaje a imprimir
   */
  public function flash($color, $msg){
    include('views/flash.php');
  }

  public function uploadfile($tipo, $ruta,$archivo){
    $name = false;
    $uploads['archivo'] = array("application/gzip","application/zip",'application/x-zip-compressed');
    $uploads['fotografia'] = array("image/jpeg","image/gif","image/png");
    if($_FILES[$tipo]['error']==0){
        if(in_array($_FILES[$tipo]['type'],$uploads['archivo'])){
            if($_FILES[$tipo]['size']<=2*1048*1048){
                $origen = $_FILES[$tipo]['tmp_name'];
                $extension = explode(".",$_FILES[$tipo]['name']);
                $extension = $extension[sizeof($extension)-1];
                $destino = $ruta. $archivo.".".$extension;
                
                if(move_uploaded_file($origen,$destino)){
                    $name = $destino;
                }
            }
        }
        if(in_array($_FILES[$tipo]['type'],$uploads['fotografia'])){
          if($_FILES[$tipo]['size']<=2*1048*1048){
              $origen = $_FILES[$tipo]['tmp_name'];
              $extension = explode(".",$_FILES[$tipo]['name']);
              $extension = $extension[sizeof($extension)-1];
              $destino = $ruta. $archivo.".".$extension;
              
              if(move_uploaded_file($origen,$destino)){
                  $name = $destino;
              }
          }
      }
    }
    return $name;
  }
}

?>