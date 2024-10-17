<?php

// Establish a database connection
$con = mysqli_connect('localhost', 'root', '', 'qrs');

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Prepare the SQL statement
$stmt = $con->prepare("INSERT INTO log (name, dom, doe) VALUES (?, ?, ?)");

// Bind parameters
$stmt->bind_param("sss", $name, $dom, $doe);

// Set parameters and execute the statement
$name = $_POST['name'];
$dom = $_POST['dom'];
$doe = $_POST['doe'];

if ($stmt->execute()) {
    echo "Records inserted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$con->close();

?>
