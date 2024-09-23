<?php

use App\Propiedad;

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//$conn viene de database.php
Propiedad::setDB($conn);
