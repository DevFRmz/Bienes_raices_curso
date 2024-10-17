<?php

namespace App;

use PDO;

abstract class ActiveRecord {
    public $id;
    public $imagen;
    //columnas de la base de datos los cuales son los mismos que los atributos de la clase
    protected static $columnas = ['id', 'vendedor_id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado'];
    protected static PDO $db;//conexión con la base de datos
    protected static $tabla = ''; //cada clase sustituira esta variable con el nombre de su tabla en la bd
    protected static $errores = [];

    //definir la base de datos
    public static function setDB(PDO $database) : void {
        self::$db = $database;
    }

    public function sincronizar(array $args) : void{
        foreach($args as $key => $value){
            $this->$key = $value;
        }
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

        $query = "INSERT INTO " . static::$tabla . "( ";
        $query .= join(', ', array_keys($atributos)); 
        $query .= " ) VALUES ( ";
        $query .= ":" . join(", :", array_keys($atributos));
        $query .= " )";

        $statement = self::$db->prepare($query);
        $this->bindParamAll($statement);
        $succesfull = $statement->execute();

        return $succesfull;
    }

    public function actualizar() : int {
        $atributos = $this->atributos();
        foreach(array_keys($atributos) as $key){
            $values[] = "{$key} = :{$key}";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ", $values); 
        $query .= " WHERE id = :id";

        $statement = self::$db->prepare($query);
        $this->bindParamAll($statement);
        $succesfull =  $statement->execute();
        return $succesfull;
    }

    public function eliminar() {
        //eliminar archivo de imagen
        if(static::$tabla == 'propiedades'){
            $statement = self::$db->prepare("SELECT imagen from " . static::$tabla . " WHERE id = :id");
            $statement->execute([":id" => $this->id]);
            $imagen = $statement->fetch(PDO::FETCH_ASSOC)['imagen'];
            unlink('../imagenes/' . $imagen);//unlik elimina un archivo en la ruta especificada por parametro
        }

        //eliminar registro
        $statement = self::$db->prepare("DELETE FROM " . static::$tabla . " WHERE id = :id");
        $succesfull = $statement->execute([":id" => $this->id]);
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


        return self::$errores;
    }

    public function getErrores() : array {
        return self::$errores;
    }

    public function setImagen($imagen) : void {
        $this->imagen = $imagen;
    }

    //retorna array de objetos para mantener el patron de arquitectura de active record(se ocupa un objeto con las propiedades de la tabla de la base de datos)
    //obtiene todos los registros
    public static function all() : array {
        //usar static en lugar de self hace que tome el valor de la variable $tabla de la clase hija en lugar de esta misma clase
        $query = "SELECT * FROM " . static::$tabla;
        $statement = self::$db->query($query);
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $value){
            $array[] = self::convertirAObjeto($value);
        }

        return $array;
    }

    //devuelve un registro en especifico
    public static function find($id) : object {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = :id";
        $statement = self::$db->prepare($query);
        $statement->execute([':id' => $id]);
        $registro = $statement->fetch(PDO::FETCH_ASSOC);
        $registro = self::convertirAObjeto($registro);
        return $registro;
    }

    //de array assoc a object
    protected static function convertirAObjeto($registro) : object {
        //crea una instancia de la clase que la esta llamando
        $object = new static;
        foreach($registro as $key => $value){
            if(property_exists($object, $key)){
                $object->$key = $value;
            }
        }

        return $object;
    }

    protected function bindParamAll(&$statement) : void {
        foreach(static::$columnas as $columna){
            if($columna == 'id' && $this->id == 0) continue;
            $statement->bindParam(':'. $columna, $this->$columna);
            $arrayPrueba[] = $this->$columna;
            $arrayPrueba2[] = $columna;
        }
    }  
    
}