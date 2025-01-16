<?php 
require "../classes/admin.php";
$CategoryID = $_GET["categoryID"];

$newDelete = new Admin("","","");
$newDelete->DeleteCategory($CategoryID);
header("location: ../DashboardAdmin.php");
exit();