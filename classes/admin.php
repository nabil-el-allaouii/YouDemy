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
            if($user["Account_status"] === "suspended"){
                $suspend = "<button class='btn-suspend'>activate</button>";
            }else{
                $suspend = "<button class='btn-suspend'>suspend</button>";
            }
            echo "
            <tr>
                <td>{$user['user_name']}</td>
                <td><span class='status-badge active'>{$user['Account_status']}</span></td>
                <td class='action-buttons'>
                    {$suspend}
                    <button class='btn-delete'>Delete</button>
                </td>
            </tr>
        ";
        }
    }
}
