
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
      if($dato>0){
      	$sql = "INSERT into procedure_data values (null, :dato, curdate(),".$nombre.")ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$dato);
        return $this->execute();
      }
    }
    public function insertarLevelThings($nivel,$id,$params){
      if($params>0){
        $sql = "INSERT into level_things_data values (null, :dato, curdate(), :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarSpecialtyThings($especialidad,$id,$params){
      if($params>0){
        $sql = "INSERT into specialty_things_data values (null, :dato, curdate(), :id,(select id from specialties where id = ".$especialidad.")) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarGoal($especialidad,$id,$params){
      if($params>0){
        $sql = "INSERT into goals values(null,:dato,curdate(),:id) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarAusentismo($nivel,$id,$params){
      if($params>0){
        $sql = "INSERT into absences_data values (null, :dato, curdate(), :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarAdministrativo($nivel,$id,$params){
      if($params>0){
        $sql = "INSERT into administrative_management_data values (null, :dato, curdate(), :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function actualizarEducacion($nivel,$id,$params){
      if($params>0){
        $sql = "INSERT into administrative_management_data values (null, :dato, curdate(), :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }

    /*
      ************************
      * Carga de Formularios *
      ************************
    */
    public function specialities($level){
      $sql = "SELECT s.name as 'title', s.id as 'id' from specialties s inner join levels l on s.level_id = l.id where l.name like '%".$level."%' order by title";
      $this->query($sql);
      return $this->registros();
     }
    public function levelThings(){
      $sql = "SELECT name as 'title', id as 'id' from level_things;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      } 
    public function specialtyThings(){
      $sql = "SELECT name as 'title', id as 'id' from specialty_things;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      } 
    public function absences(){
      $sql = "SELECT type as 'title', id as 'id' from absences order by title;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Indicador','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }
    public function procedures($nivel,$specialties){
      $retornar=[];
      foreach ($specialties as $key) {
        $sql = "SELECT name as 'title', id as 'id' from procedures where specialty_id = ".$key->id." order by title;";
        $this->query($sql);
        $formulario = [
          'TítulosX' => ['Indicador','Cantidad'],
          'TítulosY' => $this->registros(),
        ];
        array_push($retornar, $formulario);
      }
      return $retornar;//
      }

    public function administrative_management(){
      $sql = "SELECT activities as 'title', id as 'id' from administrative_management order by activities;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Descripción','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }

    public function health_education(){
      $sql = "SELECT activities as 'title', id as 'id' from health_education order by activities;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Descripción','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }
}