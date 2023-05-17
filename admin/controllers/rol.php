<?php
require_once(__DIR__."/sistema.php");
class Rol extends Sistema
{
    public function getExcept($id){
        $this->db();
        $sql="select * from rol where id_rol not in(select ur.id_rol from rol join usuario_rol
        ur on rol.id_rol = ur.id_rol where id_usuario=:id)";
        $st=$this->db->prepare($sql);
        $st->bindParam(":id",$id,PDO::PARAM_INT);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from rol";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        } else {
            $sql = "select * from rol where id_rol=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }

    public function new ($data)
    {
        $this->db();
        $sql = "INSERT INTO rol (rol) VALUES (:rol)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE rol SET rol = :rol where id_rol= :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":rol", $data['rol'], PDO::PARAM_STR);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM rol WHERE id_rol=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function newPrivilegio($id,$data){
        $this->db();
        $sql = "INSERT INTO rol_privilegio (id_rol,id_privilegio) 
        VALUES (:id,:id_privilegio)";

        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_privilegio", $data['id_privilegio'], PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
}
$rol = new Rol;
?>