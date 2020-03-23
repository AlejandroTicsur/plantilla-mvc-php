<?php

/**
 * Devuelve si el formato de la fecha es el indicado (por defecto 'Y-m-d')
 *
 * @param string $fecha
 * @return bool
 */
function validarFormatoFecha($fecha, $formato = 'Y-m-d')
{
    $d = DateTime::createFromFormat($formato, $fecha);

    return $d && $d->format($formato) === $fecha;
}
?>
