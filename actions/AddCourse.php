<?php 
if(isset($_POST["Add-course"])){
    $course_title = $_POST["title"];
    $course_description = $_POST["description"];
    $course_type = $_POST["type"];
    $course_category = $_POST["category"];
    $course_tags = $_POST["tags"];
    if(!empty($course_title) && !empty($course_description) && !empty($course_type) && !empty($course_category) && !empty($course_tags)){
        if($course_type === "video"){
            require "../classes/CourseVideo.php";
            $course_video = $_POST["video"];
            $newVideo = new CourseVideo();
            $newVideo->AddCourse($course_title,$course_description,$course_type,$course_category, $course_video,$_SESSION["userId"],$course_tags);
            header("location: ../TeacherDashboard.php");
            exit();
        }else{
            require "../classes/CourseDocument.php";
            $course_document = $_POST["document"];
            $newDoc = new coursedocument();
            $newDoc->AddCourse($course_title,$course_description,$course_type,$course_category, $course_document,$_SESSION["userId"],$course_tags);
            header("location: ../TeacherDashboard.php");
            exit();
        }
    }
}