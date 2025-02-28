<?php
include('db_connection.php');

// Check if TopicID is set
if(isset($_REQUEST['TopicID'])) {
    $topic_id = $_REQUEST['TopicID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM topics WHERE TopicID=?");
    $stmt->bind_param("i", $topic_id);
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
        <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
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
    echo "Topic ID is not set.";
}

$connection->close();
?>
