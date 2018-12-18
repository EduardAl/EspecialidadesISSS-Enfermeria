<?php 

  class UsersModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function cargarUsuarios(){
      $sql = "SELECT CONCAT(CONCAT(u.fname, ' '), u.lname) AS Nombre, u.email AS Email, u.created_at AS 'Fecha de creación', r.type AS Rol FROM users u INNER JOIN roles r ON u.role_id = r.id;";
      $this->query($sql);
      return $this->registros();
    }

    public function cargarTabla(){

      $datos=[
        'titulo' => ['Nombre','Email','Fecha de creación','Rol'],
        'values' => $this->cargarUsuarios()
      ];
      return $datos;
      }
    public function newUser($params=[])
    {
      //Query // Añadir rol
     $sql = "Select COUNT(email) as number from users where email='".$params['email']."'";
      $this->query($sql);
      $emailExiste = $this->registro();
        if($emailExiste->number==0){
        $sql = "Insert into users values(null,:fname,:lname,:email,sha1(:password),Now(),:rol);";
        $this->query($sql);

        //Introducción de Parámetros
        
        $this->bind(':fname',$params['fname']);
        $this->bind(':lname',$params['lname']);
        $this->bind(':email',$params['email']);
        $this->bind(':password',$params['password']);
        $this->bind(':rol',$params['rol']);

        return $this->execute();
      }
      else{
        $error = 'Ya existe un usuario registrado con este email.';
        throw new Exception($error);
      }
    }
}