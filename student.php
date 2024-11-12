<?php
// add_student.php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = "";     // Default XAMPP password is empty
$dbname = "school_management"; // Make sure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Capture form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $class = $_POST['class'];
  $attendance = $_POST['attendance'];

  // Prepare and bind
  $stmt = $conn->prepare("INSERT INTO students (name, class, attendance) VALUES (?, ?, ?)");
  $stmt->bind_param("sii", $name, $class, $attendance);

  // Execute and check if successful
  if ($stmt->execute()) {
    echo "New student added successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();

  // Redirect back to students page after adding
  header("Location: students.html");
  exit();
}
?>
