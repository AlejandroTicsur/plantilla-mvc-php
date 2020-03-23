<?php

require '../conf.php';
require lib . '/app.php';
session_start();


/*
	Código principal
*/

return devolverVista('login', [ 'prueba' => 'este' ]);
