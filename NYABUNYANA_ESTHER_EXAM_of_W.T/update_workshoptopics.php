<?php
include('db_connection.php');

// Check if WorkshopTopicID is set
if (isset($_REQUEST['WorkshopTopicID'])) {
    $workshop_topic_id = $_REQUEST['WorkshopTopicID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM workshoptopics WHERE WorkshopTopicID=?");
    $stmt->bind_param("i", $workshop_topic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $workshop_id = $row['WorkshopID'];
        $topic_id = $row['TopicID'];
    } else {
        echo "Workshop Topic not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop Topic Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update workshop topic information form -->
    <h2><u>Update Workshop Topic Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
        <br><br>

        <label for="topic_id">Topic ID:</label>
        <input type="number" name="topic_id" value="<?php echo isset($topic_id) ? $topic_id : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $topic_id = $_POST['topic_id'];

    // Update the workshop topic in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE workshoptopics SET WorkshopID=?, TopicID=? WHERE WorkshopTopicID=?");
    $stmt->bind_param("iii", $workshop_id, $topic_id, $workshop_topic_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: workshoptopics.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
