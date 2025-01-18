<?php 
require "teacher.php";
abstract class course extends teacher{
    
    public function __construct()
    {   
        parent::__construct("", "", "");
        
    }
    abstract public function AddCourse($title,$description,$type,$category,$content,$user_id,$tags);
    abstract public function ShowCourse();
    abstract public function modifyCourse($title,$description,$content,$category,$course_id,$tags,$type);
}