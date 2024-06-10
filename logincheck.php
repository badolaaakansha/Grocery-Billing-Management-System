<?php
    include("connection.php");
    
    if(isset($_POST["submit"])){
        $username=$_POST['user'];
        $pwd=$_POST['pass'];
        $sql="SELECT  * FROM `userdetail` WHERE `Username`='$username' AND `Password`='$pwd'";
        $result=$conn->query($sql);
        if($result->num_rows==1){
            $row = $result->fetch_assoc();
            $_SESSION['Username'] = $row['Username'];

            $_SESSION['id'] = $row['Userid'];
            $_SESSION['pwd'] = $row['password'];
            header("location:welcomehome.php");
        }
        else{  
            echo '<script>
           window.location.href="Login.php";
           alert("Invalid Login")</script>';
        }
    }
?>