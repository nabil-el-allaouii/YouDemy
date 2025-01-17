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
                <input type='checkbox' name='tags[]' value='{$tag['tag_content']}'>
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
}