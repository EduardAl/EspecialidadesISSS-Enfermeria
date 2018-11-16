<?php
class Model_Recuperarpwd
{
    private $db;
    public function __construct()
    {
        $this->db = new Base;
    }

    public function verificar_correo($correo)
    {
        $this->db->query("SELECT * FROM users WHERE users.email = 'eduardo.arevalom97@gmail.com'");
        //$this->db->bind(':correo',$correo,PDO::PARAM_STR);
        $this->db->execute();
        $var = $this->db->rowCount();
        return $var;
    }
}
?>