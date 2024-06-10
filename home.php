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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="home">
        <nav class="nav">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="Billing.php?id=<?php echo $row['store_id']?>">Billing</a></li>
                <li><a href="inventory.php?id=<?php echo $row['store_id']?>">Inventory</a></li>
                <li><a href="updateinventory.php?id=<?php echo $row['store_id']?>">Update Inventory</a></li>
                <li><a href="Billing.php?id=<?php echo $row['store_id']?>">About</a></li>
                <li style="align-self: last baseline;"><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log out</a></li>
            </ul>
        </nav>
        <div class="banner">
            <h1><?php echo($row['storename'])?>'s <br> Grocery Store</h1>
            <div><img class="img1" src="item1.png" alt=""></div>
            <div><img class="img2" src="item2.png" alt=""></div>
            
        </div>
    </div>
</body>
</html>
<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homestyle.css?ver=0.5">
    <title> group project</title>
</head>
<body>
    <nav class="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="Billing.php?id=<?php echo $row['store_id']?>">Billing</a></li>   
        <li><a href="inventory.php?id=<?php echo $row['store_id']?>">Inventory</a></li>
        <li><a href="<?php echo $row['store_id']?>">Payment</a></li>
        <li><a href="updateinventory.php?id=<?php echo $row['store_id']?>">Update Inventory</a></li>
        <li><a href="#">About</a></li>
        <li><a href="logout.php" >Log out</i></a></li>
    </nav>
    
    <div class="land">
        <div class="img1">
        <div class="data">
        <h2><?php echo($row['storename'])?></h2>
        </div>
            <img src="item1.png" alt="img">
        </div>
        <div class="img2"><img src="item2.png" alt=""></div>
    </div>


</body>
</html>-->

<?php } else {
    header("Location: Landingpage.php");
} ?>