<?php

require 'funciones.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';
define("BASE_DIR", "/Curso-Web/Proyecto_15_APPSALON/public/index.php");
define("ROOT_DIR", "/Curso-Web/Proyecto_15_APPSALON/public/");
// Conectarnos a la base de datos
use Model\ActiveRecord;

ActiveRecord::setDB($db);
