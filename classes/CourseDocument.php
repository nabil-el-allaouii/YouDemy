<?php 
require "Course.php";
class coursedocument extends course {
    public function __construct()
    {
        parent::__construct();
    }
    public function AddCourse($title, $description, $type, $category, $document, $user_id, $tags)
    {
        $stmt = "INSERT INTO courses(course_title , course_description, course_type, category, course_document, user_id) values(:course_title, :course_description,:course_type,:category,:course_document,:user_id)";
        $tagstmt = "INSERT into coursetags (course_id,tag_id) values (:course_id , :tag_id)";

        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":course_title", $title);
        $stmt->bindParam(":course_description", $description);
        $stmt->bindParam(":course_type", $type);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":course_document", $document);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        $course_id = $this->data->lastInsertId();

        $tagstmt = $this->data->prepare($tagstmt);
        foreach ($tags as $tag) {
            $tagstmt->bindParam(":tag_id", $tag);
            $tagstmt->bindParam(":course_id", $course_id);
            $tagstmt->execute();
        }
    }
    public function ShowCourse($course_id) {
        $stmt = "SELECT * from courses join users on users.user_id = courses.user_id where courses.course_id = :course_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->execute();
        $CourseDocument = $stmt->fetch();
        echo "
        <div class='course-container text-course'>
            <div class='course-header'>
                <h1 class='course-title'>{$CourseDocument['course_title']}</h1>
                <div class='course-meta'>
                    <span class='category'>{$CourseDocument['Category']}</span>
                    <span class='instructor'>By {$CourseDocument['user_name']}</span>
                </div>
            </div>
            <div class='course-content'>
                <div class='content-text'>
                    {$CourseDocument['course_document']}
                </div>
            </div>
        </div>";
    }
    public function modifyCourse($title,$description,$document,$category,$course_id,$tags,$type) {
        if($type === "video"){
            $changetype = "UPDATE courses set course_type = :course_type , course_document = null where course_id = :course_id";
            $changetype = $this->data->prepare($changetype);
            $changetype->bindParam(":course_type" , $type);
            $changetype->bindParam(":course_id" , $course_id);
            $changetype->execute();
        }else{
            $change = "UPDATE courses set course_type = :course_type , course_video = null where course_id = :course_id";
            $change = $this->data->prepare($change);
            $change->bindParam(":course_type" , $type);
            $change->bindParam(":course_id" , $course_id);
            $change->execute();
        }

        $deleteCurrTags = "DELETE from coursetags where course_id = :course_id";
        $deleteCurrTags = $this->data->prepare($deleteCurrTags);
        $deleteCurrTags->bindParam(":course_id" , $course_id);
        $deleteCurrTags->execute();
        $stmt = "UPDATE courses set course_title = :title , course_description = :description , course_document = :document , category = :category where course_id = :course_id";
        $tagsINsert = "INSERT into coursetags(tag_id,course_id) values(:tag_id,:course_id)";
        $tagsINsert = $this->data->prepare($tagsINsert);
        $tagsINsert->bindParam(":course_id" , $course_id);
        foreach($tags as $tag){
            $tagsINsert->bindParam(":tag_id" , $tag);
            $tagsINsert->execute();
        }

        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":title" , $title);
        $stmt->bindParam(":description" , $description);
        $stmt->bindParam(":document" , $document);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->execute();
    }

}