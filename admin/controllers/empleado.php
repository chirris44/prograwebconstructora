<?php
require_once("sistema.php");
class Empleado extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from empleado e join departamento d on e.id_departamento=d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll();
        } else {
            $sql = "select * from empleado e join departamento d on e.id_departamento=d.id_departamento
            where id_empleado=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function new($data)
    {
        $validado = $this->validate_curp($data['curp']);
        $rc=0;
        if($validado){
            print_r($validado);
            print_r($data);
            die();
            $this->db();
        $sql = "INSERT INTO empleado (nombre,primer_apellido,segundo_apellido,
        fecha_nacimiento,rfc,curp,id_departamento) VALUES 
        (:nombre,:primer_apellido,:segundo_apellido,:fecha_nacimiento,:rfc,:curp,:id_departamento)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
        }else{
            echo 'La CURP '.$data['curp'].' es inválida';
        }
        return $rc;
    }

    public function guardarFoto($data){
        $this->db();
        $sql = "update empleado set foto=:foto where id_empleado=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $data['id_empleado'], PDO::PARAM_INT);
        $st->bindParam(":foto",$data['foto'],PDO::PARAM_LOB);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }


    public function edit($id, $data)
    {
        $this->db();
        $sql = "UPDATE empleado 
        SET nombre=:nombre,primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,
        fecha_nacimiento=:fecha_nacimiento,rfc=:rfc,curp=:curp,id_departamento=:id_departamento
        where id_empleado= :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
        $st->bindParam(":primer_apellido", $data['primer_apellido'], PDO::PARAM_STR);
        $st->bindParam(":segundo_apellido", $data['segundo_apellido'], PDO::PARAM_STR);
        $st->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
        $st->bindParam(":rfc", $data['rfc'], PDO::PARAM_STR);
        $st->bindParam(":curp", $data['curp'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function delete($id)
    {
        $this->db();
        $sql = "DELETE FROM empleado WHERE id_empleado=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
}
$empleado = new Empleado;
?>
?>