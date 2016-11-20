<?php

require_once '../datos/Conexion.clase.php';

class InicioSesion extends Conexion{
    private $email;
    private $clave;
    
    public function validarSesion(){
        try{
            $sql = "select * from f_validar_sesion(:p_email,:p_clave)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_clave", $this->getClave());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    function getEmail() {
        return $this->email;
    }

    function getClave() {
        return $this->clave;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }


}
