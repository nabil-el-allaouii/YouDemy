<?php 


require "db.php";

class users {
    private $user_name;
    private $email;
    private $password;
    private $user_role;
    private $data;
    private $status = "activated";

    public function __construct($Username, $email,$password,$UserRole)
    {
        $this->user_name = $Username;
        $this->email = $email;
        $this->password = $password;
        $conn = new Database;
        $this->data = $conn->Getconnection();
        $this->user_role = $UserRole;
    }

    public function Signup(){
        if($this->user_role === "teacher"){
            $stmt = "INSERT into users (user_name,user_email,user_password,user_role) values (:user_name,:user_email,:user_password,:user_role)";
            $stmtsend = $this->data->prepare($stmt);
            $stmtsend->bindParam(":user_name",$this->user_name);
            $stmtsend->bindParam(":user_email",$this->email);
            $stmtsend->bindParam(":user_password" , $this->password);
            $stmtsend->bindParam(":user_role" , $this->user_role);
            $stmtsend->execute();
        }
        else{
            $stmt = "INSERT into users (user_name,user_email,user_password,user_role,Account_status) values (:user_name,:user_email,:user_password,:user_role,:Account_status)";
            $stmtsend = $this->data->prepare($stmt);
            $stmtsend->bindParam(":user_name",$this->user_name);
            $stmtsend->bindParam(":user_email",$this->email);
            $stmtsend->bindParam(":user_password" , $this->password);
            $stmtsend->bindParam(":user_role" , $this->user_role);
            $stmtsend->bindParam(":Account_status" , $this->status);
            $stmtsend->execute();
        }
    }
}