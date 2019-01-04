
<?php
 class MantenimientosModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }
    //Procedimientos
    public function insertarProcedimiento($dato,$nombre,$tiempo=0)
    {
      if($dato!=0){
        $dato=($dato<0)?0:$dato;
        echo $params;
      	$sql = "INSERT into procedure_data values (null, :dato,".(($tiempo==0)?"curdate()":("'".$tiempo."'")).",".$nombre.")ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$dato);
        return $this->execute();
      }
    }
    public function insertarLevelThings($nivel,$id,$params,$tiempo=0){
      if($params!=0){
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo $params;
        $params=($params<0)?0:$params;
        echo $params;
        $sql = "INSERT into level_things_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarSpecialtyThings($especialidad,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into specialty_things_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from specialties where id = ".$especialidad.")) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarGoal($especialidad,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into goals values(null,:dato,".(($tiempo==0)?"curdate()":("'".$tiempo."'")).",:id) ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarAusentismo($nivel,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into absences_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarAdministrativo($nivel,$id,$params,$tiempo=0){
      if($params!=0){
        $params=($params<0)?0:$params;
        $sql = "INSERT into administrative_management_data values (null, :dato, ".(($tiempo==0)?"curdate()":("'".$tiempo."'")).", :id,(select id from levels where name like '%".$nivel."%'))ON DUPLICATE KEY UPDATE number=:dato;";
        $this->query($sql);
        $this->bind(':dato',$params);
        $this->bind(':id',$id);
        return $this->execute();
      }
    }
    public function insertarCharla($nivel,$params,$id,$fecha){
      $sql = "INSERT into health_education_data values (null, :dato,'Programada', :id,(select id from levels where name like '%".$nivel."%'),0, '".$fecha."',null);";
      $this->query($sql);
      $this->bind(':dato',$params);
      $this->bind(':id',$id);
      return $this->execute();
    }
    public function actualizarEducacion($id,$params){
      if(count($params)>5){
        $sql = "INSERT into listeners values (null, :dato1, :dato2, :dato3, :dato4, :dato5, :dato6, :id);";
        $this->query($sql);
        $this->bind(':dato2',$params[1]);
        $this->bind(':dato3',$params[2]);
        $this->bind(':dato4',$params[3]);
        $this->bind(':dato5',$params[4]);
        $this->bind(':dato6',$params[5]);
      }
      else{
        $sql="UPDATE health_education_data set listeners=:dato1,updated_at=Now(),status='Realizada' where id=:id";
        $this->query($sql);
      }

      $this->bind(':dato1',$params[0]);
      $this->bind(':id',$id);
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
      $sql = "SELECT type as 'title', id as 'id' from absences;";
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
        $sql = "SELECT name as 'title', id as 'id' from procedures where specialty_id = ".$key->id.";";
        $this->query($sql);
        $formulario = [
          'TítulosX' => ['Indicador','Cantidad'],
          'TítulosY' => $this->registros(),
        ];
        array_push($retornar, $formulario);
      }
      return $retornar;
      }

    public function administrative_management(){
      $sql = "SELECT activities as 'title', id as 'id' from administrative_management;";
      $this->query($sql);
      $formulario = [
        'TítulosX' => ['Descripción','Cantidad'],
        'TítulosY' => $this->registros(),
      ];
      return $formulario;
      }

    public function health_education($nivel){
      $sql = "SELECT type as 'title', id as 'id' from health_education ";

       if($nivel!="quinto")
        $sql=$sql." where id <> 4 ";

      $this->query($sql);
      return $this->registros();
      }
    public function health_education_data($nivel,$fecha=0){
      if(isset($_SESSION['fecha']))
        $fecha=$_SESSION['fecha'];
      $sql = "SELECT Concat('<b>Descripción: </b>',hed.description) as 'title',
      Concat(Concat('<b>Tipo: </b>',he.type),Concat(Concat('&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Fecha: </b>',DATE_FORMAT(hed.created_at,'%Y/%m/%d')),Concat('&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Estado: </b>',hed.status))) as 'detalles', hed.id as 'id', he.listeners as 'tipo' from health_education_data hed
      inner join levels l on l.id=hed.level_id 
      inner join health_education he on he.id=hed.health_education_id 
      where l.name LIKE '%".$nivel."%'";
      if($fecha==0)
        $sql=$sql." and hed.status='Programada'";
      else
        $sql=$sql." and hed.created_at between '".$fecha[0]."' and '".$fecha[1]."'";
      $this->query($sql);
      return $this->registros();
      }

    public function listeners(){
      $valor = ['Enfermería','Colaboradores Clínicos','Recepcionistas','Auxiliares de Servicio','Técnicos de Farmacia','Aux. de Servicio de la Empresa Premium'];

      for ($i=0; $i < count($valor); $i++) { 
        $aux = new stdClass();
        $aux->title=$valor[$i];
        $aux->id=$i;
        $valores[]= $aux;
      }
      $formulario[] = [
        'TítulosX' => ['Descripción','Oyentes'],
        'TítulosY' => $valores,
      ];

      $aux=new stdClass();
      $aux->title='Total';
      $aux->id=1;
      $formulario[]=[
        'TítulosX' => ['Descripción','Oyentes'],
        'TítulosY' => [$aux],
      ];
      return $formulario;
      }
}