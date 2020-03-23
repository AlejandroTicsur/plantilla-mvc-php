<?php

require '../../conf.php';
require lib . '/app.php';
session_start();



/*
	Código principal
*/

return devolverJson([
    'éxito' => true,
    'datos' => [
        'autenticado' => $_SESSION['autenticado'],
        'trabajador' => $_SESSION['trabajador']
    ]
]);
