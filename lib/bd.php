<?php

require vendor . '/autoload.php';

$capsule = new Illuminate\Database\Capsule\Manager;

// Conectar a la base de datos
$capsule->addConnection([
  'driver'    => 'sqlsrv',
  'host'      => bd['servidor'],
  'port'      => bd['puerto'],
  'database'  => bd['nombre'],
  'username'  => bd['usuario'],
  'password'  => bd['clave'],
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix'    => '',
]);

// Permitir usar esta instancia de Capsule mediante métodos estáticos
$capsule->setAsGlobal();

unset($capsule);
?>
