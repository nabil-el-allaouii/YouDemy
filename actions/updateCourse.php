<?php 

if(isset($_POST["update-course"])){
    $newTitle = $_POST["title"];
    $newDescription = $_POST["description"];
    $newType = $_POST["type"];
    $newCategory = $_POST["category"];
    $newTags = $_POST["tags"];
    $course_id = $_POST["course_id"];

    if(!empty($newTitle)&&!empty($newDescription)&&!empty($newType)&&!empty($newCategory)&&!empty($newTags)){
        if($newType === "video"){
            $newVideo = $_POST["video"];
            require "../classes/CourseVideo.php";
            $modifyVideo = new courseVideo;
            $modifyVideo->modifyCourse($newTitle,$newDescription,$newVideo,$newCategory,$course_id,$newTags,$newType);
            header("location: ../TeacherDashboard.php");
        }
        else{
            $newDocument = $_POST["document"];
            require "../classes/CourseDocument.php";
            $modifyDocument = new coursedocument;
            $modifyDocument->modifyCourse($newTitle,$newDescription,$newDocument,$newCategory,$course_id,$newTags,$newType);
            header("location: ../TeacherDashboard.php");
        }
    }
}