<?php
include('db_connection.php');

// Check if AttendeeID is set
if (isset($_REQUEST['AttendeeID'])) {
    $attendee_id = $_REQUEST['AttendeeID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE AttendeeID=?");
    $stmt->bind_param("i", $attendee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['UserID'];
        $workshop_id = $row['WorkshopID'];
        $registration_date = $row['RegistrationDate'];
        $status = $row['Status'];
    } else {
        echo "Attendee not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendee Information</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update attendee information form -->
    <h2><u>Update Attendee Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
        <br><br>

        <label for="registration_date">Registration Date:</label>
        <input type="text" name="registration_date" value="<?php echo isset($registration_date) ? $registration_date : ''; ?>">
        <br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($status) ? $status : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $workshop_id = $_POST['workshop_id'];
    $registration_date = $_POST['registration_date'];
    $status = $_POST['status'];

    // Update the attendee in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE attendees SET UserID=?, WorkshopID=?, RegistrationDate=?, Status=? WHERE AttendeeID=?");
    $stmt->bind_param("iissi", $user_id, $workshop_id, $registration_date, $status, $attendee_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: attendees.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
