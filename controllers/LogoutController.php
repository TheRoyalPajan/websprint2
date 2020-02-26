<?php

class LogoutController extends Controller {

    protected $controller;

    public function zpracuj($parametry) {

    
       unset($_SESSION['user']);
       $this->addMeesage("Úspěch", "success", "byl jste úspěšně odhlášen");
       $this->redirect("login"); 
    }

}