<?php
namespace App;

use App\ActiveRecord;

class Propiedad extends ActiveRecord {     
    protected static $tabla = 'propiedades';
    protected static $columnas = ['id', 'vendedor_id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado'];

    public $id;
    public $vendedor_id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? 0;
        $this->vendedor_id = $args['vendedor_id'] ?? 0;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? 0;
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? 0;
        $this->wc = $args['wc'] ?? 0;
        $this->estacionamiento = $args['estacionamiento'] ?? 0;
        $this->creado = $args['creado'] ?? date('Y/m/d');
    }
}