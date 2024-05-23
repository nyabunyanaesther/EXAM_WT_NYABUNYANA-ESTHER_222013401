<?php
include('db_connection.php');

// Check if CommentID is set
if (isset($_REQUEST['CommentID'])) {
    $comment_id = $_REQUEST['CommentID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM resourcecomments WHERE CommentID=?");
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resource_id = $row['ResourceID'];
        $user_id = $row['UserID'];
        $comment_text = $row['CommentText'];
        $comment_date = $row['CommentDate'];
    } else {
        echo "Comment not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Comment Information</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update comment information form -->
    <h2><u>Update Comment Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="resource_id">Resource ID:</label>
        <input type="number" name="resource_id" value="<?php echo isset($resource_id) ? $resource_id : ''; ?>">
        <br><br>

        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="comment_text">Comment Text:</label>
        <textarea name="comment_text"><?php echo isset($comment_text) ? $comment_text : ''; ?></textarea>
        <br><br>

        <label for="comment_date">Comment Date:</label>
        <input type="text" name="comment_date" value="<?php echo isset($comment_date) ? $comment_date : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $resource_id = $_POST['resource_id'];
    $user_id = $_POST['user_id'];
    $comment_text = $_POST['comment_text'];
    $comment_date = $_POST['comment_date'];

    // Update the comment in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE resourcecomments SET ResourceID=?, UserID=?, CommentText=?, CommentDate=? WHERE CommentID=?");
    $stmt->bind_param("iissi", $resource_id, $user_id, $comment_text, $comment_date, $comment_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: resourcecomments.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
