<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>workshops Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="darkgray">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/logoimage.jpeg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendeefeedback.php">Attendeefeedback</a>
  </li>
    <li style="display: inline; margin-right: 10px;" ><a href="./attendees.php">Attendees</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./diversityandinclusionresources.php">Diversityandinclusionresources</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">Instructors</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./resourcecomments.php">Resourcecomments</a>
  </li>  <li style="display: inline; margin-right: 10px;"><a href="./topics.php">Topics</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./workshopmaterials.php">Workshopmaterials</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">Workshops</a>
  </li>
<li style="display: inline; margin-right: 10px;"><a href="./workshoptopics.php">workshoptopics</a>
  </li>
   
   
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
    <h1><u>Workshops Form</u></h1>

<form method="post" onsubmit="return confirmInsert();">

    <label for="WorkshopID">WorkshopID:</label>
    <input type="number" id="book_id" name="book_id" required><br><br>

    <label for="Title">Title:</label>
    <input type="text" id="ride_id" name="ride_id" required><br><br>

    <label for="Description">MaterialName:</label>
    <input type="text" id="passenger_id" name="passenger_id" required><br><br>

    <label for="Duration">Duration:</label>
    <input type="time" id="booking_time" name="booking_time" required><br><br>

    <label for="InstructorID">InstructorID:</label>
    <input type="number" id="bookingtime" name="bookingtime" required><br><br>

    <label for="Location">Location:</label>
    <input type="text" id="bookintime" name="bookintime" required><br><br>

    </select><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO workshops(WorkshopID, Title, Description,Duration,InstructorID,Location) VALUES (?, ?, ?, ?,?,?)");
    $stmt->bind_param("ssssss", $WorkshopID, $Title, $Description, $Duration,$InstructorID,$Location);
    // Set parameters and execute
    $WorkshopID = $_POST['book_id'];
    $Title = $_POST['ride_id'];
    $Description = $_POST['passenger_id'];
    $Duration = $_POST['booking_time'];
    $InstructorID = $_POST['bookingtime'];
    $Location = $_POST['bookintime'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshops Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>workshops Table</h2></center>
    <table border="3">
        <tr>
            <th>WorkshopID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Duration</th>
             <th>InstructorID</th>
             <th>Location</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all workshops
$sql = "SELECT * FROM workshops";
$result = $connection->query($sql);

// Check if there are any workshopmaterials
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $WorkshopID = $row['WorkshopID']; // Fetch the WorkshopID
        echo "<tr>
            <td>" . $row['WorkshopID'] . "</td>
            <td>" . $row['Title'] . "</td>
            <td>" . $row['Description'] . "</td>
            <td>" . $row['Duration'] . "</td>
            <td>" . $row['InstructorID'] . "</td>
            <td>" . $row['Location'] . "</td>
            <td><a style='padding:4px' href='delete_workshops.php?WorkshopID=$WorkshopID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_workshops.php?WorkshopID=$WorkshopID'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='7'>No data found</td></tr>";
}
// Close the database connection
$connection->close();
?>
      </table>

</body>

</section>
 
<footer>
  <center> 
   <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:NYABUNYANA ESTHER</h2></b>
  </center>
</footer>
  
</body>
</html>

