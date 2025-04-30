<?php
// Start the session to manage logout
session_start();

// Destroy all session data to log out the user
session_unset();
session_destroy();

// Redirect to login page after logout
header("Location: login.php");
exit(); // Don't forget to exit after header redirection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout - Medical Team Website</title>
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        display: flex;
        flex-direction: column;
        height: 100vh;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .logout-container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .logout-container h1 {
        color: #3fa83e;
        margin-bottom: 20px;
    }

    .logout-container p {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .logout-container button {
        padding: 10px 20px;
        background-color: #3fa83e;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .logout-container button:hover {
        background-color: #4e8e34;
    }
  </style>
</head>
<body>

  <div class="logout-container">
    <h1>Thank You for Visiting!</h1>
    <p>You have successfully logged out.</p>

    <button onclick="window.location.href='login.php'">Login Again</button>
  </div>

</body>
</html>
