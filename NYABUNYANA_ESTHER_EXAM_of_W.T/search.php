<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {

 include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        ' attendeefeedback' => "SELECT FeedbackID FROM  attendeefeedback WHERE FeedbackID LIKE '%$searchTerm%'",
        'attendees' => "SELECT AttendeeID FROM attendees WHERE AttendeeID LIKE '%$searchTerm%'",
        ' diversityandinclusionresources' => "SELECT  Title FROM  diversityandinclusionresources WHERE  Title LIKE '%$searchTerm%'",
        'instructors' => "SELECT InstructorID FROM instructors WHERE InstructorID LIKE '%$searchTerm%'",
        ' resourcecomments' => "SELECT CommentID FROM  resourcecomments WHERE CommentID LIKE '%$searchTerm%'",
         'topics' => "SELECT TopicName FROM topics WHERE TopicName LIKE '%$searchTerm%'",
        'workshopmaterials' => "SELECT MaterialName FROM workshopmaterials WHERE MaterialName LIKE '%$searchTerm%'",
        'workshops' => "SELECT Title FROM workshops WHERE Title LIKE '%$searchTerm%'",
        'workshoptopics' => "SELECT WorkshopTopicID FROM workshoptopics WHERE WorkshopTopicID LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>


