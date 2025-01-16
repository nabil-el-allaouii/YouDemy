<html lang="en">

<?php
require_once "classes/users.php";

if (isset($_POST["Signup"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_role = $_POST["role"];
    if(!empty($username) && !empty($email) && !empty($password) && !empty($user_role)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $enc_password = password_hash($password , PASSWORD_DEFAULT);

            $newUser = new users($username,$email,$enc_password,$user_role);
            $newUser->Signup();
            header("location: login.php");
            exit();
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
                <form action="signup.php" method="post">
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
                        <button type="submit" name="Signup" class="signup-button">Sign Up</button>
                    </div>
                </form>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </main>

</body>

</html>