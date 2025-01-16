<?php

if (isset($_POST["Add-tag"])) {
    $tag = $_POST["tags"];
    if (!empty($tag)) {
        $tags = explode(",", $tag);
        $tagArray = [];
        foreach ($tags as $tag) {
            array_push($tagArray, $tag);
        }
        $newTag = new Admin("","","");
    }
}
