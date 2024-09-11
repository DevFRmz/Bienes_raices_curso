<?php

session_start();

//vaciar $_SESSION
$_SESSION = [];

//destruir la sesion
session_destroy();

header('Location: /bienesraices');