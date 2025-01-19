<?php
$course_id = $_GET["courseID"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Course - Youdemy</title>
    <link rel="stylesheet" href="style/modifycourse.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Modify Course</h1>
        </div>
        <nav class="Teacher_home">
            <ul>
                <li><a href="TeacherDashboard.php">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="modify-course-container">
            <form class="course-form" action="actions/updateCourse.php" method="post">
                <input type="hidden" name="course_id" value="<?php echo $course_id = $_GET["courseID"]; ?>">
                <div class="form-group">
                    <label>Course Title</label>
                    <?php require "classes/CourseVideo.php";
                    $CourseDetails = new courseVideo;
                    $courses = $CourseDetails->RetrieveOldCourse($course_id);
                    extract($courses);
                    ?>
                    <input type="text" name="title" value="<?php echo $course_info["course_title"] ?>" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required><?= $course_info["course_description"] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category) : ?>
                            <option <?php print ($category["category_content"] === $course_info["Category"]) ? "selected" : ""; ?> value="<?php echo $category["category_content"] ?>"><?php echo $category["category_content"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div class="form-group">
                    <label>Course Type</label>
                    <select name="type" id="courseType" required>
                        <option value="">Select Type</option>
                        <option <?php print($course_info["course_type"] === "video")? "selected": "" ?> value="video">Video Course</option>
                        <option <?php print($course_info["course_type"] === "document")? "selected": "" ?>  value="document">Document Course</option>
                    </select>
                </div>

                <div id="videoContent" class="form-group content-input" style="display: none;">
                    <label>Video URL</label>
                    <div class="video-input">
                        <input type="url" name="video" value="<?php echo $course_info["course_video"] ?>">
                    </div>
                </div>

                <div id="documentContent" class="form-group content-input" style="display: none;">
                    <label>Course Content</label>
                    <div class="document-input">
                        <textarea name="document" placeholder="Enter your course content here..."><?php echo $course_info["course_document"]; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <div class="tags-checkbox-group">
                        <?php foreach ($AllTags as $tags) : ?>
                            <label class="tag-checkbox">
                                <input <?= in_array($tags["tag_content"], array_column($tags_course, "tag_content")) ? "checked" : ""; ?> type="checkbox" name="tags[]" value="<?php echo $tags["tag_id"] ?>">
                                <span><?php echo $tags["tag_content"] ?></span>
                            </label>
                        <?php endforeach ?>
                    </div>
                </div>

                <p id="errorMsg" style="color: red; display: none;">Please select at least one tag.</p>

                <div class="form-actions">
                    <button type="submit" class="btn-save" name="update-course">Save Changes</button>
                    <a href="TeacherDashboard.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseType = document.getElementById('courseType');
            const videoContent = document.getElementById('videoContent');
            const documentContent = document.getElementById('documentContent');

            courseType.addEventListener('change', function() {

                videoContent.style.display = 'none';
                documentContent.style.display = 'none';

                switch (this.value) {
                    case 'video':
                        videoContent.style.display = 'block';
                        break;
                    case 'document':
                        documentContent.style.display = 'block';
                        break;
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