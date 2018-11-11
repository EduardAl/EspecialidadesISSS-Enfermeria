<?php
class Login extends Controller
{
  private $model;

  private $session;

  public function __construct()
  {
    //$this->model = new Login();
    $this->session = new Session();
  }

  public function index(){
      $this->vista('login/login');
    }
  public function exec()
  {
    $this->render(__CLASS__);
  }

  public function signin($request_params)
  {
    if($this->verify($request_params))
      return $this->renderErrorMessage('El email y password son obligatorios');

    $result = $this->model->signIn($request_params['email']);

    if(!$result->num_rows)
      return $this->renderErrorMessage("El email {$request_params['email']} no fue encontrado");

    $result = $result->fetch_object();

    if(!password_verify($request_params['password'], $result->password))
      return $this->renderErrorMessage('La contraseña es incorrecta');

    $this->session->init();
    $this->session->add('email', $result->email);
    header('location: /php-mvc/main');
  }

  private function verify($request_params)
  {
    return empty($request_params['email']) OR empty($request_params['password']);
  }

  private function renderErrorMessage($message)
  {
    $params = array('error_message' => $message);
    $this->render(__CLASS__, $params);
  }

}