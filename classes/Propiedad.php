<?php
namespace App;

use PDO;

class Propiedad {
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
    
    //columnas de la base de datos los cuales son los mismos que los atributos de la clase
    protected static $columnas = ['id', 'vendedor_id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado'];
    protected static PDO $db;//conexión con la base de datos
    protected static $errores = [];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? 0;
        $this->vendedor_id = $args['vendedor_id'] ?? 0;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? 0.0;
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? 0;
        $this->wc = $args['wc'] ?? 0;
        $this->estacionamiento = $args['estacionamiento'] ?? 0;
        $this->creado = $args['creado'] ?? date('Y/m/d');
    }

    //definir la base de datos
    public static function setDB(PDO $database) : void {
        self::$db = $database;
    }

    //itera sobre los atributos de la clase y los retorna en forma de arreglo
    public function atributos() : array {
        $atributos = [];

        foreach(self::$columnas as $columna) {
            if($columna == 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //regresa 1 si se guardo con exito, 0 si fallo
    public function guardar() : int {
        $atributos = $this->atributos();

        $query = "INSERT INTO propiedades( ";
        $query .= join(', ', array_keys($atributos)); 
        $query .= " ) VALUES ( ";
        $query .= ":" . join(", :", array_keys($atributos));
        $query .= " )";

        $statement = self::$db->prepare($query);
        $succesfull = $statement->execute([
            ':vendedor_id'     => $this->vendedor_id,
            ':titulo'          => $this->titulo,
            ':precio'          => $this->precio,
            ':imagen'          => $this->imagen,
            ':descripcion'     => $this->descripcion,
            ':habitaciones'    => $this->habitaciones,
            ':wc'              => $this->wc,
            ':estacionamiento' => $this->estacionamiento,
            ':creado'          => $this->creado
        ]);

        return $succesfull;
    }

    //validar que el usuario mando todos los datos
    public function validar() : array {
        $datos = $this->atributos();
        foreach ($datos as $key => $value) {
            if(!$value){
                self::$errores[] = "Campo $key es requerido";
            }
        }
    
        if(empty($datos['imagen'])){
            self::$errores[] = "Archivo de imagen requerido";
        }

        return self::$errores;
    }

    public function getErrores() : array {
        return self::$errores;
    }

    public function setImagen($imagen) : void {
        $this->imagen = $imagen;
    }

    //retorna array de objetos para mantener el patron de arquitectura de active record(se ocupa un objeto con las propiedades de la tabla de la base de datos)
    public static function all() : array {
        $query = "SELECT * FROM propiedades";
        $statement = self::$db->query($query);
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $value){
            $array[] = self::convertirAObjeto($value);
        }
        
        return $array;
    }

    //de array a object
    protected static function convertirAObjeto($registro) : object {
        //crea una instancia de su clase padre(esta misma)
        $object = new self;
        
        foreach($registro as $key => $value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }

        return $object;
    }
}