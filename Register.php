<?php
    include("connection.php");

    if(isset($_POST['submit'])){
        $username = $_POST["user"];
        $email = $_POST["phno"];
        $mnumber = $_POST["phnp"];
        $pwd = $_POST["pass"];
        $pwd2 = $_POST["pass2"];

        $checkuser="SELECT  `Email`, `Phone` FROM `userdetail` WHERE `Email`= '$email' OR `Phone`='$mnumber'";
        $result=$conn->query($checkuser);
        if($result->num_rows==1){
            echo "<script>alert('Registrayion failed')</script>";
        }
        
       else{
        $sql="INSERT INTO `userdetail`(`Userid`, `Username`, `Email`, `Phone`, `Password`, `confirm_password`) VALUES ('','$username','$email','$mnumber','$pwd','$pwd2')";
        mysqli_query($conn,$sql);
        $_SESSION['usr'] = $email;
        

        echo "<script>alert('data success')</script>";
        header("location:storedetail.php");       
       }
      
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
    <link rel="stylesheet" href="Registerstyle.css?ver=0.6">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h1 class="head">Registration</h1>
            <form method="POST" >
                <div class="input-form">
                    <div style="margin-top:-10px" class="input-field">
                        <label for="user">Username</label>
                        <br/>
                        <i class="fa-solid fa-user"></i>
                        <input class="input" type="text" name="user" id="user">

                        <div class="user-pass">
                            <label for="email">Email</label>
                            <br/>
                            <i class="fa-regular fa-envelope"></i>
                            <input class="input" type="email" name="phno" id="email">
                        </div>

                        <div class="user-pass">
                            <label for="phno">Contact</label>
                            <br/>
                            <i class="fa-regular fa-address-book"></i>
                            <input class="input" type="number" name="phnp" id="phno">
                        </div>

                        <div class="user-pass">
                            <label for="pass">Password</label>
                            <br/>
                            <i class="fa-solid fa-lock"></i>
                            <input class="input" type="password" name="pass" id="pass">
                        </div>
    
                        <div class="user-pass">
                            <label for="pass">Confirm Password</label>
                            <br/>
                            <i class="fa-solid fa-lock"></i>
                            <input class="input" type="password" name="pass2" id="pass">
                        </div>
                        
                    </div>
                </div>
                <button type="submit" name="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>