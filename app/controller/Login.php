<?php
class Login extends Controller
{
  private $model;

  private $session;

  public function __construct()
  {
    $this->model = $this->modelo('LoginModel');
    $this->session = new Session;
  }

  public function index(){
      $this->vista('login/login');
    }
  public function exec()
  {
    $this->render(__CLASS__);
  }

  public function signin()
  {
    //Primero requeriremos los parametros
    $request_params=[
      'email'=> $_POST['email'],
      'password' => $_POST['password']
    ];
    //Verificamos que no estén vacíos
    if($this->verify($request_params))
      return $this->renderErrorMessage('El email y password son obligatorios');

    //Verificamos que exista el correo
    $result = $this->model->signIn($request_params['email']);
    if($this->model->rowCount()!=1)
    {
      echo $this->model->rowCount();
      return $this->renderErrorMessage("El email {$request_params['email']} no fue encontrado");
    }

    //Si se encuentra, verificar que la contraseña esté correcta
    $pass = password_hash($result->password,PASSWORD_DEFAULT);
    //$pass = $result->password;

    if(!password_verify($request_params['password'], $pass))
    {
      return $this->renderErrorMessage('La contraseña es incorrecta');
    }

    $this->session->init();
    $this->session->add('email', $result->email);
    $this->vista('pages/inicio');
  }

  public function signout()
  {
    //Primero requeriremos los parametros
    $this->session->close();
    $this->vista('pages/inicio');
  }

  public function newUser(){
    $this->model->newUser();
  }

  private function verify($request_params)
  {
    return empty($request_params['email']) OR empty($request_params['password']);
  }

  private function renderErrorMessage($message)
  {
    $params = array('error_message' => $message);
    echo $message;
   // $this->vista('Login/login',$message);
  }

}