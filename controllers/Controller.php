<?php

abstract class Controller
{
    // Data co půjdou do pohledu.
    protected $data = array();
    protected $view = "";
    protected $header = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');
    
    abstract function zpracuj($parametry);
    
    // Ošetření proti xss a vložení dat do pohledu
    public function returnView()
    {
        if ($this->view) {
            extract($this->osetri($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("views/" . $this->view . ".phtml");
        }
    }
    
    //Přesměrování na jinou stránku a zastavení zpracování současného skriptu
    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }
    
    //Ošetření proti Cross-Site-Scriptingu
    private function osetri($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x)) {
            foreach ($x as $k => $v) {
                $x[$k] = $this->osetri($v);
            }
            return $x;
        } else
            return $x;
    }
    
   
    public function addMeesage($title, $content, $typ = "success")
    {
        if (isset($_SESSION['messages']))
            $_SESSION['messages'][] = array('content' => $content, 'typ' => $typ, "title" => $title );
        else
            $_SESSION['messages'] = array( array('content' => $content, 'typ' => $typ, "title" => $title ) );
    }
    

    public function returnMessages()
    {
        if (isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        } else
            return array();
    }
    
    /// Ověřování přihlášeného uživatele 
    public function verifyUser($admin = 0)
    {
        // Když uživatel je false(není přihlášen) nebo jeho práva nejsou vyšší než požadovaný - error
        if (!self::currentUser() || !(self::currentUser("role") >= $admin)) {
            $this->addMeesage("Nedostatečná oprávnění. Požádejte administrátra pro zvýšení.", "warning", "Nedostatečná oprávnění");
            $this->redirect('login');
        }
    }
    
    /// Vrátí konkrétni informaci o přihlášeném uživteli
    public function currentUser($co = "all")
    {
        $users = new Users();
        $user = $users->returnUser();
        if ($user) {
            if($co == "all") 
                return $user;
            else 
                return $user[$co];
        } else {
            return null;
        }
     
    }







    
    
}