<?php
include("connection.php"); 
$sid=$_GET['sid'];
$sql3= "select * from temp where Store_id='$sid'";

$result3 = $conn->query($sql3);
 
$i = 0;
$dt = array();
while($row = $result3->fetch_assoc()){
    $dt[] = $row;
}

$data = array(
    
    'totalRecord' => $dt
);
echo json_encode($data);

?>