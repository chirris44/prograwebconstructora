<?php
require_once(__DIR__ . "/sistema.php");
class Proyecto extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from proyecto p  left join departamento d 
            on p.id_departamento = d.id_departamento ";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from proyecto p  left join departamento d 
            on p.id_departamento = d.id_departamento where p.id_proyecto=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }

    public function new($data)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $nombrearchivo = str_replace(" ", "_", $data['proyecto']);
            $nombrearchivo = substr($nombrearchivo, 0, 20);

            $sql = "INSERT INTO proyecto (proyecto, descripcion, fecha_inicio,
        fecha_fin, id_departamento) 
        VALUES (:proyecto, :descripcion, :fecha_inicio, :fecha_fin
        ,:id_departamento)";

            $sesubio = $this->uploadfile($data['archivo'], "upload/proyectos/", $nombrearchivo);

            if ($sesubio) {
                $sql = "INSERT INTO proyecto (proyecto, descripcion, fecha_inicio,
        fecha_fin, id_departamento, archivo) 
        VALUES (:proyecto, :descripcion, :fecha_inicio, :fecha_fin
        ,:id_departamento, :archivo)";
            }

            $st = $this->db->prepare($sql);
            $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
            $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
            $st->bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
            $st->bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
            $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);

            if ($sesubio) {
                $st->bindParam(":archivo", $sesubio, PDO::PARAM_STR);
            }
            $st->execute();

            $rc = $st->rowCount();
        } catch (PDOException $Exception) {
            $rc = 0;
            //print "DBA FAIL:" . $Exception->getMessage();
            $this->db->rollBack();
        }

        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        try {
            $this->db->beginTransaction();
            $sql = "DELETE FROM tarea WHERE id_proyecto=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);

            $sql2 = "DELETE FROM proyecto where id_proyecto=:id";
            $st2 = $this->db->prepare($sql2);
            $st2->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $st2->execute();
            $rc = $st2->rowCount();
            $this->db->commit();
        } catch (PDOException $Exception) {
            $rc = 0;
            //print "DBA FAIL:" . $Exception->getMessage();
            $this->db->rollBack();
        }
        return $rc;
    }

    public function edit($id, $data)
    {

        $this->db();
        $nombrearchivo = str_replace(" ", "_", $data['proyecto']);
        $nombrearchivo = substr($nombrearchivo, 0, 20);
        $nombrearchivo = $this->uploadfile("archivo", "uploads/proyectos/", $nombrearchivo);
        if ($nombrearchivo) {
            $sql = "UPDATE proyecto 
        SET proyecto =:proyecto, descripcion =:descripcion,
        fecha_inicio =:fecha_inicio, fecha_fin =:fecha_fin,
        id_departamento =:id_departamento, archivo =:archivo
         where id_proyecto =:id";
        } else {
            $sql = "UPDATE proyecto 
            SET proyecto =:proyecto, descripcion =:descripcion,
            fecha_inicio =:fecha_inicio, fecha_fin =:fecha_fin,
            id_departamento =:id_departamento
             where id_proyecto =:id";
        }
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
        $st->bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        if ($nombrearchivo) {
            $st->bindParam(":archivo", $nombrearchivo, PDO::PARAM_STR);
        }
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function getTask($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from tarea t left join proyecto p 
            on p.id_proyecto = t.id_proyecto";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from tarea t left join proyecto p 
            on p.id_proyecto = t.id_proyecto where t.id_proyecto=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }
    public function deleteTask($id)
    {
        $this->db();
        $sql = "DELETE FROM tarea WHERE id_tarea=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }

    public function newTask($id, $data)
    {
        $this->db();
        $sql = "INSERT INTO tarea (id_proyecto, tarea, avance) VALUES (:id_proyecto, :tarea, :avance)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id_proyecto", $id, PDO::PARAM_INT);
        $st->bindParam(":tarea", $data['tarea'], PDO::PARAM_STR);
        $st->bindParam(":avance", $data['avance'], PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }

    public function getTaskOne($id)
    {
        $data = null;
        $this->db();
        if (is_null($id)) {
            die("Ocurrio un error :c");
        } else {
            $sql = "select * from tarea t left join proyecto p 
            on p.id_proyecto = t.id_proyecto where t.id_tarea=:id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }


        return $data;
    }

    public function editTask($id, $id_tarea, $data)
    {
        $this->db();
        $sql = "UPDATE tarea SET tarea = :tarea,
         avance=:avance where id_tarea= :id_tarea 
         AND id_proyecto=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":id_tarea", $id_tarea, PDO::PARAM_INT);
        $st->bindParam(":tarea", $data['tarea'], PDO::PARAM_STR);
        $st->bindParam(":avance", $data['avance'], PDO::PARAM_INT);
        $st->execute();

        $rc = $st->rowCount();
        return $rc;
    }
    public function chartProyecto()
    {
        $this->db();
        $sql = "select month(p.fecha_inicio) as mes,count(p.id_proyecto) as cantidad from proyecto p
            order by 1 asc ";
        $st = $this->db->prepare($sql);
        $st->execute();
        $data = $st->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

$proyecto = new Proyecto; //Objeto de la clase Proyecto
