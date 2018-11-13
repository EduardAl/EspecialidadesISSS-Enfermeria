<?php 

  class LoginC extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    public function signIn($email)
    {
      $email = $this->dbh->real_escape_string($email);
      $sql = "SELECT email, password FROM usuarios WHERE email = '{$email}'";
      return $this->dbh->query($sql);
    }
}