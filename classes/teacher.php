<?php
require "users.php";

class teacher extends users{
    public function __construct($Username, $email,$password)
    {
        parent::__construct($Username, $email,$password,"teacher");
    }

    public function showTags(){
        $stmt = "SELECT * from tags";
        $stmt = $this->data->prepare($stmt);
        $stmt->execute();
        $tags = $stmt->fetchAll();

        foreach($tags as $tag){
            echo "
            <label class='tag-checkbox'>
                <input type='checkbox' name='tags[]' value='{$tag['tag_id']}'>
                <span>{$tag['tag_content']}</span>
            </label>";
        }
    }
    public function showCategories(){
        $stmt = "SELECT * from categories";
        $stmt = $this->data->prepare($stmt);
        $stmt->execute();

        $categories = $stmt->fetchAll();

        foreach($categories as $category){
            echo "<option value='{$category['category_content']}'>{$category['category_content']}</option>";
        }
    }

    public function TeacherCourses($userID){
        $stmt = "SELECT * from courses where user_id = :user_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":user_id" ,$userID);
        $stmt->execute();

        $Courses = $stmt->fetchAll();
        foreach($Courses as $course){
            echo "<tr>
                    <td>{$course['course_title']}</td>
                    <td>{$course['Category']}</td>
                    <td>{$course['course_type']}</td>
                    <td class='course-actions'>
                    <form action='CourseView.php?CourseID={$course['course_id']}' method='post'>
                        <input type='hidden' name='courseType' value='{$course['course_type']}'>
                        <button type='submit' class='btn-view' name='View'>View</button>
                    </form>    
                        <a href='modifyCourse.php?courseID={$course['course_id']}'><button class='btn-edit'>Edit</button></a>
                        <a href='actions/deleteCourse.php?courseID={$course['course_id']}'><button class='btn-delete'>Delete</button></a>
                    </td>
                </tr>";
        }
    }
    public function deleteCourse($courseID){
        $stmt = "DELETE from courses where course_id = :course_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":course_id" , $courseID);
        $stmt->execute();
    }

}