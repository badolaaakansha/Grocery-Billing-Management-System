<?php
    include("connection.php");
    $id=$_GET['id'];
    $sql="DELETE FROM `temp` WHERE `id`=$id";
    $result=$conn->query($sql);
    
?>
