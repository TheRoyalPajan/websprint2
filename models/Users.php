<?php 

class Users {

    public $id;
    public $username;   
    public $name;
    public $password;
    public $role;
    public $email;
    public $phone;

    public $table = "users";

    /// Registruje uživatele 
    public function register() {
        if (strlen($this->password)<=6)
            throw new UsersError('Příliš krátké heslo.');
        
        $user = array( 'name' => $this->name,  'email' => $this->email, 'password' => $this->returnHash(), 'username'=> $this->username, 'phone' => $this->phone);
        

        try {
            Db::vloz($this->table, $user);
        } catch (PDOException $chyba) {
            throw new UsersError('Uživatel s tímto jménem je již zaregistrovaný.');
        }
    }

    /// Příhlásí uživatele
    public function login() {
        $user = Db::dotazJeden("SELECT * FROM $this->table WHERE username = ?", array($this->username));
        
        if (!$user || !password_verify($this->password, $user['password']))
                throw new UsersError('Neplatné jméno nebo heslo.');

        $_SESSION['user'] = $user;
        return true;
    }

    /// Hash hesla
    private function returnHash() {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    /// Vrací teď přihlášeného uživatele
    public function returnUser() {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return null;
    }
}