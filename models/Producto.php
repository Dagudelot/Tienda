<?php 

class Producto{

	private $id;
	private $categoria_id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $oferta;
	private $fecha;
	private $imagen;
    private $stock;
	private $db;

	public function __construct(){
		$this->db = database::connect();
	}


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    public function setCategoriaId($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function getAll(){
    	$sql = "select * from productos";
    	$productos = $this->db->query($sql);

    	return $productos;
    }

    public function agregar(){
    	
    	require_once('views/producto/agregarProducto.php');

    }

    public function save(){

    	$sql = "insert into productos values (null, '{$this->categoria_id}', '{$this->nombre}', '{$this->descripcion}', {$this->precio}, {$this->oferta}, null, '{$this->imagen}', {$this->stock});";

        $producto_guardado = $this->db->query($sql);

        return $producto_guardado;

    }

    public function eliminar(){
        $sql = "delete from productos where id={$this->id}";
        $eliminado = $this->db->query($sql);

        return $eliminado;
    }

    public function buscarProducto(){
        $sql = "select * from productos where id={$this->id}";
        $encontrado = $this->db->query($sql);

        return $encontrado;
    }

    public function update(){

        if($this->imagen != null){
            $sql = "update productos set categoria_id={$this->categoria_id}, nombre='{$this->nombre}', descripcion='{$this->descripcion}', precio={$this->precio}, oferta={$this->oferta}, imagen='{$this->imagen}', stock={$this->stock} where id={$this->id};";
        }else{
            $sql = "update productos set categoria_id={$this->categoria_id}, nombre='{$this->nombre}', descripcion='{$this->descripcion}', precio={$this->precio}, oferta={$this->oferta}, stock={$this->stock} where id={$this->id};";   
        }

        $producto_guardado = $this->db->query($sql);

        return $producto_guardado;

    }

    public function getRandom($limite){
        $sql = "select * from productos order by rand() limit {$limite}";
        $productos = $this->db->query($sql);

        return $productos;
    }

    public function getByCategory($id_categoria){
        $sql = "select * from productos where categoria_id in (select id from categorias where id={$id_categoria});";
        $productos = $this->db->query($sql);

        return $productos;
    }

    public function getOne($id){
        $sql = "select c.nombre as 'nombre_categoria', p.* from categorias c, productos p where c.id = p.categoria_id and p.id = {$id}";
        $producto = $this->db->query($sql);

        return $producto;
    }

}

?>