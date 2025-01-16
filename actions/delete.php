<?php 

require "../classes/admin.php";

$UserId = $_GET["UserID"];

$SuspendUser = new Admin("","","");
$SuspendUser->deleteUser($UserId);
header("location: ../DashboardAdmin.php");
exit();