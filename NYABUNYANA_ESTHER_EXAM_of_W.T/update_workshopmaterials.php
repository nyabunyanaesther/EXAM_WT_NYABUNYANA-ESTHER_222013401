<?php
include('db_connection.php');

// Check if WorkshopMaterialID is set
if (isset($_REQUEST['WorkshopMaterialID'])) {
    $material_id = $_REQUEST['WorkshopMaterialID'];

    // Prepare statement with parameterized query to prevent SQL injection (security improvement)
    $stmt = $connection->prepare("SELECT * FROM workshopmaterials WHERE WorkshopMaterialID=?");
    $stmt->bind_param("i", $material_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $workshop_id = $row['WorkshopID'];
        $material_name = $row['MaterialName'];
        $material_description = $row['MaterialDescription'];
        $material_link = $row['MaterialLink'];
    } else {
        echo "Workshop material not found.";
    }

    $stmt->close(); // Close the statement after use
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop Material Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update workshop material information form -->
    <h2><u>Update Workshop Material Information</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
        <br><br>

        <label for="material_name">Material Name:</label>
        <input type="text" name="material_name" value="<?php echo isset($material_name) ? htmlspecialchars($material_name) : ''; ?>">
        <br><br>

        <label for="material_description">Material Description:</label>
        <textarea name="material_description"><?php echo isset($material_description) ? htmlspecialchars($material_description) : ''; ?></textarea>
        <br><br>

        <label for="material_link">Material Link:</label>
        <input type="url" name="material_link" value="<?php echo isset($material_link) ? htmlspecialchars($material_link) : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $material_name = $_POST['material_name'];
    $material_description = $_POST['material_description'];
    $material_link = $_POST['material_link'];

    // Update the workshop material in the database (prepared statement again for security)
    $stmt = $connection->prepare("UPDATE workshopmaterials SET WorkshopID=?, MaterialName=?, MaterialDescription=?, MaterialLink=? WHERE WorkshopMaterialID=?");
    $stmt->bind_param("isssi", $workshop_id, $material_name, $material_description, $material_link, $material_id);
    $stmt->execute();

    // Redirect to appropriate page after update
    header('Location: workshopmaterials.php');
    exit(); // Ensure no other content is sent after redirection
}

// Close the connection (important to close after use)
mysqli_close($connection);
?>
