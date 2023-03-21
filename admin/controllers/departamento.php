<?php
require_once("sistema.php");//!llamamos al archivo de sistema.php


class Departamento extends Sistema//extends es heredar los metodos y variables de sistema
{
/**
 * Obtiene los departamentos solicitado
 * 
 * @return array $data los departamentos solicitados
 * @param integer $id si se especifica un id solo obtiene el departamento solicitado, de lo contrario obtiene todos
 */
    public function get($id = null)
    {//si no le pasas id es lo de arriba , si le pasa id es lo de abajo
        $this->db();
        if (is_null($id)) { //si id es nulo
            $sql = "select * from departamento"; //consulta sql de select todo
            $st = $this->db->prepare($sql); //*st es la variable, el obj this llama db para 
                                            //*usar el prepare y pasarle el parametro sql
            $st->execute();//*realizar la consulta
            //$data = $st->fetchAll(PDO::FETCH_ASSOC);
            $data = $st->fetchAll();//*recuperar todo
        } else {
            $sql = "select * from departamento where id_departamento = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);//aqui solo puede recibir un parametro int
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

/**
 * Nuevo departamento
 *
 * @return integer $rc cantidad de filas afectadas por el insert
 * @param array $data los datos del nuevo departamento
 */
    public function new ($data)
    {
        $this->db();
        $sql = "insert into departamento (departamento) values (:departamento)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Editar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el update
     * @param  integer $id el identificador del departamento a editar
     *         array $data los datos modificados del departamento
     */

    public function edit($id, $data)
    {
        $this->db();
        $sql = "update departamento set departamento = :departamento where id_departamento = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->bindParam(":departamento", $data['departamento'], PDO::PARAM_STR);//recibimos un arreglo que es data, lo regresa el formulario
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    /**
     * Borrar departamento
     *
     * @return integer $rc cantidad de filas afectadas por el delete
     * @param  integer $id el identificador del departamento a eliminar
     */
    public function delete($id)
    {
        $this->db();
        $sql = "delete from departamento where id_departamento = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

}
$departamento = new Departamento;
?>