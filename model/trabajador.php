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


    // Devuelve una lista de todos los trabajadores con opción a filtros y
    // paginación
    static function listar(array $filtros = [], $pág = null)
    {
        $consulta = Capsule::table('vTrabajadores');

        // Aplicar filtros
        //


        // Definir objeto de resultado
        $resultado = new stdClass;
        $resultado->filas = [];

        if ($pág) {
            // Aplicar algoritmo de paginación
            $págs = (int) ceil($consulta->count() / máxFilas);
            $primera = (máxFilas * $pág) - máxFilas;

            $consulta = $consulta->skip($primera)->take(máxFilas);
            $resultado->págs = $págs;
        }

        // Dar formato a cada uno de los resultados
        foreach ($consulta->get() as $fila) {
            $resultado->filas[] = self::formatearFila($fila);
        }

        return $resultado;
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
