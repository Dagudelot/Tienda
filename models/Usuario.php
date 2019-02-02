<?php 

class Usuario{

	private $id;
	private $nombre;
	private $apellido;
	private $email;
	private $contrasenia;
	private $rol;
	private $foto_perfil;

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

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $this->db->real_escape_string(trim($apellido));

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string(trim($email));

        return $this;
    }

    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    public function setContrasenia($contras)
    {
        $this->contrasenia = $contras;

        return $this;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $this->db->real_escape_string(trim($rol));

        return $this;
    }

    public function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    public function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $this->db->real_escape_string(trim($foto_perfil));

        return $this;
    }

    public function register(){

        $encrypted_pass = password_hash($this->db->real_escape_string(trim($this->contrasenia), PASSWORD_BCRYPT, ['cost' => 4]));

    	$sql = "insert into usuarios values (null, '".$this->nombre."', '".$this->apellido."', '".$this->email."', '".$encrypted_pass."', 'usuario', null);";
    	$usuario_registro = $this->db->query($sql);


    	return $usuario_registro;

    }

    public function entrar(){

        $sql = "select * from usuarios where email='".$this->email."'";
        $resultado = $this->db->query($sql);

        $usuario = $resultado->fetch_object();

        $verify = password_verify($this->contrasenia, $usuario->contrasena);

        if($verify){
            $_SESSION['usuario'] = $usuario;
        }else{
            $_SESSION['error'] = "El correo y la contraseña no coinciden.";
        }

        header('Location: '.base_url);
    }
}

?>