<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

    /**
     * Metodo para validar correo y contrasena
     */
    public function login($correo, $contrasena)
    {
        if (!is_null($contrasena)) {
            if (strlen($contrasena) > 0) {
                if ($this->validateEmail($correo)) {
                    $contrasena = md5($contrasena);
                    $this->db();
                    $sql = "SELECT id_usuario, correo FROM usuario where correo=:correo AND contrasena=:contrasena";
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

    public function validateEmail($correo)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function getRoles($correo)
    {
        $roles = array();
        if ($this->validateEmail($correo)) {
            $this->db();
            $sql = "SELECT r.rol 
            FROM usuario AS u 
            join usuario_rol AS ur on u.id_usuario=ur.id_usuario 
            join rol AS r on ur.id_rol=r.id_rol 
            WHERE u.correo=:correo";
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
            $sql = "SELECT p.privilegio FROM usuario as u join usuario_rol as ur on u.id_usuario=ur.id_usuario 
            join rol as r on ur.id_rol=r.id_rol 
            join rol_privilegio as rp on r.id_rol=rp.id_rol
            join privilegio as p on rp.id_privilegio=p.id_privilegio 
            where u.correo=:correo";
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

    public function validateRol($rol)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado'] = true) {
                if (isset($_SESSION['roles'])) {
                    if (!in_array($rol, $_SESSION['roles'])) {
                        $this->killApp('No tienes el rol adecuado.');
                    }
                } else {
                    $this->killApp('No tienes roles asignados.');
                }
            } else {
                $this->killApp('No estas validado.');
            }
        } else {
            $this->killApp('No te has logeado.');
        }
    }

    public function validatePrivilegio($privilegio)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado'] = true) {
                if (isset($_SESSION['privilegios'])) {
                    if (!in_array($privilegio, $_SESSION['privilegios'])) {
                        $this->killApp('No tienes el privilegio adecuado.');
                    }
                } else {
                    $this->killApp('No tienes privilegios asignados.');
                }
            } else {
                $this->killApp('No estas validado.');
            }
        } else {
            $this->killApp('No te has logeado.');
        }
    }

    public function killApp($msg)
    {
        ob_end_clean();
        include("views/header_error.php");
        $this->flash('danger', $msg);
        include("views/footer_error.php");
        die();
    }

    public function logout()
    {
        unset($_SESSION['logeado']);
        session_destroy();
    }

    public function forgot($destinatario, $token)
    {
        if ($this->validateEmail($destinatario)) {
            require '../vendor/autoload.php';
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Username = '20030115@itcelaya.edu.mx';
            $mail->Password = 'cprfuoeonnqgnovu';
            $mail->setFrom('20030115@itcelaya.edu.mx', 'Christian');
            $mail->addAddress(utf8_decode($destinatario), 'Sistema Constructora');
            $mail->Subject = utf8_decode('Recuperación de contraseña');
            $mensaje = "
            <p>Estimado usuario</p>
            <p>Presione <a href=\"http://localhost/prograweb1/prograweb1/constructora/admin/login.php?action=recovery&token=$token&correo=$destinatario\">Aquí</a> para recuperar la contraseña</p>
            <p>Atentamente la Constructora.</p>
            ";
            $mensaje = utf8_decode($mensaje);
            $mail->msgHTML($mensaje);
            if (!$mail->send()) {
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Message sent!';
            }
            function save_mail($mail)
            {
                $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
                $imapStream = imap_open($path, $mail->Username, $mail->Password);
                $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                imap_close($imapStream);

                return $result;
            }
        }
    }

    public function generarToken($correo)
    {
        $token = "papaschicas";
        $n = rand(1, 100000);
        $x = md5(md5($token));
        $y = md5($x . $n);
        $token = md5($y);
        $token = md5($token . 'calamardo');
        $token = md5('patricio') . md5($token . $correo);
        return $token;
    }

    public function loginSend($correo)
    {
        $data2 = 0;
        if ($this->validateEmail($correo)) {
            $this->db();
            $sql = "SELECT correo FROM usuario where correo=:correo";
            $st = $this->db->prepare($sql);
            $st->bindParam(':correo', $correo, PDO::PARAM_STR);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
            if (isset($data[0])) {
                $token = $this->generarToken($correo);
                $sql2 = "UPDATE usuario SET token=:token WHERE correo=:correo";
                $st2 = $this->db->prepare($sql2);
                $st2->bindParam(':token', $token, PDO::PARAM_STR);
                $st2->bindParam(':correo', $correo, PDO::PARAM_STR);
                $st2->execute();

                $data2 = $st2->rowCount();
                $this->forgot($correo, $token);
            }
        }
        return $data2;
    }
}

$sistema = new Sistema;

?>