
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
      	$sql = "INSERT into procedure_data values (null, ".$dato.", curdate(),".$nombre.");";
        $this->query($sql);
        return $this->execute();
      }
    }
    public function insertarLevelThings($nivel,$id,$params){
      if($params>0){
        $sql = "INSERT into level_things_data values (null, :dato, curdate(), (select id from level_things where id = '".$id."'),(select id from levels where name like '%".$nivel."%'));";
        $this->query($sql);
        $this->bind(':dato',$params);
        return $this->execute();
      }
    }
    public function insertarSpecialtyThings($especialidad,$id,$params){
      if($params>0){
        $sql = "INSERT into specialty_things_data values (null, :dato, curdate(), :id,(select id from specialties where id = ".$especialidad."));";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarGoal($especialidad,$id,$params){
      if($params>0){
        $sql = "BEGIN TRAN
        IF EXISTS(select * from goals where procedure_id=:id and month(date)=month(curdate()) and year(curdate())) then 
        UPDATE goals set number=':dato' where procedure_id=:id and month(date)=month(curdate()) and year(curdate())
        ELSE 
          INSERT into goals values(null,:dato,curdate(),:id)
        COMMIT";
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
      return $retornar;
      }
    //
}