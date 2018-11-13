<?php

date_default_timezone_set('UTC');

class  Report_Urologia
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }

    public function reporte_diario()
    {
        $sql = "SELECT * from procedures";
        $this->db->query($sql);
        $this->db->execute();
        $var = $this->db->registros();
        return $var;

    }
}
?>