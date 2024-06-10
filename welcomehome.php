
<?php
    include("connection.php");
    
if(isset($_SESSION['Username'])){
    $id=$_SESSION['id'];
    $sql="SELECT * FROM `storedetail` WHERE `user_id`='$id'";
    $result=mysqli_query($conn,$sql);
    $row = $result->fetch_assoc(); 
    $_SESSION['sid'] = $row['store_id'];

?>
<!DOCTYPE html>
<html>
<head>
    <!--<link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />-->
    <link href="homestyle.css?ver=3.1" rel="stylesheet" /> <!-- Add this line -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Document</title>
    <script>
        function logout(){
            window.location.href="logout.php";
        }
        
        function back(){
            window.location.href="Login.php";
        }
    </script>
</head>
<body>
    <div class="v1_5">
        <div class="v1_6"></div>
        <span class="v24_35"><?php echo($row['storename'])?></span>
        <span class="v24_36"><?php echo($row['email'])?></span>
        <span class="v24_37">+91<?php echo($row['mobile'])?></span>
        <div class="v24_24"></div>
        <span class="v24_25"><a href="welcomehome.php">HOME</a></span>
        <span class="v24_26"><a href="Billing.php?id=<?php echo $row['store_id']?>">BILLING</a></span>
        <span class="v24_27"><a href="inventory.php?id=<?php echo $row['store_id']?>">INVENTORY</a></span>
        <span class="v24_28"> <a href="updateinventory.php?id=<?php echo $row['store_id']?>">UPDATE  INVENTORY</a></span>
        <span class="v24_31"><a href="sale_report.php?id=<?php echo $row['store_id']?>">SALES REPORT</a></span>

        <span class="v24_29"><a href="About.php">ABOUT</a></span>
        <span class="v24_30"><a href="logout.php">LOG OUT</a></span>
        <div class="v24_32" onclick="logout()"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
        <div class="v24_39"></div>
        <div class="v24_57"></div>
        

        <div class="name"></div>
        <div class="v24_58"></div>

        <div class="name"></div>
        <div class="v24_59"></div>

        <div class="name"></div>
        <div class="v24_60"></div>
        <div class="v24_61"></div>

        <div class="name"></div>
        <span class="v24_64">No more Messy
 calculations.
</span>
<div class="vl"></div>
        <span class="v54_65">No running
out of Items
Unexpectedly!</span>
        <span class="v54_66">Say Goodbye 
to dust on 
your Shelves.</span>
        <span class="v54_67">Stock items 
on Time.</span>
        <span class="v54_70">Reliable Partner
by your side.</span>
        <div class="v54_73" onclick="back()"><i class="fa-solid fa-arrow-left"></i></div>
        <div class="v54_72"></div>
    </div>
</body>
</html>

<?php } else {
    header("Location: newlanding.php");
} ?>
