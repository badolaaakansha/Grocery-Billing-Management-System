<?php
    include("connection.php");
    if(isset($_SESSION['Username'])){
    $sid=$_GET['id'];
    //$id=$_SESSION['id'];
    $sql="SELECT * FROM `inventory` WHERE `Store_id`=$sid";
    $result=$conn->query($sql);
    $sql2="SELECT * FROM `storedetail` WHERE `store_id`=$sid";
    $result2=$conn->query($sql2);
    $row=$result2->fetch_assoc();
    $user_id=$row['user_id'];
    $sql3="SELECT * FROM `userdetail` WHERE `Userid`=$user_id";
    
    $result3=$conn->query($sql3);
    $row3=$result3->fetch_assoc();
  

?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="inventorystyle.css?ver=1.2">

</head>
<body>
    <div class="container">
        <div class="section-one">
            <h1 style="letter-spacing: 2px;"><?php echo $row['storename']?></h1>
            <div class="contact">
                <h5 class="mail"><?php echo $row['email']?></h5>,
                <h5><?php echo $row['mobile']?></h5>
            </div>
            <div class="section-two">
                <h3 style="color:white">Grocery Inventory</h3>
            </div>
        </div><!--top-->

        <div class="owner">
            <div class="box1">
                <div class="key">
                    <h4>Prepared by:</h4>
                    <h4>Address:</h4>
                    <h4>Email:</h4>
                </div>
                <div class="values">
                    <h4><?php echo $row3['Username'] ?></h4>
                    <h4 style="border-bottom: 1.5px solid rgb(78, 96, 78);border-top: 1.5px solid rgb(78, 96, 78);"><?php echo $row['location'] ?></h4>
                    <h4><?php echo $row['email'] ?></h4>
                </div><!--values-->
            </div><!--box1-->

            <div class="box2">
                <div class="key">
                    <h4 style="color: white;">Date:</h4>
                </div>
                <div class="values">
                    <h4 id="date"></h4>
                </div>
 
                               
            </div><!--box2-->
    
        </div>
        <div class="table">
            <table cellspacing="0">
                <tr>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Sold Qty</th>
                    <th>Remaining <br/> Stock</th>
                    <th>Recorder <br/> Status</th>
                </tr>
                <?php while($row4= $result->fetch_assoc()){?>
                    <tr>
                    <td><?php echo($row4['Product_id'])?></td>
                    <td><?php echo($row4['ProductName'])?></td>
                    <td><?php echo($row4['price'])?></td>
                    <td><?php echo($row4['sold_qty'])?></td>
                
                    <td><?php echo($row4['Stock'])?></td>
                    <td>Yes</td>
                </tr>
                    
                </div>
                <?php }?>
                 
            </table>
        </div><!--table-->
       
    </div><!--container-->
    <script src="inventory.js">

    </script>
</body>
</html>
<?php } else {
    header("Location: newlanding.php");
} ?>