<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="mystyle.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendeefeedback Page</title>
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
    <h1><u>Attendeefeedback Form</u></h1>


<form method="post" onsubmit="return confirmInsert();">

    <label for="FeedbackID">FeedbackID:</label>
    <input type="number" id="book_id" name="book_id" required><br><br>

    <label for="AttendeeID">AttendeeID:</label>
    <input type="number" id="ride_id" name="ride_id" required><br><br>

    <label for="WorkshopID">WorkshopID:</label>
    <input type="number" id="passenger_id" name="passenger_id" required><br><br>

    <label for="Rating">Rating:</label>
    <input type="text" id="booking_time" name="booking_time" required><br><br>

    <label for="Comments">Comments:</label>
     <input type="text" id="bookingtime" name="bookingtime" required><br><br>

    </select><br><br>

    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO attendeefeedback(FeedbackID, AttendeeID, WorkshopID, Rating, Comments) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $FeedbackID, $AttendeeID, $WorkshopID, $Rating, $Comments);
    // Set parameters and execute
    $FeedbackID = $_POST['book_id'];
    $AttendeeID = $_POST['ride_id'];
    $WorkshopID = $_POST['passenger_id'];
    $Rating = $_POST['booking_time'];
    $Comments = $_POST['bookingtime'];
   
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
    <title>Attendeefeedback Details</title>
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
    <center><h2>Attendeefeedback Table</h2></center>
    <table border="3">
        <tr>
            <th>FeedbackID</th>
            <th>AttendeeID</th>
            <th>WorkshopID</th>
            <th>Rating</th>
            <th>Comments</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all attendeefeedback
$sql = "SELECT * FROM attendeefeedback";
$result = $connection->query($sql);

// Check if there are any attendeefeedback
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $FeedbackID = $row['FeedbackID']; // Fetch the FeedbackID
        echo "<tr>
            <td>" . $row['FeedbackID'] . "</td>
            <td>" . $row['AttendeeID'] . "</td>
            <td>" . $row['WorkshopID'] . "</td>
            <td>" . $row['Rating'] . "</td>
            <td>" . $row['Comments'] . "</td>
            <td><a style='padding:4px' href='delete_attendeefeedback.php?FeedbackID=$FeedbackID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_attendeefeedback.php?FeedbackID=$FeedbackID'>Update</a></td> 
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

