<?php 
require "../classes/students.php";
if(isset($_GET["CourseID"])){
    $course_id = $_GET["CourseID"];
    $Unenroll = new students("","","","");
    $Unenroll->Unenroll($course_id,$_SESSION["id_student"]);
    header("location: ../StudentDashboard.php");
    exit();
}