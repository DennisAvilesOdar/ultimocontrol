<?php

require_once '../negocio/curso.php';
require_once '../util/funciones/Funciones.clase.php';
require_once './token.validar.php';

if (! isset($_POST["token"])){
    Funciones::imprimeJSON(500, "debe especificar un token", "");
    exit();
}

$token = $_POST["token"];

try {
    
    if (validarToken($token)) {
        $obj = new curso();
        $resultado = $obj->listar();
        
        $listaArticulo = array();
        for ($i=0; $i<count($resultado);$i++){
            
            /*Obtener foto articulo*/
            $foto = $obj->obtenerFoto($resultado[$i]["codigo_articulo"]);
            /*Obtener foto articulo*/
            
            $datosArticulo = array
                    (
                        "codigo" => $resultado[$i]["codigo"],
                        "nombre" => $resultado[$i]["nombre"],
                        "cantidad_creditos" => $resultado[$i]["cantidad_creditos"],
                        "numero_vacantes" => $resultado[$i]["numero_vacantes"],
                        "foto" => $foto
                    );
            $listaArticulo[$i] = $datosArticulo;
        }
        
        Funciones::imprimeJSON(200,"",$listaArticulo);
        
    }
    
} catch (Exception $exc) {
    
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}