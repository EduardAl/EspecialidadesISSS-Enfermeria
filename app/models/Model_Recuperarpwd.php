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
        $this->db->query("SELECT * FROM users WHERE users.email = :correo");
        $this->db->bind(':correo',$correo,PDO::PARAM_STR);
        $this->db->execute();
        $var = $this->db->rowCount();
        return $var;
    }

    public function actualizar_contra($pwd,$correo)
    {
        $this->db->query("UPDATE users set users.password = sha1(:pwd) where users.email = :correo");
        $this->db->bind(':pwd',$pwd,PDO::PARAM_STR);
        $this->db->bind(':correo',$correo,PDO::PARAM_STR);
        $this->db->execute();
        $var = $this->db->rowCount();
        return $var;
    }
}
?>