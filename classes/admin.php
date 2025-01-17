<?php

require "users.php";

class Admin extends users
{

    public function __construct($Username, $email, $password)
    {
        parent::__construct($Username, $email, $password, "admin");
    }

    public function ShowStudents()
    {
        $stmt = $this->data->prepare("SELECT * FROM users WHERE user_role = 'student'");
        $stmt->execute();
        $ShowUsers = $stmt->fetchAll();

        $suspend = "";

        foreach ($ShowUsers as $user) {
            if ($user["Account_status"] === "suspended") {
                $suspend = "<a href='actions/activate.php?UserID={$user['user_id']}'><button class='btn-suspend'>activate</button></a>";
            } else {
                $suspend = "<a href='actions/suspend.php?UserID={$user['user_id']}'><button class='btn-suspend'>suspend</button></a>";
            }
            echo "
            <tr>
                <td>{$user['user_name']}</td>
                <td><span class='status-badge active'>{$user['Account_status']}</span></td>
                <td class='action-buttons'>
                    {$suspend}
                    <a href='actions/delete.php?UserID={$user['user_id']}'><button class='btn-delete'>Delete</button></a>
                </td>
            </tr>
        ";
        }
    }

    public function suspendUser($userID)
    {
        $stmt = "UPDATE users set Account_status = 'suspended' where user_id = :user_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":user_id", $userID);
        $stmt->execute();
        return true;
    }
    public function Activate($userID)
    {
        $stmt = "UPDATE users set Account_status = 'activated' where user_id = :user_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":user_id", $userID);
        $stmt->execute();
        return true;
    }
    public function deleteUser($UserID)
    {
        $stmt = "DELETE from users where user_id = :user_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":user_id", $UserID);
        $stmt->execute();
        return true;
    }
    public function showTeachers()
    {
        $stmt = "SELECT * from users where user_role = 'teacher'";
        $stmt = $this->data->prepare($stmt);
        $stmt->execute();
        $Teachers = $stmt->fetchAll();

        $DenyAndAccept = "";

        foreach ($Teachers as $teacher) {
            if ($teacher['Account_status'] === "desactivated") {
                $DenyAndAccept = "<a href='actions/activate.php?UserID={$teacher['user_id']}'><button class='btn-accept'>Accept</button></a>
                            <a href='actions/delete.php?UserID={$teacher['user_id']}'><button class='btn-deny'>remove</button></a>";
            } else {
                if ($teacher['Account_status'] === "suspended") {
                    $DenyAndAccept = "<a href='actions/activate.php?UserID={$teacher['user_id']}'><button class='btn-accept'>Activate</button></a>
                    <a href='actions/delete.php?UserID={$teacher['user_id']}'><button class='btn-deny'>remove</button></a>";
                } else {
                    $DenyAndAccept = "<a href='actions/suspend.php?UserID={$teacher['user_id']}'><button class='btn-deny'>Suspend</button></a>
                    <a href='actions/suspend.php?UserID={$teacher['user_id']}'><button class='btn-deny'>remove</button></a>";
                }
            }
            echo "
                    <tr>
                        <td>{$teacher['user_name']}</td>
                        <td><span class='status-badge pending'>{$teacher['Account_status']}</span></td>
                        <td class='action-buttons'>
                            {$DenyAndAccept}
                        </td>
                    </tr>";
        }
    }


    public function AddCategory($Content)
    {
        $checkstmt = "SELECT category_content from categories where category_content = :category_content";
        $checkstmt = $this->data->prepare($checkstmt);
        $checkstmt->bindParam(":category_content", $Content);
        $checkstmt->execute();
        $checks = $checkstmt->fetch();

        if (empty($checks)) {
            $stmt = "INSERT into categories(category_content) values(:content)";
            $stmt = $this->data->prepare($stmt);
            $stmt->bindParam(":content", $Content);
            $stmt->execute();
            return true;
        } else {
            return "This category already exists";
        }
    }

    public function ShowCategories()
    {
        $stmt = "SELECT category_content,category_id from categories";
        $stmt = $this->data->prepare($stmt);
        $stmt->execute();

        $categories = $stmt->fetchAll();

        foreach ($categories as $category) {
            echo "<tr>
                        <td>{$category['category_content']}</td>
                        <td>
                            <a href='actions/deleteCategory.php?categoryID={$category['category_id']}'><button class='btn-delete'>Delete</button></a>
                        </td>
                  </tr>";
        }
    }

    public function DeleteCategory($CategoryID)
    {
        $stmt = "DELETE from categories where category_id = :category_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":category_id", $CategoryID);
        $stmt->execute();
        return true;
    }

    public function AddTag($TagContent)
    {
        $checkstmt = "SELECT * from tags where tag_content = :content";
        $checkstmt = $this->data->prepare($checkstmt);
        foreach ($TagContent as $Tag) {
            $checkstmt->bindParam(":content", $Tag);
            $checkstmt->execute();
            $TagThere = $checkstmt->fetch();

            if (empty($TagThere)) {
                $stmt = "INSERT into tags (tag_content) values(:tag_content)";
                $stmt = $this->data->prepare($stmt);
                $stmt->bindParam(":tag_content", $Tag);
                $stmt->execute();
            }
        }
    }

    public function Showtags()
    {
        $stmt = "SELECT * from tags";
        $stmt = $this->data->prepare($stmt);
        $stmt->execute();
        $Tags = $stmt->fetchAll();

        foreach ($Tags as $tag) {
            echo "<tr>
                        <td>{$tag['tag_content']}</td>
                        <td>
                        <a href='actions/deleteTag.php?TagId={$tag['tag_id']}'><button class='btn-delete'>Delete</button></a>
                        </td>
                    </tr>";
        }
    }

    public function deleteTags($tagID){
        $stmt = "DELETE from tags where tag_id = :tag_id";
        $stmt = $this->data->prepare($stmt);
        $stmt->bindParam(":tag_id" , $tagID);
        $stmt->execute();
        return true;
    }
}
