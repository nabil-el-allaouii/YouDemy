<?php 
require "classes/users.php";

$error = "";

if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $newUser = new users("",$email,$password,"");
    $error = $newUser->signin();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>sign-in</title>
</head>

<body>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Youdemy Login</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body class="login_body">
        <section>
            <div class="login-container">
                <div class="login-box">
                    <h2>Login</h2>
                    <form id="loginForm" action="login.php" method="post">
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="login-button" name="login">Login</button>
                        </div>
                    </form>
                    <?php if(!empty($error)) :?>
                        <p style="color: red;"><?php echo htmlspecialchars($error) ?></p>
                    <?php endif ?>
                    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
                </div>
            </div>
        </section>
    </body>

    </html>

</body>

</html>