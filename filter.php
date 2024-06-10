<?php
include("connection.php");
$sid=$_GET['sid'];
$item=$_GET['item'];
if($item=='asc'){
$sql="SELECT * FROM `inventory` WHERE `Store_id`=$sid ORDER BY `price` asc";
$result = mysqli_query($conn,$sql);
}

elseif($item=='desc'){
    $sql="SELECT * FROM `inventory` WHERE `Store_id`=$sid ORDER BY `price` desc";
    $result = mysqli_query($conn,$sql);
}
elseif($item=='is'){
    $sql="SELECT * FROM `inventory` WHERE `Store_id`=$sid ORDER BY `Stock` asc";
    $result = mysqli_query($conn,$sql);
}
elseif($item=='ds'){
    $sql="SELECT * FROM `inventory` WHERE `Store_id`=$sid ORDER BY `Stock` desc";
    $result = mysqli_query($conn,$sql);
}
elseif($item=='re'){
    $sql="SELECT * FROM `inventory` WHERE `Expiry_date` BETWEEN NOW() AND DATE_ADD(NOW(),INTERVAL 30 DAY) AND `Store_id`=$sid;
    ";
    $result = mysqli_query($conn,$sql);
}


$dt=array();
if(0 < mysqli_num_rows($result)){
 while($row=$result->fetch_assoc()){
     $dt[] = $row;
}
}
echo json_encode($dt);