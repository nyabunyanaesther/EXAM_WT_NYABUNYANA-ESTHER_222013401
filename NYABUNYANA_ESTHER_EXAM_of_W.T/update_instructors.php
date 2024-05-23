<?php
include('db_connection.php');

// Check if InstructorID is set
if (isset($_REQUEST['InstructorID'])) {
    $instructor_id = $_REQUEST['InstructorID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $instructor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['UserID'];
        $bio = $row['Bio'];
        $expertise_area = $row['ExpertiseArea'];
    } else {
        echo "Instructor not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Instructor Information</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update instructor information form -->
    <h2><u>Update Instructor Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
        <br><br>

        <label for="bio">Bio:</label>
        <textarea name="bio"><?php echo isset($bio) ? $bio : ''; ?></textarea>
        <br><br>

        <label for="expertise_area">Expertise Area:</label>
        <input type="text" name="expertise_area" value="<?php echo isset($expertise_area) ? $expertise_area : ''; ?>">
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
    $bio = $_POST['bio'];
    $expertise_area = $_POST['expertise_area'];

    // Update the instructor in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE instructors SET UserID=?, Bio=?, ExpertiseArea=? WHERE InstructorID=?");
    $stmt->bind_param("issi", $user_id, $bio, $expertise_area, $instructor_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: instructors.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
