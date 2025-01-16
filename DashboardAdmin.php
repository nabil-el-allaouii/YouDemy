<?php

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

        <div class="profile-section">
            <div class="profile-info">
                <span class="user-name">John Doe</span>
                <span class="user-role">Administrator</span>
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
                    <li><a href="#students">Students</a></li>
                    <li><a href="#teachers">Teachers</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#categories">Categories</a></li>
                    <li><a href="#tags">Tags</a></li>
                    <li><a href="#statistics">Statistics</a></li>
                    <li><a href="#logout" class="btn-logout">Logout</a></li>
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
                            <?php require "classes/admin.php";
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
                            <?php $newTeachers = new Admin("","","");
                                $newTeachers->showTeachers();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="courses" class="content-section">
                <h2>Courses</h2>
                Here courses
            </section>

            <section id="categories" class="content-section">
                <h2>Categories</h2>
                Here categories
            </section>

            <section id="tags" class="content-section">
                <h2>Tags</h2>
                Here tags
            </section>

            <section id="statistics" class="content-section">
                <h2>Statistics</h2>
                Here statistics
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
    </script>
</body>

</html>