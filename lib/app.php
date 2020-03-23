<?php

/*
  Entrada y salida
*/

/**
 * Recoje los datos enviados en la URL del mensaje HTTP
 *
 * @return stdClass
 */
function recogerEntradaUrl()
{
    return (object) $_GET;
}


/**
 * Recoje los datos JSON enviados en el cuerpo del mensaje HTTP
 *
 * @return stdClass
 */
function recogerEntradaJson()
{
    return json_decode(file_get_contents('php://input'));
}


/**
 * Recoje los datos form-data enviados en el cuerpo del mensaje HTTP
 *
 * @return stdClass
 */
function recogerEntradaForm()
{
    return (object) $_POST;
}


/**
 * Devuelve una respuesta HTTP en JSON dado un array u objeto
 */
function devolverJson($objeto)
{
    header('Content-Type: application/json');
    echo json_encode($objeto);
}


/**
 * Devuelve una vista
 *
 * @param string $nombre
 * @param array $params
 */
function devolverVista($nombre, array $params = [])
{
    $params = (object) $params;
    require views . "/$nombre.php";
}



/*
  Autenticación
*/

/**
 * Devuelve si el usuario en sesión tiene exactamente el rol indicado
 *
 * @return bool
 */
function usuarioTieneRol($rol)
{
    return $_SESSION['trabajador']->rol == $rol;
}


/**
 * Si el usuario en sesión no está autenticado o no cumple con el rol exigido,
 * devuelve un JSON de error y rompe la ejecución
 */
function requerirAutenticación($rol = roles['invitado'])
{
    $mensaje = '';

    if (!$_SESSION['autenticado']) {
        $mensaje = 'Usuario no autenticado';

    } elseif (!usuarioTieneRol($rol)) {
        $mensaje = 'Usuario no autorizado';
    }

    if ($mensaje) {
        return devolverJson([
            'éxito' => false,
            'mensaje' => $mensaje
        ]);
    }

    // Permitir acceso si todo es correcto
}
?>
