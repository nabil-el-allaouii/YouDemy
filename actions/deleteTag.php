<?php 
require "../classes/admin.php";
$IdTag = $_GET["TagId"];
$newDelete = new Admin("","","");
$newDelete->deleteTags($IdTag);
header("location: ../DashboardAdmin.php");
exit();
