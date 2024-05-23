<?php
include('db_connection.php');

// Check if TopicID is set
if (isset($_REQUEST['TopicID'])) {
    $topic_id = $_REQUEST['TopicID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM topics WHERE TopicID=?");
    $stmt->bind_param("i", $topic_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $topic_name = $row['TopicName'];
    } else {
        echo "Topic not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Topic Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update topic information form -->
    <h2><u>Update Topic Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="topic_name">Topic Name:</label>
        <input type="text" name="topic_name" value="<?php echo isset($topic_name) ? htmlspecialchars($topic_name) : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $topic_name = $_POST['topic_name'];

    // Update the topic in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE topics SET TopicName=? WHERE TopicID=?");
    $stmt->bind_param("si", $topic_name, $topic_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: topics.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
