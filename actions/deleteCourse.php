<?php
require "../classes/teacher.php";
$Course_id = $_GET["courseID"];
$newDelete = new teacher("","","");
$newDelete->deleteCourse($Course_id);
header("location: ../TeacherDashboard.php");
