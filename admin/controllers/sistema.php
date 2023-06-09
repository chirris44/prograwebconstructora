<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//echo(__DIR__.'/../config.php');
//die();
require_once(__DIR__.'/../config.php');
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

    public function validateCupr($curp){
        
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
            $mensaje =  "
            Estimado usuario. <br>
            <a href=\"http://localhost/prograwebconstructora/admin/login.php?action=recovery&token=$token&correo=$destinatario\">Presione aqui para recuperar la contraseña.</a> <br>
            Atentamente Constructora.
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
    public function validateToken($correo, $token){
        if(strlen($token)==64){
            if($this->validateEmail($correo)){
                $this->db();
                $sql = "SELECT correo FROM usuario where correo=:correo and token=:token";
                $st = $this->db->prepare($sql);
                $st->bindParam(':correo', $correo, PDO::PARAM_STR);
                $st->bindParam(':token', $token, PDO::PARAM_STR);
                $st->execute();
                $data = $st->fetchAll(PDO::FETCH_ASSOC);
                if(isset($data[0])){
                    return true;
                }
            }
        }
        return false;
    }
    public function resetPassword($correo,$token,$contrasena){
        $cantidad=0;
        if(strlen($token)==64 and strlen($contrasena)>0){
            if($this->validateEmail($correo)){
                $contrasena=md5($contrasena);
                $this->db();
                $sql = "UPDATE usuario set contrasena=:contrasena,token=null 
                        where correo=:correo and token=:token";
                $st = $this->db->prepare($sql);
                $st->bindParam(':correo', $correo, PDO::PARAM_STR);
                $st->bindParam(':token', $token, PDO::PARAM_STR);
                $st->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $st->execute();
                $cantidad = $st->rowCount();
            }
        }
        return $cantidad;
    }
    public function validate_curp($valor) {     
        if(strlen($valor)==18){         
           $letras     = substr($valor, 0, 4);
           $numeros    = substr($valor, 4, 6);         
           $sexo       = substr($valor, 10, 1);
           $mxState    = substr($valor, 11, 2); 
           $letras2    = substr($valor, 13, 3); 
           $estado=$this->is_mx_state($mxState); 
           $sexo=$this->is_sexo_curp($sexo);
             if(ctype_alpha($letras) && ctype_alpha($letras2) && ctype_digit($numeros) && $estado && $sexo){ 
               return true; 
           }         
       return false;
        }else{
            return false; 
       } 
   }
   public function is_mx_state($state){     
    $mxStates = [         
        'AS','BS','CL','CS','DF','GT',         
        'HG','MC','MS','NL','PL','QR',         
        'SL','TC','TL','YN','NE','BC',         
        'CC','CM','CH','DG','GR','JC',         
        'MN','NT','OC','QT','SP','SR',         
        'TS','VZ','ZS'     
    ];     
    if(in_array(strtoupper($state),$mxStates)){         
        return true;     
    }     
    return false; 
}
public function is_sexo_curp($sexo){     
    $sexoCurp = ['H','M'];     
    if(in_array(strtoupper($sexo),$sexoCurp)){         
       return true;     
    }     
    return false; 
}
function cargarImagen($id,$atributo,$ruta){
    $resultado=false;
    $extensiones=array("image/jpeg","image/png","image/gif");
    if(isset($_FILES[$atributo])){
        if($_FILES[$atributo]['error']==0){
            if($_FILES[$atributo]['size']<=1000*1024){
                if(in_array($_FILES[$atributo]['type'],$extensiones)){
                    $extension=explode('.',$_FILES[$atributo]['name']);
                    $extension=$extension[count($extension)-1];
                    $ruta=$ruta.$id.".".$extension;
                    if(move_uploaded_file($_FILES[$atributo]['tmp_name'],$ruta)){
                        $resultado=$ruta;
                    }else{
                        $resultado=false;
                    }
                }
            }
        } 
    }
    return $resultado;
}
}

$sistema = new Sistema;
