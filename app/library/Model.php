<?php
  class Model
  {
    protected $db;

   
    public function __construct()
    {
      $this->db = new Mysqli(HOST, USER, PASSWORD, DB_NAME);
    }

    public function __destruct()
    {
      $this->db->close();
  }
}