<?php 


require "db.php";
session_start();

class users {
    protected $user_name;
    protected $email;
    protected $password;
    protected $user_role;
    protected $data;
    protected $status = "activated";
    private $error = "";

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

    public function signin(){
        $stmt = "SELECT * from users where user_email = :email";
        $checkstmt = $this->data->prepare($stmt);
        $checkstmt->bindParam(":email" , $this->email);
        $checkstmt->execute();
        $hashed_pass = $checkstmt->fetch();

        if($hashed_pass && password_verify($this->password ,$hashed_pass["user_password"])){
            if($hashed_pass["user_role"] === "admin"){
                $_SESSION["Admin_user"] = $hashed_pass["user_name"];
                $_SESSION["AdminId"] = $hashed_pass["user_id"];
                header("location: DashboardAdmin.php");
                exit();
            }
            else if($hashed_pass["user_role"] === "teacher"){
                $_SESSION["username"] = $hashed_pass["user_name"];
                $_SESSION["userId"] = $hashed_pass["user_id"];
                header("location: TeacherDashboard.php");
                exit();
            }
            else{
                $_SESSION["user_student"] = $hashed_pass["user_name"];
                $_SESSION["id_student"] = $hashed_pass["user_id"];
                header("location: StudentDashboard.php");
                exit();
            }
        }
        else{
            return $this->error = "wrong username or password";
        }
        
    }

    public function Pagination(){
        $array = [];
        $perPage = 3;
        $stmt = "SELECT count(*) from courses";
        $stmt = $this->data->prepare($stmt);
        $stmt->execute();
        $NumberOfCourses = $stmt->fetchColumn();

        $totalPages = ceil($NumberOfCourses / $perPage);
        $currentPage = isset($_GET["page"])? "{$_GET['page']}" : "1";

        $x = ($currentPage - 1) * $perPage;
        $y = $perPage;
        $Courses = "SELECT * from courses Limit $x , $y";
        $Courses = $this->data->prepare($Courses);
        $Courses->execute();
        $Content = $Courses->fetchAll();

        $array["course_info"] = $Content;
        $array["number_of_pages"] = $totalPages;
        return $array;
    }
}