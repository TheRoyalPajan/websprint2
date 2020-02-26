<?php 

class LoginController extends Controller {
    protected $kontroler;
    
    public function zpracuj($parametry) {
        
        // Vytvoření instance modelu spravce uživatele
        $users = new Users();
        if($this->currentUser("username"))
            $this->redirect("homepage");
        
        // Hlavička stránky
        $this->header['title'] = 'Přihlášení';
        $this->header['description'] = 'Zde se uživatel může přihlásit';
        $this->header['keywords'] = 'auth, login, prihlaseni';

        if ($_POST) {          
            try{      

                $users->password = $_POST["password"];
                $users->username = $_POST["username"];       
                $users->login();

                $this->addMeesage("Úspěch",'Byl jste úspěšně přihlášen. Nyní si můžete prohlížet váš profil', "success", );
                $this->redirect("homepage");
                // TODO: Redirect do adminu, když user je admin.
            
            } catch (UsersError $chyba) {
                $this->addMeesage("Někde se stala chyba", $chyba->getMessage(), "danger" );                                
            }                
        }            
        
        // Nastavení pohledu
        $this->view = '/auth/login';
        
    }
}   