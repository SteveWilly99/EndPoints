<?php
/**
 * Obtiene todos el historial de tiros de la base de datos
 */

require 'Dados.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $historial = Dados::getHistorialTiros(); 

    if ($historial) {

        $datos["estado"] = 1;
        $datos["usuarios"] = $historial; 

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}