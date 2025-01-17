<?php
require "../classes/admin.php";
if (isset($_POST["Add-tag"])) {
    $tag = $_POST["tags"];
    if (!empty($tag)) {
        $tags = explode(",", $tag);
        $tagArray = [];
        foreach ($tags as $tag) {
            $trimmed = trim($tag);
            array_push($tagArray, $trimmed);
        }
        $newTag = new Admin("","","");
        $newTag->AddTag($tagArray);
        header("location: ../DashboardAdmin.php");
    }
}
