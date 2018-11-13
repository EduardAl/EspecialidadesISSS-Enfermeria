<?php

class  Model_Urologia
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }

    public function reporte_diario($fecha)
    {
        //TODO: Agregar query
        $this->db->query();
        $this->db->bind();
        $this->db->execute();
        $var = $this->db->registros();
        return $var;
    }

    public function reporte_rango($fecha_inicio, $fecha_final)
    {
        //TODO: Agregar query
        $this->db->query();
        $this->db->bind();
        $this->db->execute();
        $var = $this->db->registros();
        return $var;
    }

    public function reporte_mensual($mes)
    {
        //TODO: Agregar query
        $this->db->query();
        $this->db->bind();
        $this->db->execute();
        $var = $this->db->registros();
        return $var;
    }


}
?>