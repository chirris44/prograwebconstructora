<?php
require_once("sistema.php");
class Casos_Exito extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from casos_exito";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        } else {
            $sql = "select * from casos_exito where id_caso_exito=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }

    public function new ($data)
    {
        $x=rand(1, 10000);
        $this->db();
        $sql = "INSERT INTO casos_exito (caso_exito,descripcion,activo,imagen,resumen) VALUES 
        (:caso_exito,:descripcion,:activo,:imagen,:resumen)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":activo", $data['activo'], PDO::PARAM_BOOL);
        $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
        $resultado=$this->cargarImagen($x,'imagen',"images/");
        $imagen='images/invitado.jpg';
        if($resultado){
            $imagen=$resultado;
        }
        $st->bindParam(":imagen",$imagen);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE casos_exito SET 
        caso_exito = :caso_exito ,descripcion = :descripcion,
        activo = :activo, imagen=:imagen,resumen=:resumen where id_caso_exito= :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":caso_exito", $data['caso_exito'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":activo", $data['activo'], PDO::PARAM_BOOL);
        $st->bindParam(":resumen", $data['resumen'], PDO::PARAM_STR);
        $resultado=$this->cargarImagen($id,'imagen',"images/");
        $imagen='images/invitado.jpg';
        if($resultado){
            $imagen=$resultado;
        }
        $st->bindParam(":imagen",$imagen);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM casos_exito WHERE id_caso_exito=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
}
$casos_exito = new Casos_Exito;
?>