<?php  
include("connection.php");
   $sid=$_GET['sid'];
   $item=$_GET['item'];
   $sql = "SELECT * FROM inventory WHERE ProductName LIKE '%$item%' and Store_id='$sid'";

   $result = mysqli_query($conn,$sql);
   $dt=array();
   if(0 < mysqli_num_rows($result)){
    while($row=$result->fetch_assoc()){
        $dt[] = $row;
   }
}
echo json_encode($dt);
