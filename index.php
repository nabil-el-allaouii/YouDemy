<?php
require "classes/users.php";

$newPag = new users("", "", "", "");
$courses = $newPag->Pagination();
extract($courses);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Youdemy</title>
        <link rel="stylesheet" href="style/style.css">
    </head>

    <body>
        <header>
            <div class="logo">
                <h1>Youdemy</h1>
            </div>
            <div class="search-container">
                <form method="post">
                    <input type="text" name="search" placeholder="Search for courses..." class="search-input">
                    <button type="submit" class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if (isset($_SESSION["username"])) {
                        echo "<li><a href='TeacherDashboard.php' class='btn-login'>Dashboard</a></li>";
                    } else if (isset($_SESSION["Admin_user"])) {
                        echo "<li><a href='DashboardAdmin.php' class='btn-login'>Dashboard</a></li>";
                    } else if (isset($_SESSION["user_student"])) {
                        echo "<li><a href='StudentDashboard.php' class='btn-login'>Dashboard</a></li>";
                    } else {
                        echo "<li><a href='login.php' class='btn-login'>Login</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </header>

        <main>
            <section class="courses">
                <h2>Available Courses</h2>
                <div class="course-grid">
                    <?php foreach ($course_info as $course) : ?>
                        <div class="course-card"> <img src="https://i.pinimg.com/736x/67/68/78/6768780c1f093ab756b9d0fde0bfc690.jpg" alt="Course Image">
                            <div class="course-info">
                                <a href="#">
                                    <h3><?php echo $course["course_title"] ?></h3>
                                </a>
                                <p><?php echo $course["course_description"] ?></p>
                                <?php if (isset($_SESSION["user_student"])) : ?>
                                    <a href="actions/Enroll.php?CourseID=<?php echo $course['course_id'] ?>"><button class="enroll-button">Enroll Now</button></a>
                                <?php endif ?>

                            </div>
                        </div>
                    <?php endforeach ?>



                </div>
                <div class="pagination">
                    <a href="index.php?page=<?php print (isset($_GET["page"]) && $_GET["page"] > 1) ? $_GET["page"] - 1 : $_GET["page"] = 1 ?>"><button class="page-btn">&laquo;</button></a>
                    <?php for ($i = 1; $i <= $number_of_pages; $i++) : ?>
                        <a href="index.php?page=<?php echo $i ?>"><button class="page-btn"><?php echo $i ?></button></a>
                    <?php endfor ?>
                    <a href="index.php?page=<?php $currentPage = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
                                            $nextPage = ($currentPage < $number_of_pages) ? $currentPage + 1 : $number_of_pages;
                                            echo $nextPage ?>"><button class="page-btn">&raquo;</button></a>
                </div>
            </section>
        </main>


        <footer>
            <div class="footer-content">
                <div class="footer-section about">
                    <h3>About Youdemy</h3>
                    <p>Youdemy is a web-based learning platform designed to help students, teachers, and administrators enhance their educational experience.</p>
                </div>
                <div class="footer-section links">
                    <h3>Useful Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#courses">Courses</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section contact">
                    <h3>Contact Us</h3>
                    <p>Email: support@youdemy.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Youdemy. All rights reserved.</p>
            </div>
        </footer>

    </body>

    </html>