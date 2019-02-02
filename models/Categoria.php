<?php 

class Categoria{

	private $id;
	private $nombre;
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
        $this->id = $this->db->real_escape_string(trim($id));
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string(trim($nombre));
        return $this;
    }

    public function getAll(){
    	$sql = "select * from categorias";
    	$categorias = $this->db->query($sql);

    	$num_resultados = $categorias->num_rows;
    	if($num_resultados > 0){
    		return $categorias;
    	}else{
    		return null;
    	}
    }

    public function save(){
        $sql = "insert into categorias values (null, '{$this->getNombre()}')";
        $nueva_categoria = $this->db->query($sql);

        return $nueva_categoria;

        
    }

    public function getCategoria($id){
        $sql = "select * from categorias where id={$id}";
        $categoria = $this->db->query($sql);

        return $categoria;
    }
}

?>