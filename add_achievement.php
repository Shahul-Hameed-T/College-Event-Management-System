<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Add Achievement</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
</head>
<body>
    <?php require 'utils/header.php'; ?>
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <form method="POST" enctype="multipart/form-data">
                    <label>SSNID:</label><br>
                    <input type="text" name="ssnid" class="form-control" required><br><br>

                    <label>Event Name:</label><br>
                    <input type="text" name="event_name" class="form-control" required><br><br>

                    <label>Name:</label><br>
                    <input type="text" name="name" class="form-control" required><br><br>

                    <label>Department:</label><br>
                    <input type="text" name="dept" class="form-control" required><br><br>

                    <label>Description:</label><br>
                    <textarea name="description" class="form-control" rows="4" required></textarea><br><br>

                    <label>Certificate:</label><br>
                    <input type="file" name="certificate" class="form-control-file" required><br><br>

                    <button type="submit" name="submit">Submit</button><br><br>
                </form>
            </div>
        </div>
    </div>
    <?php require 'utils/footer.php'; ?>
</body>
</html>

<?php
if (isset($_POST["submit"])) {
    $ssnid = $_POST["ssnid"];
    $event_name = $_POST["event_name"];
    $name = $_POST["name"];
    $dept = $_POST["dept"];
    $description = $_POST["description"];
    $certificate_path = '';

    // File upload
    if ($_FILES["certificate"]["size"] > 0) {
        $target_dir = "certificates/";
        $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is a valid image or PDF
        if ($imageFileType != "pdf" && !in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & PDF files are allowed.');</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["certificate"]["size"] > 500000) {
            echo "<script>alert('Sorry, your file is too large.');</script>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Move uploaded file
            if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {
                $certificate_path = $target_file;
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    }

    if ($certificate_path !== '') {
        include 'classes/db1.php';
        $INSERT = "INSERT INTO achievement(usn, event_name, name, dept, description, certificate_path) VALUES ('$ssnid', '$event_name', '$name', '$dept', '$description', '$certificate_path')";

        if ($conn->query($INSERT) === true) {
            echo "<script>alert('Achievement added successfully!'); window.location.href='usn.php';</script>";
        } else {
            echo "<script>alert('Failed to add achievement.'); window.location.href='add_achievement.php';</script>";
        }
        $conn->close();
    }
}
?>
