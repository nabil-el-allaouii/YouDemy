<?php 

require "../classes/admin.php";

$UserId = $_GET["UserID"];

$SuspendUser = new Admin("","","");
$SuspendUser->Activate($UserId);
header("location: ../DashboardAdmin.php");
exit();