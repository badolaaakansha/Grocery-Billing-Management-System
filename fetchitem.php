<?php session_start();

include ("connection.php");
$name=$_GET['name'];
$sid=$_GET['store_id'];
$qnt=$_GET['Qnt'];
$sql="SELECT * FROM `inventory` WHERE `ProductName`='$name' AND `Store_id`=$sid AND `Stock`>=$qnt";
$result=$conn->query($sql);
$Available="";
$row = $result->fetch_assoc();
    if($result->num_rows==1 AND $qnt<=$row['Stock'] ){
    $id=$row['Product_id'];
    $name=$row['ProductName'];
    $price=$row['price'];
    $stock=$row['Stock'];

    $sql1="UPDATE `inventory` SET `Stock`=`Stock`- $qnt WHERE `ProductName`='$name'";
    $result1=$conn->query($sql1); 
    $sql2="UPDATE `inventory` SET `sold_qty`=`sold_qty`+ $qnt WHERE `ProductName`='$name'";
    $result2=$conn->query($sql2);    
    $total=$price*$qnt;


   $sql2="INSERT INTO `temp`(`id`, `productid`, `name`, `mrp`, `stock`, `Qnt`,`Store_id`,`total`) VALUES ('','$id','$name','$price','$stock','$qnt','$sid','$total')";
   $result2=$conn->query($sql2);


        $sql4 = "SELECT * FROM `sales_record` WHERE `Product_name`='$name' AND `day` = DATE(NOW()) AND `Store_id`='$sid'";
        $result4 = $conn->query($sql4);

        if ($result4->num_rows == 1) {
            $sql = "UPDATE `sales_record` SET `Total_sale`=`Total_sale` + $qnt WHERE `Product_name`='$name' AND `store_id`='$sid' AND `day` = DATE(NOW())";
            $result = $conn->query($sql);

            
            $sql1 = "UPDATE `sales_record` SET  `cost`=`Total_sale` * $price WHERE `Product_name`='$name' AND `store_id`='$sid' AND `day` = DATE(NOW())";
            $result1 = $conn->query($sql1);
        } else {
            $sql = "INSERT INTO `sales_record`(`id`, `store_id`, `day`, `Product_name`, `Total_sale`) VALUES ('','$sid',NOW(),'$name','$qnt')";
            $result = $conn->query($sql);
            $sql1 = "UPDATE `sales_record` SET  `cost`=`Total_sale` * $price WHERE `Product_name`='$name' AND `store_id`='$sid' AND `day` = DATE(NOW())";
            $result1 = $conn->query($sql1);

        }
   
} 
else{
    $Available="Not Available or Out of Stock";
}
 





$sql3= "SELECT * FROM `temp` WHERE `Store_id`='$sid'";

$result3 = $conn->query($sql3);

 

 
$i = 0;
$dt = array();
while($row = $result3->fetch_assoc()){
    $dt[] = $row;
}

$data = array(
    'message' =>$Available,
    'totalRecord' => $dt
);
echo json_encode($data);
?>

