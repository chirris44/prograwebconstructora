<?php
require_once(__DIR__."/sistema.php");
class Privilegio extends Sistema{
    public function getExcept($id){
        $this->db();
        $sql="select * from privilegio where id_privilegio not in(select rp.id_privilegio from privilegio join rol_privilegio
        rp on privilegio.id_privilegio = rp.id_privilegio where id_rol=:id)";
        $st=$this->db->prepare($sql);
        $st->bindParam(":id",$id,PDO::PARAM_INT);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function get($id=null){
        $this->db();
        if(is_null($id)){
            $sql = "select * from privilegio ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        }else{
            $sql = "select * from privilegio where id_privilegio=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id",$id,PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function new ($data)
    {
        $this->db();
        $sql = "INSERT INTO privilegio (privilegio) VALUES
         (:privilegio)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE privilegio SET privilegio=:privilegio where id_privilegio= :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":privilegio", $data['privilegio'], PDO::PARAM_STR);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM privilegio WHERE id_privilegio=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $this->db();
        $sql2 = "DELETE FROM rol_privilegio WHERE id_privilegio=:id";
        $st2 = $this->db->prepare($sql);
        $st2->bindParam(":id", $id, PDO::PARAM_INT);
        $st2->execute();

        $rc = $st->rowCount();
        return $rc;
    }
}
$privilegio = new Privilegio;
?>