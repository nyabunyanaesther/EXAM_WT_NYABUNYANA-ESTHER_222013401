<?php
include('db_connection.php');

// Check if FeedbackID is set
if (isset($_REQUEST['FeedbackID'])) {
    $feedback_id = $_REQUEST['FeedbackID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM attendeefeedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $attendee_id = $row['AttendeeID'];
        $workshop_id = $row['WorkshopID'];
        $rating = $row['Rating'];
        $comments = $row['Comments'];
    } else {
        echo "Feedback not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendee Feedback</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update feedback information form -->
    <h2><u>Update Attendee Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="attendee_id">Attendee ID:</label>
        <input type="number" name="attendee_id" value="<?php echo isset($attendee_id) ? $attendee_id : ''; ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo isset($rating) ? $rating : ''; ?>" min="1" max="5">
        <br><br>

        <label for="comments">Comments:</label>
        <textarea name="comments"><?php echo isset($comments) ? $comments : ''; ?></textarea>
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendee_id = $_POST['attendee_id'];
    $workshop_id = $_POST['workshop_id'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    // Update the feedback in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE attendeefeedback SET AttendeeID=?, WorkshopID=?, Rating=?, Comments=? WHERE FeedbackID=?");
    $stmt->bind_param("iissi", $attendee_id, $workshop_id, $rating, $comments, $feedback_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: attendeefeedback.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
