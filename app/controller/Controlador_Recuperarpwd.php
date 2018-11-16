<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Controlador_Recuperarpwd extends Controller
{
    public function __construct()
    {
        $this->modelo = $this->modelo("Model_Recuperarpwd");
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
            if(1 == 1)
            {
                $correo = new PHPMailer();
                $correo->CharSet = "utf-8";
                $correo->isSMTP();
                $correo->SMTPAuth = true;
                $correo->Username = "eabigboy4@gmail.com";
                $correo->Password = "ftcanwagiousttji";
                $correo->SMTPSecure = "ssl";
                $correo->Host = "smtp.gmail.com";
                $correo->Port = "465";
                $correo->From ="recuperacion@esto.com";
                $correo->FromName ="Edu :DDDD";
                $correo->addAddress("eduardo.arevalom97@gmail.com","Edu 2");
                $correo->Subject = "Reestablecer Contraseña";
                $correo->isHTML(true);
                $correo->Body = "Hola";
                if($correo->Send())
                {
                    $this->vista("/recover_pwd/recuperar-exito");
                }
                else
                {
                    echo 'Message could not be sent. Mailer Error: ', $correo->ErrorInfo;
                }
            }
        }
    }
}
?>