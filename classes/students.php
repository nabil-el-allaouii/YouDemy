<?php 
require "users.php";
class students extends users {
    public function __construct($Username, $email,$password,$UserRole)
    {
        parent::__construct($Username, $email,$password,$UserRole);
    }
    public function Enroll($course_id , $user_id){
        $check ="SELECT count(*) from enrollments where course_id = :course_id and user_id = :user_id";
        $check = $this->data->prepare($check);
        $check->bindParam(":course_id", $course_id);
        $check->bindParam(":user_id", $user_id);
        $check->execute();
        $isthere = $check->fetchColumn();
        if($isthere === 0){
            $stmt = "INSERT INTO enrollments(user_id , course_id) values(:user_id , :course_id)";
            $stmt = $this->data->prepare($stmt);
            $stmt->bindParam(":course_id" ,$course_id);
            $stmt->bindParam(":user_id" ,$user_id);
            $stmt->execute();
        }
        
    }
    public function Mycourses($userID){
        $stmt = "SELECT * from enrollments join courses on courses.course_id = enrollments.course_id join users on users.user_id = courses.user_id where enrollments.user_id = :user_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":user_id", $userID);
        $stmt->execute();
        $MyCourses = $stmt->fetchAll();

        foreach($MyCourses as $mycourse){
            echo "
            <div class='course-image'>
                <img src='path/to/course-image.jpg' alt='Course'>
            </div>
            <div class='course-info'>
                <h3>{$mycourse['course_title']}</h3>
                <p class='instructor'>By {$mycourse['user_name']}</p>
                <div class='progress-bar'>
                    <div class='progress' style='width: 60%;'></div>
                </div>
                    <span class='progress-text'>60% Complete</span>
                    <div class='course-actions'>
                    <form action='CourseView.php?CourseID={$mycourse['course_id']}' method='post'>
                        <input type='hidden' name='courseType' value='{$mycourse['course_type']}'>
                        <button class='btn-continue' type='submit' name='StudentView'>Continue Learning</button>
                    </form>
                        <a href='actions/Unenroll.php?CourseID={$mycourse['course_id']}' class='btn-unenroll'>Unenroll</a>
                    </div>
            </div>";
        }
    }
    public function Unenroll($course_id, $user_id){
        $stmt = "DELETE from enrollments where course_id = :course_id and user_id = :user_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":course_id" , $course_id);
        $stmt->bindParam(":user_id" , $user_id);
        $stmt->execute();
    }
}