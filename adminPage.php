<?php
include_once 'classes/db1.php';

// Initialize the $result variable
$result = null;

// Check if the month is provided in the URL
if(isset($_GET['month'])) {
    $month = $_GET['month'];
    // Query events for the provided month
    $query = "SELECT * FROM staff_coordinator s, event_info ef, student_coordinator st, events e 
        WHERE e.event_id = ef.event_id AND e.event_id = s.event_id AND e.event_id = st.event_id 
        AND MONTH(ef.date) = '$month'";
    $result = mysqli_query($conn, $query);

    // Check for errors in the query
    if(!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>
</head>

<body>
    <?php include 'utils/adminHeader.php' ?>
 
    <div class="content">
        <div class="container">
            <h1>Event details</h1>
            <!-- Search form for filtering events by month -->
            <form method="GET">
                <label>Select Month:</label>
                <select name="month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <button type="submit">Search</button>
            </form>

            <?php
            if ($result !== null) {
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>No. of Participants</th>
                                <th>Price</th>
                                <th>Student Coordinator</th>
                                <th>Staff Coordinator</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['event_title'] . '</td>';
                                echo '<td>' . $row['participents'] . '</td>';
                                echo '<td>' . $row['event_price'] . '</td>';
                                echo '<td>' . $row['st_name'] . '</td>';
                                echo '<td>' . $row['name'] . '</td>';
                                echo '<td>' . $row['date'] . '</td>';
                                echo '<td>' . $row['time'] . '</td>';
                                echo '<td>' . $row['location'] . '</td>';
                                echo '<td>'
                                    . '<a class="delete" href="deleteEvent.php?id=' . $row['event_id'] . '">Delete</a> '
                                    . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "<p>No events found in this month.</p>";
                }
            }
            ?>
            <a class="btn btn-default" href="createEventForm.php">Create Event</a><!--register button-->
        </div>
    </div>
        
    <?php require 'utils/footer.php'; ?>
</body>
</html>
