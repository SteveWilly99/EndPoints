<?php
/*
 * Obtiene todos los datos del dado de la base de datos
*/
require 'Dados.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Obtener un dado por ID
        $dado = Dados::getDadoById($_GET['id']);
        print json_encode($dado);
    } else {
        // Obtener todos los dados
        $dados = Dados::getDados(); 
        if ($dados) {
            $datos["estado"] = 1;
            $datos["dados"] = $dados; 
            print json_encode($datos);
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    }
}

/*
 * post dados
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['cantidadCaras'], $data['color'], $data['disenio'])) {
        $resultado = Dados::insertDado($data['cantidadCaras'], $data['color'], $data['disenio']);
        print json_encode($resultado);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Faltan parámetros"
        ));
    }
}


/*
 * put dados
*/

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['id'], $data['cantidadCaras'], $data['color'], $data['disenio'])) {
        $resultado = Dados::updateDado($data['id'], $data['cantidadCaras'], $data['color'], $data['disenio']);
        print json_encode($resultado);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Faltan parámetros"
        ));
    }
}





/*
 * delete dados
*/

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Verificar si el parámetro 'id' está presente en la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Llamar a la función para eliminar el dado
        $resultado = Dados::deleteDado($id);

        if ($resultado) {
            // Si la eliminación fue exitosa
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Dado eliminado exitosamente"
            ));
        } else {
            // Si ocurrió un error al eliminar el dado
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se pudo eliminar el dado"
            ));
        }
    } else {
        // Si no se encuentra el parámetro 'id' en la URL
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Falta el identificador del dado"
        ));
    }
}




