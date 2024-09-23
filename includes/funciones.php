<?php

define('TEMPLATES_URL', __DIR__ . '/templates/');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

function includeTemplate(string $template, bool $inicio = false) {
    include TEMPLATES_URL . "{$template}";
}

function estaAutenticado() : bool {
    session_start();

    if($_SESSION['login']){
        return true;
    }

    return false;
}

function debuggear($variable) : void {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}