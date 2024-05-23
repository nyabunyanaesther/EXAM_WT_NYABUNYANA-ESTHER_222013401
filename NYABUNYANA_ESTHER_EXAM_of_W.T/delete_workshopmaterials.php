<?php
include('db_connection.php');

// Check if WorkshopMaterialID is set
if(isset($_REQUEST['WorkshopMaterialID'])) {
    $workshop_material_id = $_REQUEST['WorkshopMaterialID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM workshopmaterials WHERE WorkshopMaterialID=?");
    $stmt->bind_param("i", $workshop_material_id);
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
        <input type="hidden" name="workshop_material_id" value="<?php echo $workshop_material_id; ?>">
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
    echo "WorkshopMaterial ID is not set.";
}

$connection->close();
?>
