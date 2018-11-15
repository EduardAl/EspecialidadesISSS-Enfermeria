<?php 

  class LoginModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function signIn($email,$password)
    {
      $sql = "SELECT email, password, concat(concat(fname,' '),lname) as 'nombre',role_id FROM users WHERE email = '{$email}' and password = sha1('{$password}')";
      $this->query($sql);
      return $this->registro();
    }

    public function newUser($params=[])
    {
      $params=[
        'first_name'=>'Julie',
        'last_name'=>'Reyes',
        'email'=>'algo@email.com',
        'pass'=>'algo123'
      ];
      //Query // Añadir rol
     $sql = "Insert into users values(null,:fname,:lname,:email,sha1(:password),curdate());";
      $this->query($sql);

      //Introducción de Parámetros
      $this->bind(':fname',$params['first_name']);
      $this->bind(':lname',$params['last_name']);
      $this->bind(':email',$params['email']);
      $this->bind(':password',$params['pass']);
     // $this->bind(':created_at',$params['created']);

      return $this->execute();
    }

    //Usuarios
    public function insertarUsuario(){

    }
    public function actualizarUsuario(){

    }
    public function eliminarUsuario(){
      
    }
}