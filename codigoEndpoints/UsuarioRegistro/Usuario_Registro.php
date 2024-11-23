<?php
/*
 * Obtiene todos los usuarios de la base de datos
 
require 'Usuarios.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Manejar petición GET
    $usuarios = Usuarios::getAll(); 

    if ($usuarios) {

        $datos["estado"] = 1;
        $datos["usuarios"] = $usuarios; 

        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}

*/


/**
 * Manejo de usuarios con métodos REST
 */

require 'Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar GET para obtener todos los usuarios o uno por ID
    if (isset($_GET['id'])) {
        // Obtener un usuario por ID
        $usuario = Usuarios::getById($_GET['id']);

        if ($usuario) {
            print json_encode(array(
                "estado" => 1,
                "usuario" => $usuario
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Usuario no encontrado"
            ));
        }
    } else {
        // Obtener todos los usuarios
        $usuarios = Usuarios::getAll();

        if ($usuarios) {
            print json_encode(array(
                "estado" => 1,
                "usuarios" => $usuarios
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "Ha ocurrido un error"
            ));
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Manejar POST para insertar un nuevo usuario
    $body = json_decode(file_get_contents("php://input"), true);

    if (isset($body['Nombre'], $body['Correo'], $body['Contrasenia'])) {
        $resultado = Usuarios::insert($body['Nombre'], $body['Correo'], $body['Contrasenia']);

        if ($resultado) {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Usuario creado exitosamente"
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se pudo crear el usuario"
            ));
        }
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Faltan datos para el registro"
        ));
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Manejar PUT para actualizar un usuario
    $body = json_decode(file_get_contents("php://input"), true);

    if (isset($body['Id'], $body['Nombre'], $body['Correo'], $body['Contrasenia'])) {
        $resultado = Usuarios::update($body['Id'], $body['Nombre'], $body['Correo'], $body['Contrasenia']);

        if ($resultado) {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Usuario actualizado exitosamente"
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se pudo actualizar el usuario"
            ));
        }
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Faltan datos para la actualización"
        ));
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Manejar DELETE para eliminar un usuario
    if (isset($_GET['id'])) {
        $resultado = Usuarios::delete($_GET['id']);

        if ($resultado) {
            print json_encode(array(
                "estado" => 1,
                "mensaje" => "Usuario eliminado exitosamente"
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => "No se pudo eliminar el usuario"
            ));
        }
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Falta el identificador del usuario"
        ));
    }
}
?>




