<?php

  class LoginController extends Controller
  {
      public function __construct()
      {
          parent::__construct();
          $this->Terceros = $this->Load_Model('Terceros');
      }

      public function Index() { }

    }
?>
