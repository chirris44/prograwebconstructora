<?php
require_once(__DIR__."/sistema.php");
class Usuario extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from usuario ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from usuario u where u.id_usuario=:id";
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
        $sql = "INSERT INTO usuario ( correo,contrasena) 
        VALUES ( :correo, md5(:contrasena))";

        $st = $this->db->prepare($sql);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->bindParam(":contrasena", $data['contrasena'], PDO::PARAM_STR);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM usuario WHERE id_usuario=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $sql = "DELETE FROM usuario_rol WHERE id_usuario=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
            $sql = "UPDATE usuario 
        SET correo =:correo
         where id_usuario =:id";
       
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    public function newRole($id,$data){
        $this->db();
        $sql = "INSERT INTO usuario_rol (id_usuario,id_rol) 
        VALUES (:id,:id_rol)";

        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_rol", $data['id_rol'], PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
}
$usuario = new Usuario; //Objeto de la clase proveedor
?>