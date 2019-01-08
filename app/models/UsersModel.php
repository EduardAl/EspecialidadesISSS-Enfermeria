<?php 

  class UsersModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function cargarUsuarios(){
      $sql = "SELECT CONCAT(CONCAT(u.fname, ' '), u.lname) AS Nombre, u.email AS Email, u.created_at AS 'Fecha de creación', r.type AS Rol, u.id AS Extra FROM users u INNER JOIN roles r ON u.role_id = r.id where r.type <> 'Master';";
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

    public function cargarUsuario($id="'';",$extra=0){
      $sql = "SELECT u.fname AS Nombre,u.lname AS Apellido, u.email AS Email, u.role_id AS Rol,u.id as Id FROM users u where ";
      if($extra)
        $sql=$sql."u.email='".$id."' LIMIT 1";
      else
        $sql=$sql."u.id=".$id." LIMIT 1";
      $this->query($sql);
      return $this->registro();
     }

    public function newUser($params=[]) {
      //Query // Añadir rol
      if(!$this->existeCorreo($params['email'])){
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

    public function updateUser($params=[]) {
      //Query // Añadir rol
      if(!$this->existeCorreo($params['email'],$params['id'])){
        $sql = "Update users set fname=:fname,lname=:lname,email=:email";
        if(isset($params['password'])&&$params['password']!='')
          $sql=$sql.",password=sha1(:password)";
        if(isset($params['rol']))
          $sql=$sql.",role_id=:rol";
        $sql=$sql." where id=".$params['id'];
        $this->query($sql);

        //Introducción de Parámetros
        
        $this->bind(':fname',$params['fname']);
        $this->bind(':lname',$params['lname']);
        $this->bind(':email',$params['email']);
        if(isset($params['password'])&&$params['password']!='')
          $this->bind(':password',$params['password']);
        if(isset($params['rol']))
          $this->bind(':rol',$params['rol']);

        return $this->execute();
      }
      else{
        $error = 'Ya existe otro usuario registrado con este email.';
        throw new Exception($error);
      }
      }

    public function deleteUser($id=0){
      $sql = "DELETE FROM users WHERE id = ".$id;
      $this->query($sql);
      return $this->execute();
      }

    private function existeCorreo($email,$id=0){
      $sql = "Select COUNT(email) as number from users where email='".$email."' and id <>".$id;
      $this->query($sql);
      return ($this->registro()->number>0);
      }
}