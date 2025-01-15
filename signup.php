<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>sign-up</title>
</head>

<body>
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
                        <button type="submit" class="signup-button">Sign Up</button> 
                    </div>
                </form>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </main>
</body>

</html>