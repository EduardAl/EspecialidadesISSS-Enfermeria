<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Recuperacion extends Controller
{
    public function __construct()
    {
        $this->modelo = $this->modelo("Model_Recuperarpwd");
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function index()
    {
        $this->vista("recover_pwd/recuperar");
    }

    public function enviar_correo()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $mail = $_POST['email'];
            $informacionModelo = $this->modelo->verificar_correo($mail);
            if($informacionModelo == 1)
            {
                $var = $this->generateRandomString(10);
                $informacionModelo = $this->modelo->actualizar_contra($var,$mail);
                $correo = new PHPMailer();
                $correo->CharSet = "utf-8";
                $correo->isSMTP();
                $correo->SMTPAuth = true;
                $correo->Username = "eabigboy4@gmail.com";
                $correo->Password = "ftcanwagiousttj";
                $correo->SMTPSecure = "ssl";
                $correo->Host = "smtp.gmail.com";
                $correo->Port = "465";
                $correo->From ="recuperacion@esto.com";
                $correo->FromName ="Sistema ISSS";
                $correo->addAddress($mail);
                $correo->Subject = "Reestablecer Contraseña";
                $correo->isHTML(true);
                $texto = "Su nueva contraseña es :$var";
                $correo->Body = $texto;
                if($correo->Send())
                {
                    $this->vista("/recover_pwd/recuperar-exito");
                }
                else
                {
                    $var = [
                        "info" => $correo->ErrorInfo
                    ];
                    $this->vista("/recover_pwd/recuperar-fallo",$var);
                }
            }
            else
            {
                $var = [
                    "info" => "Su correo no fue encontrado"
                ];
                $this->vista("/recover_pwd/recuperar-fallo",$var);
            }
        }
    }
}
?>