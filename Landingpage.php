<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>landing page</title>
    <link rel="stylesheet" href="Landingstyle.css?ver=1.3">
    <script>
        function login(){
            window.location.href = "Login.php";
        }
        function register(){
            window.location.href = "Register.php";
        }
    </script>
</head>
<body>
    <nav class="nav_bar">
        <h1> Grocery Billing  Management System</h1>
    </nav>
    <div class="landing_page">
     <div class="btns">

        <button class="btn1" onclick="login()" > Login </button>
        <button class="btn2" onclick="register()"> Register </button>
     </div>
  </div>
</body>
</html>