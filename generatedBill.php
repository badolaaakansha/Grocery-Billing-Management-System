<?php include "connection.php";
    $id=$_GET['id'];
    $sql="SELECT * FROM `storedetail` WHERE `store_id`=$id";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $sql2="SELECT MAX(Bill_number) as bill from customer_detail";
    $result2=$conn->query($sql2);
    $row2=$result2->fetch_assoc();
   // echo($row2['bill']);
   $sql3 = "SELECT * FROM `customer_detail` WHERE `Bill_number`='" . $row2['bill'] . "'";
   $result3=$conn->query($sql3);
   $row3=$result3->fetch_assoc();
   $sql4="SELECT * FROM `temp` WHERE `Store_id`='$id'";
   $result4=$conn->query($sql4);
   $sql5 = "SELECT sum(`total`) as total FROM `temp` WHERE `Store_id`='$id'";
   $result5=$conn->query($sql5);
   $row5=$result5->fetch_assoc();


   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="generatedbillstyle.css?ver=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script>
        function back(){
            window.location="home.php";
        }
        
    </script>

</head>
<body>
    <div class="invoice-container">
        <i class="fa-solid fa-arrow-left previous" onclick=back()></i>
        <div class="head">

            <div class="main-head">
                <img src="web-programming.png" alt="">
                <h1>INVOICE</h1>
            </div>

            <div class="company-data">
                <h1><?php echo $row['storename']?></h1>
                <p><?php echo $row['location']?></p>
            </div><!--company data-->
        </div><!--head-->

        <div class="company-data-two ">
            <div class="section-one">
                <h4>BILL TO:</h4><h4 style="margin-left:20px"><?php echo $row3['Name']?></h4>
                <h3>Email:</h3><h4 style="margin-left:20px"><?php echo $row3['Email']?></h4>
            </div>

            <div class="section-two">
                <h4>INVOICE #</h4>
                <p><?php echo $row2['bill']?></p>
                <h4>DATE</h4>
                <p id="demo"></p>
    
            </div>
            
        </div>

        <div class="table">
            <table>
                <tr >
                    <th>ITEMS</th>
                    <th style="width: 200px;">DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>TAX</th>
                    <th>AMOUNT</th>
                </tr>
   
                <?php while($row= $result4->fetch_assoc()){?>
                 <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td>Description</td>
                    <td><?php echo $row['Qnt'] ?></td>
                    <td><?php echo $row['mrp'] ?></td>
                    <td>0%</td>
                    <td><?php echo $row['Qnt'] * $row['mrp']; ?>.00</td>

                </tr>
                <?php }?>
            </table>
        </div>

        <div class="footer">
            <div class="notes">
                <h3 style="margin-bottom: 10px;">NOTES:</h3>

                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint eligendi pariatur nihil, doloremque vero optio soluta non nisi fugiat nostrum nesciunt eaque.
            </div>

            <div class="total">
                <h4>TOTAL</h4>
                <p style="font-size: 35px;"><?php echo $row5['total']?>.00</p>
            </div>
        </div>
    </div><!--invoice-container-->
    <script src="bill.js"></script>
</body>
</html>
