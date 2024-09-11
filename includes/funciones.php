<?php

require 'app.php';

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