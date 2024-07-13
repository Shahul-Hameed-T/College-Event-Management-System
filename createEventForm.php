<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>cems</title>
        <title></title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/adminHeader.php'; ?>
  <form method="POST">
  
  <div class="w3-container"> 
  
  <div class ="content"><!--body content holder-->
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
                <label>Event ID:</label><br>
    <input type="number" name="event_id" required class="form-control"><br><br>
    
    <label>Event Name:</label><br>
    <input type="text" name="event_title" required class="form-control"><br><br>

    <label>Event Price:</label><br>
    <input type="number" name="event_price" required class="form-control"><br><br>

    <label>Upload Path to Image:</label><br>
    <input type="text" name="img_link" required class="form-control"><br><br>

    <label>Type_ID </label><br>
    <input type="number" name="type_id" required class="form-control"><br><br>

    <label>Event Date</label><br>
    <input type="date" name="Date" required class="form-control"><br><br>

     <label>Event Time</label><br>
    <input type="text" name="time" required class="form-control"><br><br>

    <label>Event Location</label><br>
    <input type="text" name="location" required class="form-control"><br><br>

    <label>Staff co-ordinator name</label><br>
    <input type="text" name="sname" required class="form-control"><br><br>
    
    <label>Staff co-ordinator Phone</label><br>
    <input type="text" name="sphone" required class="form-control"><br><br>
    
    <label>Student co-ordinator name</label><br>
    <input type="text" name="st_name" required class="form-control"><br><br>
    
    <label>Staff co-ordinator phone</label><br>
    <input type="text" name="stphone" required class="form-control"><br><br>

    <button type="submit" name="update" class = "btn btn-default pull-right">Create Event <span class="glyphicon glyphicon-send"></span></button>

    <a class="btn btn-default navbar-btn" href = "adminPage.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>

  
  </div></div></div>
  </form>
    

    
    </body>

  <?php require 'utils/footer.php'; ?>
</html>

<?php
if (isset($_POST["update"])) {
    $event_id = $_POST["event_id"];
    $event_title = $_POST["event_title"];
    $event_price = $_POST["event_price"];
    $st_phone = $_POST["stphone"];
    $s_phone = $_POST["sphone"];
    $img_link = $_POST["img_link"];
    $type_id = $_POST["type_id"];
    $name = $_POST["sname"];
    $st_name = $_POST["st_name"];
    $Date = $_POST["Date"];
    $time = $_POST["time"];
    $location = $_POST["location"];

    // Function to validate phone number
    function validatePhoneNumber($phone)
    {
        // Remove all characters except digits
        $phone = preg_replace('/\D/', '', $phone);
        // Check if the phone number is exactly 10 digits
        return (strlen($phone) === 10);
    }

    if (
        !empty($event_id) && !empty($event_title) && !empty($event_price) &&
        !empty($st_phone) && !empty($s_phone) && !empty($img_link) &&
        !empty($type_id) && !empty($name) && !empty($st_name) &&
        !empty($Date) && !empty($time) && !empty($location)
    ) {
        if (validatePhoneNumber($st_phone) && validatePhoneNumber($s_phone)) {
            include 'classes/db1.php';

            $INSERT = "INSERT INTO events(event_id,event_title,event_price,img_link,type_id) VALUES($event_id,'$event_title', $event_price,'$img_link',$type_id);";

            $INSERT .= "INSERT INTO event_info (event_id,Date,time,location) Values ($event_id,'$Date','$time','$location');";
            $INSERT .= "INSERT into student_coordinator(sid,st_name,phone,event_id)  values($event_id,'$st_name',$st_phone,$event_id);";
            $INSERT .= "INSERT into staff_coordinator(stid,name,phone,event_id)  values($event_id,'$name',$s_phone,$event_id)";

            if ($conn->multi_query($INSERT) === true) {
                echo "<script>
                alert('Event Inserted Successfully!');
                window.location.href='adminPage.php';
                </script>";
            } else {
                echo "<script>
                alert('Event already exists!');
                window.location.href='createEventForm.php';
                </script>";
            }

            $conn->close();
        } else {
            echo "<script>
            alert('Phone numbers must be exactly 10 digits!');
            window.location.href='createEventForm.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('All fields are required');
        window.location.href='createEventForm.php';
        </script>";
    }
}
?>
