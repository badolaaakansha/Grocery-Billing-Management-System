<?php include "connection.php";
    if(isset($_SESSION['Username'])){
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
    if(isset($_POST["submit"])){
        $sql="DELETE FROM `temp` WHERE `Store_id`=$id";
        $result=$conn->query($sql);
    }

   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="newbillstyle.css?ver=1.1">
        <script></script>
    </head>
    <body>

        <div class = "invoice-wrapper" id = "print-area">
            <div class = "invoice">
                <div class = "invoice-container">
                    <div class = "invoice-head">
                        <div class = "invoice-head-top">
                        <div class = ".invoice-head-top-left">
                                <h3><i class="fa-solid fa-arrow-left" onclick=back()></i></h3>
                            </div> 
                            <div class = "invoice-head-top-right text-end">
                                <h3>Invoice</h3>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p><span class = "text-bold">Date:</span><p id="demo"></p> </p>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Invoice No:</span><p><?php echo $row2['bill']?></p></p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'><?php echo $row['storename']?>'Grocery Store</li>
                                    <li><?php echo $row['location']?></li>
                                    
                                </ul>
                            </div>
                             
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td class = "text-bold">Items</td>
                                        <td class = "text-bold">Description</td>
                                        <td class = "text-bold">Qty</td>
                                        <td class = "text-bold">Rate</td>
                                        <td class = "text-bold">Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                            <?php while($row= $result4->fetch_assoc()){?>
                                                    <tr>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td>Description</td>
                                                        <td><?php echo $row['Qnt'] ?></td>
                                                        <td><?php echo $row['mrp'] ?></td>
                    
                                                        <td><?php echo $row['Qnt'] * $row['mrp']; ?>.00</td>

                                                    </tr>
                                                    <?php }?>
                                                            <!-- <tr>
                                        <td colspan="4">10</td>
                                        <td>$500.00</td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <div class = "invoice-body-bottom">
                                 
                                <div class = "invoice-body-info-item">
                                    <div class = "info-item-td text-end text-bold">Total:</div>
                                    <div class = "info-item-td text-end"><?php echo $row5['total']?>.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "invoice-foot text-center">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and does not require physical signature.</p>

                        <div class = "invoice-btns">
                            <form method="POST">
                            <button type = "submit" class = "invoice-btn" onclick="printInvoice()" name="submit">
                                <span>
                                    <i class="fa-solid fa-print"></i>
                                </span>
                                <span>Print</span>
                            </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src = "bill.js?ver=1.1"></script>
    </body>
</html>
<?php } else {
    header("Location: newlanding.php");
} ?>