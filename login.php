
<?php
// Include the database connection file
include('db.php');

$success_message = "";
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that user_name and password are set before using them
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password)) {
        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO login(user_name, password) VALUES ('$user_name', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            
            $success_message = "Login successful!";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_message = "Username and password cannot be empty.";
    }
}

// Close the database connection
$conn->close();

 

?>


<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style l.css">
     <style>
        /* Style the success and error messages */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color:white;
            color: white;
            border-radius: 5px;
            font-size: 18px;
            z-index: 1000;
        }

        .popup-error {
            background-color: #dc3545;
        }

        .popup-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ffffff;
            color: #333;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form action="login.php" method="POST">
    <div class="txt_field">
        <input type="text" name="user_name" required>
        <span></span>
        <label>Username</label>
    </div>
    <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Password</label>
    </div>
    <div class="pass">Forgot Password?</div>

    <input type="submit"   value="Login" >

    <div class="signup_link">
    </div>


</form>
</div>  

    </div>

 <?php if ($success_message): ?>
        <div id="popup-success" class="popup"><?php echo $success_message; ?>
            <button class="popup-button" onclick="closePopup('popup-success')">Close</button>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div id="popup-error" class="popup popup-error"><?php echo $error_message; ?>
            <button class="popup-button" onclick="closePopup('popup-error')">Close</button>
        </div>
    <?php endif; ?>

    <script>
        // Show popup based on the PHP message
        window.onload = function() {
            <?php if ($success_message): ?>
                document.getElementById('popup-success').style.display = 'block';
            <?php endif; ?>

            <?php if ($error_message): ?>
                document.getElementById('popup-error').style.display = 'block';
            <?php endif; ?>
        };

        // Close the popup
        function closePopup(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>

  </body>
</html>

  