<?php
include_once 'classes/db1.php';

// Initialize the achievement result variable
$achievement_result = null;

// Check if the search form is submitted
if(isset($_GET['ssnid'])) {
    $ssnid = $_GET['ssnid'];
    // Query achievements for the provided SSNID
    $achievement_result = mysqli_query($conn, "SELECT * FROM achievement WHERE usn = '$ssnid'");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>

    <style>
        #ssnidser{
            padding-left:10px;
            padding-right:10px;
            padding-top: 2px;
            padding-top: 2px;
            border-radius: 3px;
            margin-bottom: 1%;
        }

        #ssnidser:hover{
            background-color:#D3D3D3;
        }

        </style>
</head>

<body>
    <?php include 'utils/header.php' ?>
    <?php require 'utils/styles.php'; ?>

    <div class="content">
        <div class="container">
            <h1>Achievements</h1>
            <!-- Search Box -->
            <form method="GET">
                <label>Enter SSNID:</label>
                <input style="margin:1%; width:20%;"type="text" name="ssnid" class="form-control" placeholder="Enter SSNID" required>
                <button type="submit"  id = "ssnidser">Search</button>
            </form>

            <?php 
            // Display achievements only if the search result is available
            if ($achievement_result !== null && mysqli_num_rows($achievement_result) > 0) { ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SSNID</th>
                            <th>Event Name</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Description</th>
                            <th>Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($achievement_result)) {
                            echo '<tr>';
                            echo '<td>' . $row['usn'] . '</td>';
                            echo '<td>' . $row['event_name'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['dept'] . '</td>';
                            echo '<td>' . $row['description'] . '</td>';
                            echo '<td><a href="' . $row['certificate_path'] . '" target="_blank">View Certificate</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else if ($achievement_result !== null && mysqli_num_rows($achievement_result) == 0) {
                // If no achievements found for the provided SSNID
                echo "<p>No achievements found for the provided SSNID.</p>";
            } ?>
            <a class="btn btn-default" style="margin:1%;" href="add_achievement.php">Add Achievement</a>
        </div>
    </div>

    <?php require 'utils/footer.php'; ?>
</body>

</html>
