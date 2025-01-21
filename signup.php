<html lang="en">

<?php
require_once "classes/users.php";

if (isset($_POST["Signup"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_role = $_POST["role"];
    $error = "";
    if(!empty($username) && !empty($email) && !empty($password) && !empty($user_role)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[@$!%*?&#]/', $password)){
                $error = "Password must contain at least 8 characters and at least one digit and at least one symbol";
            }else{
                $enc_password = password_hash($password , PASSWORD_DEFAULT);

                $newUser = new users($username,$email,$enc_password,$user_role);
                $newUser->Signup();
                header("location: login.php");
                exit();
            }
        }
    }

}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>sign-up</title>
</head>

<body class="signUp_body">
    <main>
        <div class="signup-container">
            <div class="signup-box">
                <h2>Sign Up</h2>
                <form id="signupForm" action="signup.php" method="post">
                    <div class="input-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="role">Account Type:</label>
                        <select id="role" name="role" required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <p style="color: red;"><?php print (!empty($error)) ? $error : "" ; ?></p>
                        <button type="submit" name="Signup" class="signup-button">Sign Up</button>
                    </div>
                </form>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </main>

</body>
<script> 
    const form = document.getElementById("signupForm");

    form.addEventListener("submit" , e=>{
        let email = document.getElementById("email").value.trim();
        let username = document.getElementById("username").value.trim();;
        let password = document.getElementById("password").value.trim();;
        if(!email || !username || !password){
            e.preventDefault();
        }
    })

</script>

</html>