<?php

require '../../conf.php';
require lib . '/app.php';
require model . '/trabajador.php';
session_start();



/*
    Funciones
*/

/**
 * Valida los datos de entrada devolviendo la fase actual ('id' o 'clave') y un
 * mensaje de error de validación si aplica
 *
 * @param stdClass $entrada
 * @return string
 */
public function validarEntrada(stdClass $entrada)
{
    if ($_SESSION['autenticado']) {
      return 'La sesión ya está iniciada';

    }

    if (!$entrada->id) {
      return 'El campo id es obligatorio';
    }

    if (!$entrada->clave) {
      return 'El campo clave es obligatorio';
    }

    return '';
}



/*
	Código principal
*/

$entrada = recogerEntradaJson();

// Aplicar validación
$error = validarEntrada($entrada);

if ($error) {
    return devolverJson([
        'éxito' => false,
        'mensaje' => $error
    ]);
}


// Comprobar existencia
$trabajador = Trabajador::ver($entrada->id);

if (!$trabajador) {
    return devolverJson([
        'éxito' => false,
        'mensaje' => 'El trabajador no existe.'
    ]);
}


// Comprobar validez
if ($entrada->clave != $trabajador->clave) {
    return devolverJson([
        'éxito' => false,
        'mensaje' => 'Clave incorrecta.'
    ])
}


// Continuar si todo es correcto
$_SESSION['trabajador'] = $trabajador;
$_SESSION['autenticado'] = true;

return devolverJson([
    'éxito' => true,
    'datos' => [ 'trabajador' => $trabajador ]
]);
