<?php 

  class LoginModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function signIn($email)
    {
      //$email = $this->db->real_escape_string($email);
      $sql = "SELECT email, password, nombre FROM usuarios WHERE email = '{$email}'";
    //  $sql = "SELECT email, password, (fname + ' ' +  lname) as 'nombre',role_id FROM usuarios WHERE email = '{$email}'";
      $this->query($sql);
      return $this->registro();
    }
    public function newUser($params)
    {
      //Query
       $sql = "Insert into users values(null,:fname,:lname,:email,:password,:created_at)";
      $this->query($sql);

      //Introducción de Parámetros
      $this->bind(':fname',$params['first_name']);
      $this->bind(':lname',$params['last_name']);
      $this->bind(':email',$params['email']);
      $this->bind(':password',$params['pass']);
      $this->bind(':created_at',$params['created']);

      return $this->execute();
    }
}