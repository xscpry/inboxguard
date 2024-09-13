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

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO user (firstname, lastname, gender, email, password) VALUES 
        (:firstname, :lastname, :gender, :email, :password);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':firstname', $this->firstname);
        $query->bindParam(':lastname', $this->lastname);
        $query->bindParam(':gender', $this->gender);
        $query->bindParam(':email', $this->email);
        // Hash the password securely using password_hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(':password', $hashedPassword);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
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