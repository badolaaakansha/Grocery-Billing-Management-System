<?php
    include("connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="Loginstyle.css?ver=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h1 class="head">Login</h1>
            <form method='POST' action="logincheck.php" >
                <div class="input-form">
                    <div class="input-field">
                        <label for="user">Username</label>
                        <br/>
                        <i class="fa-solid fa-user"></i>
                        <input class="input" type="text" name="user" id="user">

                        <div class="user-pass">
                            <label for="pass">Password</label>
                            <br/>
                            <i class="fa-solid fa-lock"></i>
                            <input class="input" type="password" name="pass" id="pass">
                            </div>
                        
                    </div>
                </div>
                <button type='submit' name="submit" class="btn">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>