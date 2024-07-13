<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>cems</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/header.php'; ?>
    <div class ="content"><!--body content holder-->
        <div class = "container">
            <div class ="col-md-6 col-md-offset-3">
                <form method="POST">

                    <label>Student ID:</label><br>
                    <input type="text" name="usn" class="form-control" required><br><br>

                    
                    <label>Event ID:</label><br>
                    <input type="text" name="eveid" class="form-control" required><br><br>

                    <label>Student Name:</label><br>
                    <input type="text" name="name" class="form-control" required><br><br>

                    <label>Branch:</label><br>
                    <input type="text" name="branch" class="form-control" required><br><br>

                    <label>Semester:</label><br>
                    <input type="text" name="sem" class="form-control" required><br><br>

                    <label>SSN Email:</label><br>
                    <input type="text" name="email"  class="form-control" required ><br><br>

                    <label>Phone:</label><br>
                    <input type="text" name="phone"  class="form-control" required><br><br>

                    <label>College:</label><br>
                    <input type="text" name="college"  class="form-control" required><br><br>

                    <button type="submit" name="update" required>Submit</button><br><br>
                    <a href="usn.php" ><u>Already registered ?</u></a>

                </form>
            </div>
        </div>
    </div>

    <?php require 'utils/footer.php'; ?>
    <?php
require 'vendor/autoload.php'; // Include PHPMailer autoloader

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST["update"])) {
    $usn = $_POST["usn"];
    $eid = $_POST["eveid"];
    $name = $_POST["name"];
    $branch = $_POST["branch"];
    $sem = $_POST["sem"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $college = $_POST["college"];

    // Function to validate email
    function validateEmail($email)
    {
        // Check if the email ends with '@ssn.edu.in'
        return (substr($email, -11) === '@ssn.edu.in');
    }

    if (
        !empty($usn) && !empty($name) && !empty($eid) &&
        !empty($branch) && !empty($sem) && !empty($email) &&
        !empty($phone) && !empty($college)
    ) {
        if (validateEmail($email)) {
            include 'classes/db1.php';

            // Insert participant details into the 'participent' table
            $INSERT = "INSERT INTO participent (usn, name, branch, sem, email, phone, college) VALUES ('$usn', '$name', '$branch', $sem, '$email', '$phone', '$college')";
            if ($conn->query($INSERT) === false) {
                echo "<script>
                alert('Failed to insert participant');
                window.location.href='usn.php';
                </script>";
                exit; // Stop further execution
            }

            // Check if the same USN is already registered for the event
            $check_query = "SELECT * FROM registered WHERE usn='$usn' AND event_id='$eid'";
            $result = $conn->query($check_query);

            if ($result && $result->num_rows > 0) {
                echo "<script>
                    alert('The same USN is already registered for this event.');
                    window.location.href='usn.php';
                    </script>";
                exit; // Stop further execution
            }

            // If not already registered, proceed with registration
            $INSERT = "INSERT INTO registered (usn, event_id) VALUES ('$usn', '$eid')";

            if ($conn->query($INSERT) === true) {
                // Send email to the entered email address
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'shahul2012066@ssn.edu.in'; // SMTP username
                    $mail->Password = 'mkep eelv hsza nzah'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587; // TCP port to connect to

                    //Recipients
                    $mail->setFrom('shahul2012066@ssn.edu.in', 'Shahul');
                    $mail->addAddress($email, $name); // Add a recipient

                    // Content
                    $mail->isHTML(false); // Set email format to HTML
                    $mail->Subject = 'Registration Confirmation';
                    $mail->Body = "Dear $name,\n\nThank you for registering for the event.";

                    $mail->send();

                    echo "<script>
                    alert('Registered Successfully! An email has been sent to $email.');
                    window.location.href='usn.php';
                    </script>";
                } catch (Exception $e) {
                    echo "<script>
                    alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                    window.location.href='usn.php';
                    </script>";
                }
            } else {
                echo "<script>
                alert('Failed to register.');
                window.location.href='usn.php';
                </script>";
            }

            $conn->close();
        } else {
            echo "<script>
            alert('Email must end with @ssn.edu.in');
            window.location.href='eventregister.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('All fields are required');
        window.location.href='eventregister.php';
        </script>";
    }
}
?>

    </body>
</html>
