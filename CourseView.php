
<?php 
    if(isset($_POST['View']) || isset($_POST["StudentView"]) || isset($_POST["adminView"])){
        $ContentType = $_POST["courseType"];
        $Course_id = $_GET["CourseID"];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Title - Youdemy</title>
    <link rel="stylesheet" href="style/CourseView.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Youdemy</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>

    <main>

    <?php if($ContentType === "video") :?>
        <?php require "classes/CourseVideo.php"; 
            $TheVideo = new courseVideo;
            $TheVideo->ShowCourse($Course_id);
        ?>
    <?php else: ?>
        <?php require "classes/CourseDocument.php";
        $TheDocument = new coursedocument;
        $TheDocument->ShowCourse($Course_id);
        ?>
    <?php endif ?>
    </main>

    <footer>
        <p>&copy; 2025 Youdemy. All rights reserved.</p>
    </footer>
</body>

</html>