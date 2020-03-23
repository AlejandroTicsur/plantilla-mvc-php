<?php

require_once lib . '/bd.php';
use Illuminate\Database\Capsule\Manager as Capsule;


class Trabajador
{
    // Convierte cada columna de la fila en el tipo de dato correcto
    private static function formatearFila(stdClass $fila)
    {
        $fila->id = (int) $fila->id;
        $fila->clave = (int) $fila->clave;
        $fila->rol = (int) $fila->rol;

        return $fila;
    }


    // Devuelve los datos de un trabajador dado su ID
    static function ver($id)
    {
        $resultado = Capsule::table('vTrabajadores')->where('id', $id)->first();

        if ($resultado) {
            $resultado = self::formatearFila($resultado);
        }

        return $resultado;
    }
}
?>
