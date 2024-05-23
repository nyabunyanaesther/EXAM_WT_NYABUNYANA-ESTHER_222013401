<?php
include('db_connection.php');

// Check if WorkshopID is set
if (isset($_REQUEST['WorkshopID'])) {
    $workshop_id = $_REQUEST['WorkshopID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM workshops WHERE WorkshopID=?");
    $stmt->bind_param("i", $workshop_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['Title'];
        $description = $row['Description'];
        $duration = $row['Duration'];
        $instructor_id = $row['InstructorID'];
        $location = $row['Location'];
    } else {
        echo "Workshop not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update workshop information form -->
    <h2><u>Update Workshop Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
        <br><br>

        <label for="description">Description:</label>
        <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
        <br><br>

        <label for="duration">Duration:</label>
        <input type="text" name="duration" value="<?php echo isset($duration) ? $duration : ''; ?>">
        <br><br>

        <label for="instructor_id">Instructor ID:</label>
        <input type="number" name="instructor_id" value="<?php echo isset($instructor_id) ? $instructor_id : ''; ?>">
        <br><br>

        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo isset($location) ? $location : ''; ?>">
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
    $duration = $_POST['duration'];
    $instructor_id = $_POST['instructor_id'];
    $location = $_POST['location'];

    // Update the workshop in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE workshops SET Title=?, Description=?, Duration=?, InstructorID=?, Location=? WHERE WorkshopID=?");
    $stmt->bind_param("sssisi", $title, $description, $duration, $instructor_id, $location, $workshop_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: workshops.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
