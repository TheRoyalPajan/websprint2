<?php

class RegisterController extends Controller {

    public function zpracuj($parametry) {
        
        // Vytvoření instance modelu spravce uživatele
        $users = new Users();
        if($this->currentUser("username"))
            $this->redirect("homepage");
        
        // Hlavička stránky
        $this->header['title'] = 'Přihlášení';
        $this->header['description'] = 'Zde se uživatel může přihlásit';
        $this->header['keywords'] = 'auth, login, prihlaseni';

        
      
            if ($_POST)
            {
              
                try {
                    $users->username =  $_POST["username"];
                    $users->name =      $_POST["name"];
                    $users->password =  $_POST["password"];
                    $users->email =     $_POST["email"];
                    $users->phone =     $_POST["phone"];
      
                    $users->register();
                    $users->login();
                  
                    $this->addMeesage('Byl jste úspěšně zaregistrován.', "success", "Registrace - úspěch");
                }   catch (UsersError $chyba) {
                        $this->addMeesage("Někde se stala chyba", $chyba->getMessage(), "error", );
                }
            }           
        
           
        // Nastavení pohledu
        $this->view = '/auth/register';
        
    }

}