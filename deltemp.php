<?php
    include("connection.php");
    $bid=$_GET['id'];
    $sql2="SELECT * FROM `temp` WHERE `id`=$bid";
    $result2=$conn->query($sql2);
    $row=$result2->fetch_assoc();
    $sql1 = "UPDATE `inventory` SET `Stock` = `Stock` + '{$row['Qnt']}' WHERE `Product_id` = '{$row['productid']}'";

    $result1=$conn->query($sql1);
    $sql2 = "UPDATE `inventory` SET `sold_qty` = `sold_qty` -'{$row['Qnt']}' WHERE `Product_id` = '{$row['productid']}'";

    $result2=$conn->query($sql2);


    $sql = "UPDATE `sales_record` SET `Total_sale`=`Total_sale` - '{$row['Qnt']}' WHERE `Product_name`='{$row['name']}' AND `store_id`='{$row['Store_id']}' AND `day` = DATE(NOW())";
    $result = $conn->query($sql);

    $sql4 = "UPDATE `sales_record` SET `cost` = `cost` - {$row['Qnt']} * {$row['mrp']} WHERE `Product_name` ='{$row['name']}'  AND `store_id` = '{$row['Store_id']}' AND `day` = DATE(NOW())";
    $result4 = $conn->query($sql4);


    $sql="DELETE FROM `temp` WHERE `id`=$bid";
    $result=$conn->query($sql);
?>