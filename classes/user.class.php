<?php

require_once 'database.php';

Class User{
    //attributes

    public $user_id;
    public $firstname;
    public $lastname;
    public $gender;
    public $email;
    public $password;
    public $verification_token;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO user (firstname, lastname, gender, email, password, verification_token, is_verified)
        VALUES (:firstname, :lastname, :gender, :email, :password, :token, 0)";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':email', $this->email);
        // Hash the password securely using password_hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
        // For email verification
        $query->bindParam(':token', $this->verification_token);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function verifyToken($token){
        $sql = "SELECT * FROM users WHERE verification_token = :token AND is_verified = 0";
        
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':token', $token);

        if ($query->execute()) {
            $user = $query->fetch();
            if ($user) {
                // Update the user to set is_verified to 1
                $updateSql = "UPDATE user SET is_verified = 1, verification_token = NULL WHERE user_id = :user_id";
                $updateQuery = $this->db->connect()->prepare($updateSql);
                $updateQuery->bindParam(':user_id', $user['user_id']);
                return $updateQuery->execute();
            }
        }
        return false;
    }

    function edit(){
        $sql = "UPDATE user SET firstname=:firstname, lastname=:lastname, gender=:gender, email=:email, password=:password WHERE user_id = :user_id;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':email', $this->email);
        // Hash the password securely using password_hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
        $query->bindParam(':user_id', $this->user_id);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_id', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){
        $sql = "SELECT * FROM user ORDER BY firstname ASC, lastname ASC;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }

    
    function is_email_exist(){
        $sql = "SELECT * FROM user WHERE email = :email;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':email', $this->email);
        if($query->execute()){
            if($query->rowCount()>0){
                return true;
            }
        }
        return false;
    }
}
?>