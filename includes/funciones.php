<?php

define('TEMPLATES_URL', __DIR__ . '/templates/');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', realpath(__DIR__ . '/../imagenes') . '/');
define('CARPETA_PROYECTO', 'Bienes_raices_curso');

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