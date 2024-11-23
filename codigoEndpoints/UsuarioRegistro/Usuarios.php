<?php

/**
 * Representa la estructura de los usuarios
 * almacenados en la base de datos
 */
require 'Database.php';

class Usuarios {

    function __construct() {
    }

    /**
     * Retorna todas las filas de la tabla 'usuarios'
     *
     * @return array Datos de los registros
     */
    public static function getAll() {
        $consulta = "SELECT * FROM Usuario";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return array("estado" => 2, "mensaje" => $e->getMessage());
        }
    }

    /**
     * Obtiene los campos de un usuario con un identificador
     * determinado
     *
     * @param $Id Identificador del usuario
     * @return mixed
     */
    public static function getById($Id) {
        // Consulta del usuario
        $consulta = "SELECT Id, Nombre, Correo, Contrasenia FROM Usuario WHERE Id = ?";
    
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($Id));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
    
            if ($row) {
                return $row;
            } else {
                // Si no se encuentra el usuario
                return -1;
            }
    
        } catch (PDOException $e) {
            // En caso de error en la consulta
            return array("estado" => 2, "mensaje" => $e->getMessage());
        }
    }
    

    /**
     * Actualiza un registro de la base de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $Id Identificador
     * @param $Nombre Nuevo nombre
     * @param $Correo Nuevo correo
     * @param $Contrasenia Nueva contraseña
     */
    public static function update($Id, $Nombre, $Correo, $Contrasenia) {
        // Creando consulta UPDATE
        $consulta = "UPDATE Usuario SET Nombre=?, Correo=?, Contrasenia=? WHERE Id=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($Nombre, $Correo, $Contrasenia, $Id));

        return $cmd;
    }

    /**
     * Insertar un nuevo usuario
     *
     * @param $Nombre Nombre del nuevo usuario
     * @param $Correo Correo del nuevo usuario
     * @param $Contrasenia Contraseña del nuevo usuario
     * @return PDOStatement
     */
    public static function insert($Nombre, $Correo, $Contrasenia) {
        // Sentencia INSERT
        $comando = "INSERT INTO Usuario (Nombre, Correo, Contrasenia) VALUES (?, ?, ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($Nombre, $Correo, $Contrasenia));
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $Id Identificador del usuario
     * @return bool Respuesta de la eliminación
     */
    public static function delete($Id) {
        // Sentencia DELETE
        $comando = "DELETE FROM Usuario WHERE Id=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($Id));
    }
}

?>
