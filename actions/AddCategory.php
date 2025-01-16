<?php
require "../classes/admin.php";
if(isset($_POST["Add-category"])){
    $Category_content = $_POST["category"];
    if(!empty($Category_content)){
        $newCat = new Admin("","","");
        $newCat->AddCategory($Category_content);
        header("location: ../DashboardAdmin.php");
        exit();
    }
}