<?php

require_once 'database.php';

class Account{

    public $user_id;
    public $email;
    public $password;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function sign_in_user(){
        $sql = "SELECT * FROM user WHERE email = :email LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        
        if ($query->execute()) {
            $accountData = $query->fetch(PDO::FETCH_ASSOC);
    
            if ($accountData && password_verify($this->password, $accountData['password'])) {
                $this->user_id = $accountData['user_id'];
                return true;
            }
        }
    
        return false;
    }    
}
?>