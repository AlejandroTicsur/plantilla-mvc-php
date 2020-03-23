<?php

require '../../conf.php';
require lib . '/app.php';
session_start();
requerirAutenticación();



/*
	Código principal
*/

$_SESSION['autenticado'] = false;
unset($_SESSION['trabajador']);

return devolverJson([ 'éxito' => true ]);
