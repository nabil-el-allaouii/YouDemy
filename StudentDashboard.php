<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Youdemy</title>
    <link rel="stylesheet" href="style/StudentDashboard.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Youdemy Student Dashboard</h1>
        </div>
        <nav class="Student_home">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
        <div class="profile-section">
            <div class="profile-info">
                <span class="user-name">Student Name</span>
                <span class="user-role">Student</span>
            </div>
            <div class="profile-pic">
                <img src="#" alt="Profile Picture">
            </div>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#overview">Overview</a></li>
                    <li><a href="#my-courses">My Courses</a></li>
                    <li><a href="#progress">Progress</a></li>
                    <li><a href="actions/logout.php" class="btn-logout">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <main>
            <!-- Overview Section -->
            <section id="overview" class="content-section active">
                <h2>Overview</h2>
                <div class="cards">
                    <div class="card">
                        <h3>Enrolled Courses</h3>
                        <p>5</p>
                    </div>
                    <div class="card">
                        <h3>Completed Courses</h3>
                        <p>3</p>
                    </div>
                    <div class="card">
                        <h3>In Progress</h3>
                        <p>2</p>
                    </div>
                </div>
            </section>

            
            <section id="my-courses" class="content-section">
                <h2>My Enrolled Courses</h2>
                <div class="enrolled-courses">
                    <div class="course-card">
                        <?php require "classes/students.php";
                            $myCourses = new students("","","","");
                            $myCourses->Mycourses($_SESSION["id_student"]);
                        ?>

                    </div>
                </div>
            </section>

            <!-- Progress Section -->
            <section id="progress" class="content-section">
                <h2>My Progress</h2>
                <!-- Add progress content here -->
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');

            
            const contentSections = document.querySelectorAll('.content-section');

            
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    
                    if (!this.classList.contains('btn-logout')) {
                        e.preventDefault();

                        
                        sidebarLinks.forEach(link => {
                            link.classList.remove('active');
                        });

                        this.classList.add('active');

                        contentSections.forEach(section => {
                            section.classList.remove('active');
                        });


                        const targetId = this.getAttribute('href').substring(1);
                        document.getElementById(targetId).classList.add('active');
                    }
                });
            });

            document.querySelector('a[href="#overview"]').classList.add('active');
        });
    </script>
</body>

</html>