
<?php
 class MantenimientosModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }
    //Procedimientos
    public function insertarProcedimiento($dato,$nombre)
    {
	 $sql = "INSERT into procedure_data values (null, :dato, curdate(), (select id from procedures where name like '%".$nombre."%'));";
      $this->query($sql);
      $this->bind(':dato',$dato);
      return $this->execute();
    }
}