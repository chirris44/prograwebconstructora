<?php
require_once("sistema.php");
class Proyecto extends Sistema
{
    /** 
     *Obtiene los departamentos solicitado
     *@return array $data los departamentos solicitados
     *@param integer $id si se especifica un id solo se obtiene el departamento solicitado
     *
     */
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from proyecto p left join 
                departamento d on p.id_departamento = d.id_departamento";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from proyecto p left join 
                departamento d on p.id_departamento = d.id_departamento where p.id_proyecto = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    /** 
     *Crear departamento
     *@return integer $$rc cantidad de filas afecatdas por el insert
     *@param integer $data los dtaos dle nuevo departamento
     *
     */
    public function new($data)
    {
        $this->db();
        $nombrearchivo = str_replace(" ", "_", $data['proyecto']);
        $nombrearchivo = substr($nombrearchivo, 0, 20);
        $sql = "insert into proyecto (proyecto,descripcion,
            fecha_inicio,fecha_fin,id_departamento) values 
            (:proyecto,:descripcion,:fecha_inicio,:fecha_fin,:id_departamento)";
        $sesubio = $this->uploadfile("archivo","upload/proyectos/", $nombrearchivo);
        if ($sesubio) {
            $sql = "insert into proyecto (proyecto,descripcion,
            fecha_inicio,fecha_fin,id_departamento,archivo) values 
            (:proyecto,:descripcion,:fecha_inicio,:fecha_fin,:id_departamento,:archivo)";
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
     *Editar proyecto
     *@return integer $$rc cantidad de filas afecatdas por el update
     *@param integer $did el identificadoor del proyecto aeditar
     *
     */
    public function edit($id, $data)
    {
        $this->db();
        $sql = "update proyecto set proyecto = :proyecto ,
        descripcion = :descripcion, fecha_inicio = :fecha_inicio,
        fecha_fin = :fecha_fin, id_Departamento=:id_departamento where id_proyecto=:id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":proyecto", $data['proyecto'], PDO::PARAM_STR);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":fecha_inicio", $data['fecha_inicio'], PDO::PARAM_STR);
        $st->bindParam(":fecha_fin", $data['fecha_fin'], PDO::PARAM_STR);
        $st->bindParam(":id_departamento", $data['id_departamento'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
    /** 
     *Borrar proyecto
     *@return integer $$rc cantidad de filas afecatdas por el update
     *@param integer $did el identificadoor del proyecto aeditar
     *
     */
    public function delete($id)
    {
        $this->db();
        $sql = "delete from proyecto where id_proyecto= :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(':id', $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$proyecto = new Proyecto;
