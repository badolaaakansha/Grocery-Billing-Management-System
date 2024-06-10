<?php
    
    include("connection.php");
    if(isset($_SESSION['Username'])){

    $store_id= $_GET['id'];
    
    $sql2="SELECT * FROM `storedetail` WHERE `store_id`=$store_id";
    $result2=$conn->query($sql2);
    $row2=$result2->fetch_assoc();
    if(isset($_POST['submit'])){
        $stock=$_POST['stock'];
        $expdate=$_POST['exp'];
        $name=$_POST['name'];
        $price=$_POST['price'];
        $sql="SELECT  `ProductName` FROM `inventory` WHERE `ProductName`='$name' AND `Store_id`='$store_id'";
        $result=$conn->query($sql);
        if($result->num_rows==1){
           $sql="UPDATE `inventory` SET `Stock`=`Stock`+'$stock',`Expiry_date`='$expdate',`price`='$price' WHERE `ProductName`='$name' AND`Store_id`='$store_id'";
            $result=$conn->query($sql);

        }
        
       else{
         
        $sql="INSERT INTO `inventory`(`Product_id`, `Store_id`, `Stock`, `Expiry_date`, `ProductName`, `price`) VALUES ('','$store_id','$stock','$expdate','$name','$price')";
        $result=$conn->query($sql);    
       }

        
        //$sql="INSERT INTO `inventory`(`Product_id`, `Store_id`, `Stock`, `Expiry_date`, `ProductName`, `price`) VALUES ('','$store_id','$stock','$expdate','$name','$price')";
        //$result=$conn->query($sql);
 

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="updateinventorystyle.css?ver=2.5">
    <title>Document</title>
    <script>
        function back(){
            window.location="welcomehome.php";
        }
        
    function search(sid) {
    let item = document.getElementById("search").value;
    if (item == '') {
        alert("Enter Search Data");
    }else{
    let xobj = new XMLHttpRequest();
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == 200) {
            var data = JSON.parse(xobj.responseText);
            if (data.length === 0) {
                document.getElementById('display').innerHTML = "<div style='color:red '>No results found.</div>";
            } else {
                var len = data.length;
                var str = "<div class='container'>";
                str += "<table border='0' style='padding: 10px; width: 100%'>";
                str += "<tr style='background-color: #f0f0f0; height:20px'>";
                str += "<th style='width: 20%'>Product_id</th>";
                str += "<th style='width: 20%'>Product Name</th>";
                str += "<th style='width: 20%'>Price Per Unit</th>";
                str += "<th style='width: 20%'>Stock</th>";
                str += "<th style='width: 20%'>Expiry_Date</th>";
                str += "<th style='width: 20%'>Delete</th>";
                str += "</tr>";
                for (var i = 0; i < len; i++) {
                    str += "<tr>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['Product_id'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['ProductName'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['price'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['Stock'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['Expiry_date'] + "<br>";
                    str += "</td>";
                    str += "<td style='color: red; font-weight: bold; text-align: center'>";
                    str += "<div onclick=del()><i style='margin-top:10px ' class='fa-solid fa-trash'></i></div>" + "<br>";
                    str += "</td>";
                    str += "</tr>";
                }
                str += "</table></div>";
                document.getElementById('display').innerHTML = str;
            }
        }
    };
    xobj.open("GET", "search.php?item=" + item + "&sid=" + sid, true);
    xobj.send();
}
}
function filter(sid) {
    let item = document.getElementById("filter").value;
    if (item == 'N') {
        alert("Enter Search Data");
    }else{
    let xobj = new XMLHttpRequest();
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == 200) {
            var data = JSON.parse(xobj.responseText);
            if (data.length === 0) {
                document.getElementById('display').innerHTML = "<div style='color:red '>No results found.</div>";
            } else {
                var len = data.length;
                var str = "<div class='container'>";
                str += "<table border='0' style='padding: 10px; width: 100%'>";
                str += "<tr style='background-color: #f0f0f0; height:20px'>";
                str += "<th style='width: 20%'>Product_id</th>";
                str += "<th style='width: 20%'>Product Name</th>";
                str += "<th style='width: 20%'>Price Per Unit</th>";
                str += "<th style='width: 20%'>Stock</th>";
                str += "<th style='width: 20%'>Expiry_Date</th>";
                str += "<th style='width: 20%'>Delete</th>";
                str += "</tr>";
                for (var i = 0; i < len; i++) {
                    str += "<tr>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['Product_id'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['ProductName'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['price'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['Stock'] + "<br>";
                    str += "</td>";
                    str += "<td style=' font-weight: bold; text-align: center'>";
                    str += data[i]['Expiry_date'] + "<br>";
                    str += "</td>";
                    str += "<td style='color: red; font-weight: bold; text-align: center'>";
                    str += "<div onclick=\"del('" + data[i]["Product_id"] + "')\"><i style='margin-top:10px ' class='fa-solid fa-trash'></i></div><br>";
                    str += "</td>";
                    str += "</tr>";
                }
                str += "</table></div>";
                document.getElementById('display').innerHTML = str;
            }
        }
    };
    xobj.open("GET", "filter.php?item=" + item + "&sid=" + sid, true);
    xobj.send();
}
}

        function show(){
                    document.querySelector('.overlay').classList.add('showoverlay');
                    document.querySelector('.Addform').classList.add('showloginform');
                    //document.getElementById("display").innerHTML ="Enter Amount You Get";
        }
        function del(pid) {
        var xobj = new XMLHttpRequest();
        xobj.onreadystatechange = function () {
            if (xobj.readyState === 4 && xobj.status === 200) {
                // Handle response
                //searchdata();
                document.getElementById('display').innerHTML = "<div class='msg'>Product Deleted From Inventory.</div>";

            }
        };
    xobj.open("GET", "delproduct.php?pid=" + pid, true);
    xobj.send();
}
    </script>
</head>
<body>
    <nav>
        <div class="one">
            <i style="margin-top:5px; margin-left:10px;"class="fa-solid fa-arrow-left" onclick=back()></i>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            
            <h2>Update Inventory</h2>
        </div>
        <div class="two">
            <i style="margin-top:5px"class="fa-solid fa-store"></i>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <h2><?php echo $row2['storename']?></h2>
        </div>
        
    </nav>  
    <div class="head">
        <h2>Products</h2>
        <div class="opt">
            <select name="" id="filter">
                <option value="N">None</option>
                <option value="asc">Price(Low to High)</option>
                <option value="desc">Price(High to Low)</option>
                <option value="is">By Increasing Stock</option>
                <option value="ds">By Decresing Stock</option>
                <option value="re">By Recent Expiery </option>


            </select>
            <button onclick="filter('<?php echo $store_id;?>');"><i class="fa-solid fa-filter"></i></button>

            <input type="text" id="search" placeholder="Search">
            <button onclick="search('<?php echo $store_id;?>');"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    <hr>
    <div id="display">
        
    </div>
    <footer>
        <button onclick=show()><i class="fa-solid fa-plus"></i><span>Add Product</span> 
        </button>
    </footer>
    <div class="overlay"></div>  
    <div class="Addform" >
        <form method="POST">
            
             <h2>Add Product</h2>
             <hr style="margin-bottom:30px">
            <div class="fdata">
                <div class="fm">
                    <label for="amount">Product Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="fm">
                    <label for="amount">Price per unit:</label>
                    <input type="text" name="price" required>
                </div>
                <div class="fm">
                    <label for="amount">Stock:</label>
                    <input type="text" name="stock" required>
                </div>
                <div class="fm">
                    <label for="amount">Expiry Date:</label>
                    <input type="date" name="exp" required>
                </div>
            </div>    
            <button type="submit" name="submit">Add</button>
        </form>
    </div> 
</body>
</html>
<?php } else {
    header("Location: newlanding.php");
} ?>