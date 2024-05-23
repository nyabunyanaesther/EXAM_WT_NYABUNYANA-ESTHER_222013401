<?php
include('db_connection.php');

// Check if FeedbackID is set
if(isset($_REQUEST['FeedbackID'])) {
    $feedback_id = $_REQUEST['FeedbackID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM attendeefeedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $feedback_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Feedback ID is not set.";
}

$connection->close();
?>
