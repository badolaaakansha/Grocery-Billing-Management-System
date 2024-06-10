<?php
include("connection.php");
$pid=$_GET['pid'];
$sql="DELETE FROM `inventory` WHERE `Product_id`=$pid";
$result=$conn->query($sql);
?>