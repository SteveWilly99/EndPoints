<?php

/**
 * Representa la estructura de los usuarios
 * almacenados en la base de datos
 */
require 'Database.php';

class Dados {

    function __construct() {
    }

/**
     * Retorna todas las filas de la tabla 'usuarios'
     *
     * @return array Datos de los registros
     */
    public static function getHistorialTiros() {
        $consulta = "SELECT * FROM HistorialTiros";
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
     * Retorna todas las filas de la tabla 'usuarios'
     *
     * @return array Datos de los registros
     */
    public static function getDados() {
        $consulta = "SELECT * FROM Dado";
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
 * Inserta un nuevo dado en la base de datos
 *
 * @param int $cantidadCaras
 * @param string $color
 * @param string $disenio
 * @return array Estado de la operación
 */
public static function insertDado($cantidadCaras, $color, $disenio) {
    $consulta = "INSERT INTO Dado (cantidadCaras, color, disenio) VALUES (:cantidadCaras, :color, :disenio)";
    try {
        // Preparar sentencia
        $comando = Database::getInstance()->getDb()->prepare($consulta);
        // Vincular parámetros
        $comando->bindParam(':cantidadCaras', $cantidadCaras);
        $comando->bindParam(':color', $color);
        $comando->bindParam(':disenio', $disenio);
        // Ejecutar sentencia
        $comando->execute();

        return array("estado" => 1, "mensaje" => "Dado insertado exitosamente");
    } catch (PDOException $e) {
        return array("estado" => 2, "mensaje" => $e->getMessage());
    }
}


/**
 * Actualiza un dado en la base de datos
 *
 * @param int $id
 * @param int $cantidadCaras
 * @param string $color
 * @param string $disenio
 * @return array Estado de la operación
 */
public static function updateDado($id, $cantidadCaras, $color, $disenio) {
    $consulta = "UPDATE Dado SET cantidadCaras = :cantidadCaras, color = :color, disenio = :disenio WHERE id = :id";
    try {
        // Preparar sentencia
        $comando = Database::getInstance()->getDb()->prepare($consulta);
        // Vincular parámetros
        $comando->bindParam(':id', $id);
        $comando->bindParam(':cantidadCaras', $cantidadCaras);
        $comando->bindParam(':color', $color);
        $comando->bindParam(':disenio', $disenio);
        // Ejecutar sentencia
        $comando->execute();

        return array("estado" => 1, "mensaje" => "Dado actualizado exitosamente");
    } catch (PDOException $e) {
        return array("estado" => 2, "mensaje" => $e->getMessage());
    }
}


/**
 * Elimina un dado de la base de datos
 *
 * @param int $id
 * @return array Estado de la operación
 */
public static function deleteDado($id) {
    $consulta = "DELETE FROM Dado WHERE id = :id";
    try {
        // Preparar sentencia
        $comando = Database::getInstance()->getDb()->prepare($consulta);
        // Vincular parámetros
        $comando->bindParam(':id', $id);
        // Ejecutar sentencia
        $comando->execute();

        return array("estado" => 1, "mensaje" => "Dado eliminado exitosamente");
    } catch (PDOException $e) {
        return array("estado" => 2, "mensaje" => $e->getMessage());
    }
}


/**
 * Obtiene un dado por su ID
 *
 * @param int $id
 * @return array Datos del dado
 */
public static function getDadoById($id) {
    $consulta = "SELECT * FROM Dado WHERE id = :id";
    try {
        // Preparar sentencia
        $comando = Database::getInstance()->getDb()->prepare($consulta);
        // Vincular parámetros
        $comando->bindParam(':id', $id);
        // Ejecutar sentencia
        $comando->execute();

        $dado = $comando->fetch(PDO::FETCH_ASSOC);
        if ($dado) {
            return $dado;
        } else {
            return array("estado" => 2, "mensaje" => "Dado no encontrado");
        }
    } catch (PDOException $e) {
        return array("estado" => 2, "mensaje" => $e->getMessage());
    }
}


}

?>