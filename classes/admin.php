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
                if($teacher['Account_status'] === "suspended"){
                    $DenyAndAccept = "<a href='actions/activate.php?UserID={$teacher['user_id']}'><button class='btn-accept'>Activate</button></a>
                    <a href='actions/delete.php?UserID={$teacher['user_id']}'><button class='btn-deny'>remove</button></a>";
                }else{
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
}
