<?php
require_once RUTA_APP."/koolreport/autoload.php";
class urologia_model extends \koolreport\KoolReport
{
    $opcion = $_POST['opcion'];
    $host = DB_HOST;
    $user = DB_USER;
    $pass = DB_PASSWORD;
    $db = DB_NAME;
    $port = DB_PORT;
    
    $connectionString = "mysql:host=$host;dbname=$db;port=$port";
    
    public function settings()
    {
        return array(
            "dataSources"=>array(
                "data"=>array(
                    "connectionString"=>$connectionString,
                    "username"=>$this->$user,
                    "password"=>$this->$pass,
                    "charset"=>"utf8"
                )
            )
        );
    }
    
    function setup()
    {
        $this->src("data")
        ->query("select * from procedures")
        ->pipe($this->dataStore("urologia"));
    }
}
?>  