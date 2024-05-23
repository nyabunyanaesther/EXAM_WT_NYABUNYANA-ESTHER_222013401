<?php
include('db_connection.php');

// Check if CommentID is set
if(isset($_REQUEST['CommentID'])) {
    $comment_id = $_REQUEST['CommentID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM resourcecomments WHERE CommentID=?");
    $stmt->bind_param("i", $comment_id);
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
        <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
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
    echo "Comment ID is not set.";
}

$connection->close();
?>
