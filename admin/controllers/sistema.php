<?php
session_start();
require_once('config.php');
class Sistema
{

    var $db = null;

    public function db()
    {
        $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
        $this->db = new PDO($dsn, DBUSER, DBPASS);
    }

    public function flash($color, $msg)
    {
        include('views/flash.php');
    }

    public function uploadfile($tipo, $ruta, $archivo)
    {
        $name = false;
        $uploads['archivo'] = array("application/gzip", "application/zip", "application/x-zip-compressed");
        $uploads['fotografia'] = array("image/jpeg", "image/jpg", "image/gif", "image/png");
        if ($_FILES[$tipo]['error'] == 4) {
            return $name;

        }
        if ($_FILES[$tipo]['error'] == 0) {
            if (in_array($_FILES[$tipo]['type'], $uploads['archivo'])) {
                if ($_FILES[$tipo]['size'] <= 2 * 1048 * 1048) {
                    $origen = $_FILES[$tipo]['tmp_name'];
                    $ext = explode(".", $_FILES[$tipo]['name']);
                    $ext = $ext[sizeof($ext) - 1];
                    $destino = $ruta . $archivo . "." . $ext;
                    if (move_uploaded_file($origen, $destino)) {
                        $name = $destino;
                    }
                }
            }
        }
        return $name;
    }
    public function login($correo, $contrasena)
    {
        if (!is_null($contrasena)) {
            if (strlen($contrasena) > 0) {
                if ($this->validateEmail($correo)) {
                    $contrasena = md5($contrasena);
                    $this->db();
                    $sql = 'select id_usuario, correo from usuario where correo=:correo and contrasena=:contrasena';
                    $st = $this->db->prepare($sql);
                    $st->bindParam(":correo", $correo, PDO::PARAM_STR);
                    $st->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                    $st->execute();
                    $data = $st->fetchAll(PDO::FETCH_ASSOC);
                    if (isset($data[0])) {
                        $data = $data[0];
                        $_SESSION = $data;
                        $_SESSION['roles'] = $this->getRoles($correo);
                        $_SESSION['privilegios'] = $this->getPrivilegios($correo);
                        $_SESSION['validado'] = true;
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION["logeado"]);
        session_destroy();
    }
    public function getRoles($correo)
    {
        $roles = array();
        if ($this->validateEmail($correo)) {
            $this->db();
            $sql = 'select r.rol from usuario u join usuario_rol ur on u.id_usuario=ur.id_usuario join rol r on ur.id_rol = r.id_rol where u.correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $rol) {
                array_push($roles, $rol['rol']);
            }
        }
        return $roles;
    }
    public function getPrivilegios($correo)
    {
        $privilegios = array();
        if ($this->validateEmail($correo)) {
            $this->db();
            $sql = 'select p.privilegio from usuario u join usuario_rol ur on u.id_usuario=ur.id_usuario join rol r on ur.id_rol = r.id_rol join rol_privilegio rp on r.id_rol = rp.id_rol join privilegio p on rp.id_privilegio= p.id_privilegio where u.correo = :correo';
            $st = $this->db->prepare($sql);
            $st->bindParam(":correo", $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as $key => $privilegio) {
                array_push($privilegios, $privilegio['privilegio']);
            }
        }
        return $privilegios;
    }
    public function validateEmail($correo)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    public function validateRol($rol)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                if (isset($_SESSION['roles'])) {
                    if (!in_array($rol, $_SESSION['roles'])) {
                        $this->killApp('No tienes el rol adecuado');
                    }
                }else{
                $this->killApp('No tienes roles asignados'); 
                }
            }else{
                $this->killApp('No estas validado');
            }
        }else{
            $this->killApp('No te has logueado');
        }
    }
    public function validatePrivilegio($privilegio)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                if (isset($_SESSION['privilegios'])) {
                    if (!in_array($privilegio, $_SESSION['privilegios'])) {
                        $this->killApp('No tienes el privilegio adecuado');
                    }
                }else{
                $this->killApp('No tienes privilegios asignados'); 
                }
            }else{
                $this->killApp('No estas validado');
            }
        }else{
            $this->killApp('No te has logueado');
        }
    }
    public function killApp($mensaje)
    {
        ob_end_clean();
        include('views/header_error.php');
        $this->flash('danger', $mensaje);
        include('views/footer_error.php');
        die();
    } 
}
$sistema = new Sistema;
?>