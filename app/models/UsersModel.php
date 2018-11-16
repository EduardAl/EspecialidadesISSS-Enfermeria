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
        'tabla' => $this->cargarUsuarios()
      ];
      return $datos;
      }
}