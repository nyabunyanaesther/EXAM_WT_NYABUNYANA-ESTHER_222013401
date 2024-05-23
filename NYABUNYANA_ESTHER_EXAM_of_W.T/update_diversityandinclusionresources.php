<?php
include('db_connection.php');

// Check if ResourceID is set
if (isset($_REQUEST['ResourceID'])) {
    $resource_id = $_REQUEST['ResourceID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM diversityandinclusionresources WHERE ResourceID=?");
    $stmt->bind_param("i", $resource_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['Title'];
        $description = $row['Description'];
        $link = $row['Link'];
        $uploaded_by = $row['UploadedBy'];
        $upload_date = $row['UploadDate'];
    } else {
        echo "Resource not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Resource Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update resource information form -->
    <h2><u>Update Resource Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo isset($title) ? htmlspecialchars($title) : ''; ?>">
        <br><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo isset($description) ? htmlspecialchars($description) : ''; ?></textarea>
        <br><br>

        <label for="link">Link:</label>
        <input type="url" name="link" value="<?php echo isset($link) ? htmlspecialchars($link) : ''; ?>">
        <br><br>

        <label for="uploaded_by">Uploaded By:</label>
        <input type="text" name="uploaded_by" value="<?php echo isset($uploaded_by) ? htmlspecialchars($uploaded_by) : ''; ?>">
        <br><br>

        <label for="upload_date">Upload Date:</label>
        <input type="date" name="upload_date" value="<?php echo isset($upload_date) ? htmlspecialchars($upload_date) : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $uploaded_by = $_POST['uploaded_by'];
    $upload_date = $_POST['upload_date'];

    // Update the resource in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE diversityandinclusionresources SET Title=?, Description=?, Link=?, UploadedBy=?, UploadDate=? WHERE ResourceID=?");
    $stmt->bind_param("sssssi", $title, $description, $link, $uploaded_by, $upload_date, $resource_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: diversityandinclusionresources.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
