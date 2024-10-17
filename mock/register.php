<?php
$conn = new mysqli("localhost", "root", "", "qrs"); // Change database name to "qrs"
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)"); // Change table name to "users"
    $stmt->bind_param("ss", $username, $password);  
    if ($stmt->execute()) {
        header("Location: login.php"); // Redirect to index.php after successful registration
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }   
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Medicube Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('cover.jpeg') no-repeat center center;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(192, 192, 192, 0.8); /* Stone color with transparency */
            border-radius: 15px; /* Rounded edges */
            width: calc(100% - 40px); /* Fit within the window with padding */
            margin: 0 auto; /* Center horizontally */
        }

        .brand-name {
            font-size: 24px;
            color: white;
        }

        .navigation {
            display: flex;
            gap: 20px;
        }

        .navigation a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .login-button {
            background: white;
            color: grey;
            padding: 10px 20px;
            border-radius: 15px;
            text-decoration: none;
            font-size: 18px;
        }

        .content {
            display: flex;
            align-items: center;
            padding: 50px;
            justify-content: space-between; /* Distribute space between the elements */
            flex: 1;
        }

        .quote {
            color: #53565A;
            font-size: 60px;
            font-family: "Lucida Console";
            text-align: left;
        }

        .registration-container {
            padding: 40px;
            background: rgba(192, 192, 192, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
            width: 40%;
            text-align: left;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #216a94;
        }
    </style>
</head>

<body>
    <div class="top-container">
        <div class="brand-name">Medicube</div>
        <div class="navigation">
            <a href="#">Home</a>
            <a href="#">Insight</a>
            <a href="#">Contact</a>
        </div>
        <a href="#" class="login-button">Login</a>
    </div>

    <div class="content">
        <!-- Quote content on the left -->
        <div class="quote">Ensuring <br>Your<br> Loved<br> Ones</div> 

        <!-- Registration form centered -->
        <div class="registration-container">
            <form method="post" action="">
                <h2>Medicube - Registration</h2>
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>
</html>
