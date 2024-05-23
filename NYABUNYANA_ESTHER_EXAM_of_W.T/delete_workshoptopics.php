<?php
include('db_connection.php');

// Check if WorkshopTopicID is set
if(isset($_REQUEST['WorkshopTopicID'])) {
    $workshop_topic_id = $_REQUEST['WorkshopTopicID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM workshoptopics WHERE WorkshopTopicID=?");
    $stmt->bind_param("i", $workshop_topic_id);
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
        <input type="hidden" name="workshop_topic_id" value="<?php echo $workshop_topic_id; ?>">
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
    echo "WorkshopTopic ID is not set.";
}

$connection->close();
?>
