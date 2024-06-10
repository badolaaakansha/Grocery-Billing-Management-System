<?php include "connection.php";

$page = "error.php";
$sid = $_GET['id'];
//echo($id);
if(isset($_POST["save"])){
    // save code
    $name=$_POST['nm'];
    $email=$_POST['email'];
    $sql="INSERT INTO `customer_detail`(`Bill_number`, `Name`, `Email`,`store_id`) VALUES ('','$name','$email','$sid')";
    $result=$conn->query($sql);
    // del code
    //$sql="DELETE FROM `temp`";
    //$result=$conn->query($sql);

    $page = "newbill.php?id=".$sid;
}
if(isset($_POST["cancle"])){
    
    $sql="SELECT * FROM `temp` ";
    $result=$conn->query($sql); 
    while ($row = $result->fetch_assoc()) {
        $sql2 = "UPDATE `inventory` SET `sold_qty` = `sold_qty` - '{$row['Qnt']}', `Stock` = `Stock` + '{$row['Qnt']}' WHERE `Product_id` = '{$row['productid']}'";
        $result2 = $conn->query($sql2); // Use a different variable name for the inner loop's result set
    
        $sql = "UPDATE `sales_record` SET `Total_sale` = `Total_sale` - '{$row['Qnt']}' WHERE `Product_name` = '{$row['name']}' AND `store_id` = '{$row['Store_id']}' AND `day` = DATE(NOW())";
        $result_update_sales_record = $conn->query($sql); // Use a different variable name for the update query result
        

            
        $sql4 = "UPDATE `sales_record` SET `cost` = `cost` - {$row['Qnt']} * {$row['mrp']} WHERE `Product_name` ='{$row['name']}'  AND `store_id` = '{$row['Store_id']}' AND `day` = DATE(NOW())";
        $result4 = $conn->query($sql4);
    }
    
    
    
    
    
    
    
    $sql="DELETE FROM `temp` WHERE `Store_id`=$sid";
    
    
    $result=$conn->query($sql);



    $page = "Billing.php?id=".$sid;
}

header("Location: " . $page);
?>