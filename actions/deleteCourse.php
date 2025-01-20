<?php
require "../classes/teacher.php";
$Course_id = $_GET["courseID"];
$newDelete = new teacher("","","");
$newDelete->deleteCourse($Course_id);
if(isset($_SESSION["username"])){
    header("location: ../TeacherDashboard.php");
    exit();
}else{
    header("location: ../DashboardAdmin.php");
    exit();
}


