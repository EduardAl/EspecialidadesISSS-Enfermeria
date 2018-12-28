<?php 

  class LoginModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function signIn($email,$password)
    {
      $sql = "SELECT email, password, concat(concat(fname,' '),lname) as 'nombre',role_id as 'tipo' FROM users WHERE email = '{$email}' and password = sha1('{$password}')";
      $this->query($sql);
      return $this->registro();
    }
}
