
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
	 $sql = "INSERT into procedure_data values (null, :dato, curdate(),".$nombre.");";
      $this->query($sql);
      $this->bind(':dato',$dato);
      return $this->execute();
    }
    public function insertarLevelThings($nivel,$id,$params){
      //number, date,level_things_id,level id
      $sql = "INSERT into level_things_data values (null, :dato, curdate(), (select id from level_things where id = '".$id."'),(select id from levels where name like '%".$nivel."%'));";
      $this->query($sql);
      $this->bind(':dato',$params);
      return $this->execute();
    }
    public function insertarSpecialtyThings($especialidad,$id,$params){
      //number, date,level_things_id,level id
      $sql = "INSERT into specialty_things_data values (null, :dato, curdate(), (select id from specialty_things where id = '".$id."'),(select id from specialties where id = ".$especialidad."));";
      $this->query($sql);
      $this->bind(':dato',$params);
      return $this->execute();
    }

    /*
      ************************
      * Carga de Formularios *
      ************************
    */
    public function specialities($level){
      $sql = "SELECT s.name as 'title', s.id as 'id' from specialties s inner join levels l on s.level_id = l.id where l.name like '%".$level."%'";
      $this->query($sql);
      return $this->registros();
     }
    public function levelThings(){
      $sql = "SELECT name as 'title', id as 'id' from level_things;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
        'Tipo' => ['number']
      ];
      return $formulario;
      } 
    public function specialtyThings(){
      $sql = "SELECT name as 'title', id as 'id' from specialty_things;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
        'Tipo' => ['number']
      ];
      return $formulario;
      } 
    public function absences(){
      $sql = "SELECT type as 'title', id as 'id' from absences;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
        'Tipo' => []
      ];
      return $formulario;
      }
    public function procedures($nivel,$specialties){
      $retornar=[];
      foreach ($specialties as $key) {
        $sql = "SELECT name as 'title', id as 'id' from procedures where specialty_id = ".$key->id.";";
        $this->query($sql);
        $formulario = [
          'TítulosX' => ['Indicador','Cantidad'],
          'TítulosY' => $this->registros(),
          'Tipo' => ["number"]
        ];
        array_push($retornar, $formulario);
      }
      return $retornar;
      }
    //
}