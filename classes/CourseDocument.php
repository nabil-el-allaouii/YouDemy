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
    public function ShowCourse() {}
}