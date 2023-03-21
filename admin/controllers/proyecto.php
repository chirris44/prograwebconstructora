<?php
require_once("sistema.php");

class Proyecto extends Sistema //extends es heredar los metodos y variables de sistema xd
{
    /**
     * Obtiene los departamentos solicitado
     *
     * @return array $data los departamentos solicitados
     * @param integer $id si se especifica un id solo obtiene el departamento solicitado, de lo contrario obtiene todos
     */
    public function get($id = null)
    { //si no le pasas id es lo de arriba , si le pasa id es lo de abajo
        $this->db();
        if (is_null($id)) {
            $sql = "select * from proyecto p left join departamento d on p.id_departamento=d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            //$data = $st->fetchAll(PDO::FETCH_ASSOC);
            $data = $st->fetchAll();
        } else {
            $sql = "select * from proyecto p left join departamento d on p.id_departamento=d.id_departamento where p.id_proyecto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * Nuevo proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el insert
     * @param array $data los datos del nuevo proyecto
     */
    public function new ($data)
    {
        $this->db();
        $nombrearchivo = str_replace(" ", "_", $data['proyecto']);
        $nombrearchivo = substr($nombrearchivo, 0, 20);
        $sql = "insert into proyecto (proyecto,descripcion,fecha_inicio,fecha_fin,id_departamento)
        values (:proyecto,:descripcion,:fecha_inicio,:fecha_fin,:id_departamento)";
        $sesubio = $this->uploadfile('archivo', 'upload/proyectos/', $nombrearchivo);
        if ($sesubio) {
            $sql = "insert into proyecto (proyecto,descripcion,fecha_inicio,fecha_fin,id_departamento,archivo) 
            values (:proyecto,:descripcion,:fecha_inicio,:fecha_fin,:id_departamento,:archivo)";
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
        return $rc;
    }

    /**
     * Editar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del proyecto a editar
     *         array $data los datos modificados del proyecto
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update proyecto set proyecto = :proyecto,descripcion = :descripcion,
                fecha_inicio = :fecha_inicio,fecha_fin = :fecha_fin, id_departamento=:id_departamento 
                where id_proyecto = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
        $st->bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    /**
     * Borrar proyecto
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del proyecto a eliminar
     */
    public function delete($id)
    {
        $this->db();
        $sql = "delete from proyecto where id_proyecto = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$proyecto = new Proyecto;
?>