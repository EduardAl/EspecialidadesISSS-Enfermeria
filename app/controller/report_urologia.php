<?php
require_once '/vendor/koolphp/koolreport/koolreport/autoload.php';

private $host=DB_HOST;
private $user=DB_USER;
private $password=DB_PASSWORD;
private $nombre_base=DB_NAME;
private $port = DB_PORT;

private $dbh;
    
    
class report_urologia extends \koolreport\KoolReport
{
    public function settings()
    {
        $dsn = "mysql:host=".$this->host.';dbname='.$this->nombre_base.';port='.$this->port;
        return array(
            "dataSources"=>array(
                "automaker"=>array(
                    "connectionString"=>$dsn,
                    "username"=>$user,
                    "password"=>$password=DB_PASSWORD;,
                    "charset"=>"utf8"
                )
            )
        );
    }
    
    function setup()
    {
        $this->src($nombre_base)
        ->query("select * from procedures;")
        ->pipe($this->dataStore("employees"));
    }
}
?>
    