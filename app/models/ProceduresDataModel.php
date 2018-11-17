<?php 

  class ProceduresDataModel extends Base
  {
    
    public function __construct()
    {
      parent::__construct();
    }

    /*
      ************

      ************
                  */

    public function procedimientos($nombre){
     // $sql = "SELECT p.name as 'titulo',pd.number as 'value' from procedures p inner join procedure_data pd on pd.procedure_id = p.id inner join specialties s on p.specialty_id = s.id where s.id = :idEspecialidad";
      $sql = "SELECT procedures.name as 'Actividad', goals.number as 'Meta', sum(procedure_data.number) as 'Realizado', IFNULL(ROUND(((sum(procedure_data.number)/goals.number)*100), 2), 100) as '% realización' from procedures inner join procedure_data on procedure_data.procedure_id = procedures.id inner join goals on goals.procedure_id = procedures.id inner join specialties on specialties.id = procedures.specialty_id where specialties.name LIKE '%".$nombre."%' and procedure_data.date between '2018-11-01 00:00:00' and '2018-12-31 23:59:59' group by procedures.id;";

      $this->query($sql);
      return $this->registros();
      }

    public function datosEspecialidades($nombre){
      //Modificar el query
      $sql = "SELECT st.name as 'Título', sum(sd.number) as 'Value' from specialty_things_data sd inner join specialty_things st on sd.specialty_things_id=st.id  inner join specialties s on sd.specialty_id=s.id where s.name like '%".$nombre."%' and sd.date between '2018-11-01 00:00:00' and '2018-12-31 23:59:59' group by st.id;";
      $this->query($sql);
      //$this->bind(':nombre',$nombre);
      return $this->registros();
    }
}