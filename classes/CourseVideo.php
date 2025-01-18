<?php
require "Course.php";
class courseVideo extends course
{

    public function __construct()
    {
        parent::__construct();
    }
    public function AddCourse($title, $description, $type, $category, $video, $user_id, $tags)
    {
        $stmt = "INSERT INTO courses(course_title , course_description, course_type, category, course_video, user_id) values(:course_title, :course_description,:course_type,:category,:course_video,:user_id)";
        $tagstmt = "INSERT into coursetags (course_id,tag_id) values (:course_id , :tag_id)";

        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":course_title", $title);
        $stmt->bindParam(":course_description", $description);
        $stmt->bindParam(":course_type", $type);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":course_video", $video);
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
    public function modifyCourse($title,$description,$video,$category,$course_id,$tags,$type) {
        if($type === "video"){
            $changetype = "UPDATE courses set course_type = :course_type , course_document = null";
            $changetype = $this->data->prepare($changetype);
            $changetype->bindParam(":course_type" , $type);
            $changetype->execute();
        }else{
            $change = "UPDATE courses set course_type = :course_type , course_video = null";
            $change = $this->data->prepare($change);
            $change->bindParam(":course_type" , $type);
            $change->execute();
        }
        $deleteCurrTags = "DELETE from coursetags where course_id = :course_id";
        $deleteCurrTags = $this->data->prepare($deleteCurrTags);
        $deleteCurrTags->bindParam(":course_id" , $course_id);
        $deleteCurrTags->execute();
        $tagsINsert = "INSERT into coursetags(tag_id,course_id) values(:tag_id,:course_id)";
        $tagsINsert = $this->data->prepare($tagsINsert);
        $tagsINsert->bindParam(":course_id" , $course_id);
        foreach($tags as $tag){
            $tagsINsert->bindParam(":tag_id" , $tag);
            $tagsINsert->execute();
        }
        $stmt = "UPDATE courses set course_title = :title , course_description = :description , course_video = :video , category = :category where course_id = :course_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":title" , $title);
        $stmt->bindParam(":description" , $description);
        $stmt->bindParam(":video" , $video);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->execute();
    }
    public function RetrieveOldCourse($course_id){
        $array = [];
        $stmt = "SELECT * from courses where course_id = :course_id";
        $categoryStmt = "SELECT * from categories";
        $tags = "SELECT * from tags";
        $TagsInCourse = "select tags.tag_content from coursetags join tags on tags.tag_id = coursetags.tag_id where course_id = :course_id;";

        $TagsInCourse = $this->data->prepare($TagsInCourse);
        $TagsInCourse->bindParam(":course_id" , $course_id);
        $tags = $this->data->prepare($tags);
        $categoryStmt = $this->data->prepare($categoryStmt);
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->execute();
        $categoryStmt->execute();
        $tags->execute();
        $TagsInCourse->execute();


        $course_infos = $stmt->fetch();
        $categories = $categoryStmt->fetchAll();
        $tagsFetch = $tags->fetchAll();
        $courseTags = $TagsInCourse->fetchAll();

        $array["course_info"] = $course_infos;
        $array["categories"] = $categories;
        $array["AllTags"] = $tagsFetch;
        $array["tags_course"] = $courseTags;
        return $array;
    }
}
