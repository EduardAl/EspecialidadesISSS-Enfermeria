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
      $sql = "SELECT procedures.name as 'Actividad', goals.number as 'Meta', sum(procedure_data.number) as 'Realizado', IFNULL(ROUND(((sum(procedure_data.number)/goals.number)*100), 2), 100) as '% realización' from procedures inner join procedure_data on procedure_data.procedure_id = procedures.id inner join goals on goals.procedure_id = procedures.id inner join specialties on specialties.id = procedures.specialty_id where specialties.name LIKE '%".$nombre."%' and procedure_data.date between '2018-11-12 00:00:00' and '2018-11-14 23:59:59' group by procedures.id;";
      $this->query($sql);
      //$this->bind(':nombre',$nombre);
      return $this->registros();
      }

    // Procedimientos,
    //Charlas y Educación en Salud es un sólo formato
    //Educación continua un solo formato: charlas, metas, %
    public function tablaProcedimientos($nombre){
      $sql = "SELECT procedures.name as 'Actividad', goals.number as 'Meta', sum(procedure_data.number) as 'Realizado', IFNULL(ROUND(((sum(procedure_data.number)/goals.number)*100), 2), 100) as '% realización' from procedures inner join procedure_data on procedure_data.procedure_id = procedures.id inner join goals on goals.procedure_id = procedures.id inner join specialties on specialties.id = procedures.specialty_id where specialties.name LIKE '%".$nombre."%' and procedure_data.date between '2018-11-12 00:00:00' and '2018-11-14 23:59:59' group by procedures.id;";
      $this->query($sql);
      //$this->bind(':nombre',$nombre);
      return $this->registros();
    }
}