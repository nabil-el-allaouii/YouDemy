<?php
require "classes/teacher.php";

if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Teacher Dashboard</title>
    <link rel="stylesheet" href="style/TeacherDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Youdemy Teacher Dashboard</h1>
        </div>
        <nav class="Teacher_home">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
        <div class="profile-section">
            <div class="profile-info">
                <span class="user-name">Teacher Name</span>
                <span class="user-role">Teacher</span>
            </div>
            <div class="profile-pic">
                <img src="https://i.pinimg.com/736x/1c/38/a1/1c38a14647cb4df35925e55dafcf7ca4.jpg" alt="Profile Picture">
            </div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#overview">Overview</a></li>
                    <li><a href="#add-course">Add Course</a></li>
                    <li><a href="#my-courses">My Courses</a></li>
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
                        <p>12</p>
                    </div>
                    <div class="card">
                        <h3>Total Students</h3>
                        <p>150</p>
                    </div>
                    <div class="card">
                        <h3>Active Courses</h3>
                        <p>8</p>
                    </div>
                </div>
            </section>

            <section id="add-course" class="content-section">
                <h2>Add New Course</h2>
                <div class="course-form-container">
                    <form class="course-form" action="actions/AddCourse.php" method="post">
                        <div class="form-group">
                            <label>Course Title</label>
                            <input id="Title" name="title" type="text" placeholder="Enter course title" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="courseDesc" name="description" placeholder="Enter course description" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" required>
                                <option value="">Select Category</option>
                                <?php
                                $newCategories = new teacher("", "", "");
                                $newCategories->showCategories();
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Course Type</label>
                            <select name="type" id="courseType" required>
                                <option value="">Select Type</option>
                                <option value="video">Video Course</option>
                                <option value="document">Document Course</option>
                            </select>
                        </div>

                        <div id="contentContainer" class="form-group" style="display: none;">

                        </div>

                        <div class="form-group">
                            <label>Tags</label>
                            <div class="tags-checkbox-group">
                                <?php
                                $newTags = new teacher("", "", "");
                                $newTags->showTags();
                                ?>
                            </div>
                        </div>
                        <p id="errorMsg" style="color: red; display: none;">Please select at least one tag.</p>

                        <button type="submit" class="btn-submit" name="Add-course">Create Course</button>
                    </form>
                </div>
            </section>


            <section id="my-courses" class="content-section">
                <h2>My Courses</h2>
                <div class="courses-container">
                    <table class="courses-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Course Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $Mycourse = new teacher("", "", "");
                            $Mycourse->TeacherCourses($_SESSION["userId"])  ?>
                        </tbody>
                    </table>
                </div>
            </section>


            <section id="statistics" class="content-section">
                <h2>Statistics</h2>
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <?php $statistics = $Mycourse->Statistics($_SESSION["userId"]);
                            extract($statistics);
                            ?>
                            <h3>Nombre d'étudiants inscrits</h3>
                            <p class="stat-value"><?php echo $Users_enrolled ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Nombre de cours</h3>
                            <p class="stat-value"><?php echo $TotalCourses ?></p>
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
        const courseDesc = document.getElementById('courseDesc');
        courseDesc.addEventListener('input', function(e) {
            let count = e.target.value.length;

            if (count >= 255) {
                e.target.value = e.target.value.slice(0, 255); 
            }
        });

        const CourseTItle = document.getElementById("Title");
        CourseTItle.addEventListener('input', e=>{
            let count = e.target.value.length;
            const lastChar = e.target.value[e.target.value.length - 1];
            if(count >= 100){
                e.target.value=e.target.value.slice(0, 100);
            }else if(!/^[a-zA-Z-_ ]*$/.test(lastChar)){
                e.target.value = e.target.value.slice(0, -1);
            }
        })



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
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const courseType = document.getElementById('courseType');
            const contentContainer = document.getElementById('contentContainer');

            courseType.addEventListener('change', function() {
                contentContainer.style.display = 'block';

                switch (this.value) {
                    case 'video':
                        contentContainer.innerHTML = `
                    <label>Video Url</label>
                    <div class="video-input">
                        <input name='video' type="url" required>
                    </div>
                `;
                        break;
                    case 'document':
                        contentContainer.innerHTML = `
                    <label>Course Content</label>
                    <div class="document-input">
                        <textarea name='document' placeholder="Enter your course content here..." required></textarea>
                    </div>
                `;
                        break;
                    default:
                        contentContainer.style.display = 'none';
                        contentContainer.innerHTML = '';
                }
            });
        });


        const form = document.querySelector('.course-form');
        const checkboxes = document.querySelectorAll('input[name="tags[]"]');
        const errorMsg = document.getElementById('errorMsg');
        form.addEventListener('submit', (e) => {
            const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

            if (!isChecked) {
                e.preventDefault();
                errorMsg.style.display = 'block';
            } else {
                errorMsg.style.display = 'none';
            }
        });
    </script>
</body>

</html>