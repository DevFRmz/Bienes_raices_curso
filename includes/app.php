<?php

use App\ActiveRecord;

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//$conn viene de database.php
ActiveRecord::setDB($conn);
