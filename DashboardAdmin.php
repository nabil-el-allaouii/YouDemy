<?php
require "classes/admin.php";
if (!isset($_SESSION["Admin_user"])) {
    header("location: login.php");
}

$counter = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Dashboard</title>
    <link rel="stylesheet" href="style/adminDashboard.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Youdemy Admin Dashboard</h1>
        </div>
        <nav class="Admin_home">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
        <div class="profile-section">
            <div class="profile-info">
                <span class="user-name">John Doe</span>
                <span class="user-role">Administrator</span>
            </div>
            <div class="profile-pic">
                <img src="https://i.pinimg.com/736x/c5/d2/e0/c5d2e0b8ec09b912c11b6a32ed565acf.jpg" alt="Profile Picture">
            </div>
        </div>
    </header>
    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#overview">Overview</a></li>
                    <li><a href="#students">Students</a></li>
                    <li><a href="#teachers">Teachers</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#categories">Categories</a></li>
                    <li><a href="#tags">Tags</a></li>
                    <li><a href="#statistics">Statistics</a></li>
                    <li><a href="actions/logout.php" class="btn-logout">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <section id="overview" class="content-section active">
                <h2>Overview</h2>
                <div class="cards">
                    <div class="card">
                        <h3>Total Courses</h3>
                        <p>150</p>
                    </div>
                    <div class="card">
                        <h3>Active Students</h3>
                        <p>3000</p>
                    </div>
                    <div class="card">
                        <h3>Active Teachers</h3>
                        <p>100</p>
                    </div>
                    <div class="card">
                        <h3>New Registrations</h3>
                        <p>50</p>
                    </div>
                </div>
            </section>

            <section id="students" class="content-section">
                <h2>Students Management</h2>

                <div class="table-container">
                    <table class="students-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $newUsers = new Admin("", "", "");
                            $newUsers->ShowStudents();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="teachers" class="content-section">
                <h2>Teachers Management</h2>

                <div class="table-container">
                    <table class="teachers-table">
                        <thead>
                            <tr>
                                <th>Teacher Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $newTeachers = new Admin("", "", "");
                            $newTeachers->showTeachers();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="courses" class="content-section">
                <h2>Courses Management</h2>
                <div class="courses-container">
                    <table class="courses-table">
                        <thead>
                            <tr>
                                <th>Course Title</th>
                                <th>Instructor</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $newTeachers->ShowAllcourses() ?>

                        </tbody>
                    </table>
                </div>
            </section>

            <section id="categories" class="content-section">
                <h2>Categories Management</h2>

                <div class="categories-container">
                    <div class="category-form">
                        <form action="actions/AddCategory.php" method="post">
                            <input type="text" placeholder="Enter new category name" class="category-input" name="category" required>
                            <button class="btn-add-category" type="submit" name="Add-category">Add Category</button>
                        </form>
                    </div>

                    <div class="categories-list">
                        <table class="categories-table">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $newTeachers->ShowCategories() ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section id="tags" class="content-section">
                <h2>Tags Management</h2>

                <div class="tags-container">
                    <form action="actions/addTag.php" method="post">
                        <div class="tags-form">
                            <p class="Error_text" style="color: red;display:none">Invalid Type of characters Detected!</p>
                            <textarea
                                class="tags-input"
                                placeholder="Enter tags (separate with commas)&#10;Example: JavaScript, PHP, HTML, CSS"
                                rows="4" name="tags"></textarea>
                            <button type="submit" class="btn-add-tags" name="Add-tag">Add Tags</button>
                        </div>
                    </form>


                    <div class="tags-list">
                        <table class="tags-table">
                            <thead>
                                <tr>
                                    <th>Tag Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $newTeachers->Showtags() ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section id="statistics" class="content-section">
                <h2>Statistiques</h2>
                <div class="stats-container">
                    <div class="stats-row">
                        <div class="stats-card total-courses">
                            <?php $statistics = $newTeachers->Statistics();
                                if($statistics){
                                    extract($statistics);
                                }else{
                                    die();
                                }
                                 ?>
                            <h3>Nombre total de cours</h3>
                            <div class="stats-number"><?php echo $totalCourses ?></div>
                            <div class="stats-trend positive">
                                <span>+12%</span> ce mois
                            </div>
                        </div>

                        <div class="stats-card category-dist">
                            <h3>Répartition par catégorie</h3>
                            <div class="category-list">
                                <?php foreach($CoursesPerCategory as $category) :?>
                                    <div class="category-item">
                                    <div class="category-name"><?php echo $category["category_content"] ?></div>
                                    <div class="category-count"><?php echo $category["courses"] ?></div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>

                    <div class="stats-row">
                        <div class="stats-card popular-course">
                            <h3>Cours le plus populaire</h3>
                            <div class="course-info">
                                <img src="https://i.pinimg.com/736x/67/68/78/6768780c1f093ab756b9d0fde0bfc690.jpg" alt="Course thumbnail">
                                <div class="course-details">
                                    <h4><?php echo $TopCourse["course_title"] ?></h4>
                                    <p><?php echo $TopCourse["totalEnroll"] ?></p>
                                    <span class="instructor">by <?php echo $TopCourse["user_name"] ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="stats-card top-teachers">
                            <h3>Top 3 Enseignants</h3>
                            <div class="teachers-list">
                                <?php foreach($TopTeachers as $topTeacher) :?>
                                    <div class="teacher-item">
                                    <div class="rank"><?php echo $counter;$counter++; ?></div>
                                    <img src="path/to/teacher1.jpg" alt="Teacher 1">
                                    <div class="teacher-info">
                                        <h4><?php echo $topTeacher["user_name"] ?></h4>
                                        <p><?php echo $topTeacher["total"] ?></p>
                                    </div>
                                </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2025 Youdemy. All rights reserved.</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');

            const contentSections = document.querySelectorAll('.content-section');

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {

                    contentSections.forEach(section => {
                        section.classList.remove('active');
                    });

                    sidebarLinks.forEach(link => {
                        link.classList.remove('active');
                    });

                    this.classList.add('active');

                    const targetId = this.getAttribute('href').substring(1);
                    document.getElementById(targetId).classList.add('active');
                    3
                });
            });
        });

        let textArea = document.querySelector(".tags-input");
        let error = document.querySelector(".Error_text");

        textArea.addEventListener("input", e => {
            let text = e.target.value;
            const lastChar = text[text.length - 1]
            if (!/[a-zA-Z,]/.test(lastChar)) {
                e.target.value = text.slice(0, -1);
                error.style.display = "block";
            } else {
                error.style.display = "none";
            }
        })
    </script>
</body>

</html>