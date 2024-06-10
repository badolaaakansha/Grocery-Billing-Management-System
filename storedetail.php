<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $storename = $_POST["user"];
        $location = $_POST["phno"];
        $GST = $_POST["phnp"];
        $email = $_POST["pass"];
        $Mobile = $_POST["pass2"];
        $user_id=$_SESSION['usr'];
        $sql2="SELECT * FROM `userdetail` WHERE `Email`='$user_id'";
        $result2=mysqli_query($conn,$sql2); 
        $row = $result2->fetch_assoc();
        $id= $row['Userid'];

        $checkuser="SELECT * FROM `storedetail` WHERE `mobile`='$Mobile' AND `gstin`='$GST'";
        $result=$conn->query($checkuser);
        if($result->num_rows==1){
          echo '<script>
          window.location.href="index.php";
          alert("Mobile Number or Email are alredy registered")</script>';
       }
       else{
        
        $sql4="INSERT INTO `storedetail`(`store_id`, `user_id`, `storename`, `location`, `gstin`, `email`, `mobile`) VALUES ('','$id','$storename','$location','$GST','$email','$Mobile')";
        mysqli_query($conn,$sql4);
        echo "<script>alert('data success')</script>";
        header("location:Login.php");       
       }
      
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
    <link rel="stylesheet" href="storedetailstyle.css?ver=0.6">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h1 class="head">Store Registration</h1>
            <form method="POST" >
                <div class="input-form">
                    <div style="margin-top:-10px" class="input-field">
                        <label for="user">Store Name</label>
                        <br/>
                        <i class="fa-solid fa-user"></i>
                        <input class="input" type="text" name="user" id="user">

                        <div class="user-pass">
                            <label for="">Location</label>
                            <br/>
                            <i class="fa-solid fa-location-dot"></i>
                            <input class="input"  name="phno" id="email">
                        </div>

                        <div class="user-pass">
                            <label for="">GSTIN</label>
                            <br/>
                            <i class="fa-regular fa-address-book"></i>
                            <input class="input"  name="phnp" id="phno">
                        </div>

                        <div class="user-pass">
                            <label for="">Email</label>
                            <br/>
                            <i class="fa-regular fa-envelope"></i>
                            
                            <input class="input"  name="pass" id="pass">
                        </div>
    
                        <div class="user-pass">
                            <label for="phno">Mobile Number</label>
                            <br/>
                            <i class="fa-solid fa-mobile"></i>
                            <input class="input"  name="pass2" id="pass">
                        </div>
                        
                    </div>
                </div>
                <button type="submit" name="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>