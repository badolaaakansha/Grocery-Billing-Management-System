<?php
include("connection.php"); 
if(isset($_SESSION['Username'])){
$sid=$_GET['id'];
$sql="SELECT * FROM `temp` WHERE `Store_id`='$sid'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$sql1="SELECT Product_name FROM sales_record WHERE day = DATE(NOW()) GROUP BY Product_name ORDER BY SUM(cost) DESC LIMIT 1;
";
$result1=$conn->query($sql1);
$row1=$result1->fetch_assoc();
 
$sql5 = "SELECT SUM(`cost`) AS total FROM `sales_record` WHERE  `store_id`='$sid' AND `day` = DATE(NOW())";

$result5=$conn->query($sql5);
$row5=$result5->fetch_assoc();



$top="SELECT Product_name, total_sale ,SUM(cost) AS total_sales
FROM sales_record
WHERE `day` = DATE(NOW()) And `store_id`=$sid
GROUP BY Product_name
ORDER BY cost DESC
LIMIT 5";
$result6=$conn->query($top);
$i = 0;
$dt = array();
while($row = $result6->fetch_assoc()){
    $dt[$i]["label"] = $row['Product_name'];
    $dt[$i]["y"] = $row['total_sale'];
	$i++;

}

$sql7="SELECT DATE(day) AS day, SUM(cost) AS total_sales FROM sales_record WHERE day >= CURDATE() - INTERVAL 6 DAY AND day <= CURDATE() And `store_id`=$sid GROUP BY DATE(day) ORDER BY DATE(day);
";
$result7=$conn->query($sql7);
$i = 0;
$dt2 = array();
while($row = $result7->fetch_assoc()){
    $dt2[$i]["label"] = $row['day'];
    $dt2[$i]["y"] = $row['total_sales'];
	$i++;

}



 
?>
<!DOCTYPE HTML>
<html>
<head>
    
<link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=ABeeZee&display=swap" rel="stylesheet" />
    <link href="sale_report.css?ver=1.2" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title> 
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true  ,
	theme: "light2",

	axisY: {
		title: "Quantity Sold"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## ",
		dataPoints: <?php echo json_encode($dt, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "light2",

	axisY: {
		title: "Sale (Per Day)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($dt2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
 
}
</script>
</head>
<body>

 
    <div class="v1_2">
        <div class="v5_2"> <i onclick="back()"class="fa-solid fa-arrow-left"></i></div><!--nav-->
        <div class="v5_22">
        <div id="chartContainer" style="height: 390px; width: 100%;"></div>
</div>    
        <!--left-->
        <span class="v5_23">Top 5 Sale of the Day</span>
          
        
        <span class="v5_77">SALES REPORTS</span>
        <div class="v5_78">
        <div id="chartContainer2" style="height: 390px; width: 100%;"></div>

        </div>
        <span class="v5_79">Sales per Day</span>
      
        
        <span class="v5_110" style="font-weight:bold">Sale on <span id="demo"></span>: <span style="font-weight:lighter"><?php echo $row5['total']?></span></span>
        <span class="v5_111" style="font-weight:bold">Top selling product: <span style="font-weight:lighter"><?php echo $row1['Product_name'] ?></span></span>
    </div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="sale.js?ver=1.1"></script>

</body>
</html>
<?php } else {
    header("Location: newlanding.php");
} ?>
