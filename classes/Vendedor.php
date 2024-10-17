<?php
namespace App;

use App\ActiveRecord;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnas = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? 0;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? 0;
    }
}