<?php
    include("connection.php");
    if(isset($_SESSION['Username'])){

    $id=$_GET['id'];
    $sql="SELECT * FROM `storedetail` WHERE  `store_id`=$id";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Billingstyle.css?ver=1.9">
</head>
<body>
    <div class="container">
        
    <div class="head">
            <h1 class="heading">GENERATE BILL</h1>
        </div>

        <form method="POST" action="save_del.php?id=<?php echo $id;?>">
            <div class="first-row flex">
                <div>
                    <label for="cname">Customer Name :</label>
                    <input class="inp" style="width: 190px;height: 25px;" type="text" name="nm" id="cname" required>
                </div>
                <br>
                <div>
                    <label for="cname">Customer Email :</label>
                    <input class="inp" style="width: 190px;height: 25px;" type="text" name="email" id="cname" required>
                </div>
            
                
    
                <div class="contact">
                    <label>Mobile : <span><?php echo $row['mobile']?></span></l abel>
                    <br/>
                    <label >GSTIN : <span><?php echo $row['gstin']?></span></label>
                </div>
    
                <div class="flex address">
                    <div>Address : </div>
                    <div>
                        <?php echo $row['location']?>
                    </div>
                </div>
                 
            </div> <!--First row-->

            <div class="second-row flex">
                <div>
                    <label for="pname">Product Name :</label><br/>
                    <input class="inp" style="width: 190px;" type="text" name="item" id="pname">
                    <div id="message" >

                    </div>
                </div>
                <div>
                    <label for="desc">Description :</label><br/>
                    <input class="inp" style="width: 190px;" type="text" name="" id="desc">
                </div>
                
                <div>
                    <label for="qnt">Qnt :</label><br/>
                    <input class="inp" type="text" name="" id="qnt">
                </div> 
                <div  class="btn1" onclick="search('<?php echo $row['store_id'];?>'); ">
                    <p>ADD</p>
                </div>
            </div>
            

            <div class="box">
                <div class="box-inside">
                    <div class="table">
                        <table style="width: 100%;" >
                            <tr>
                                <th></th>
                                <th style="text-align:center;">ProductName</th>
                                <th style="text-align:center;">Price</th>
                                <th style="text-align:center;">Qnt</th>
                                 
                                <th style="text-align:center;">TotalPrice</th>
                                <th style="text-align:center;">Remove</th>
                            </tr>
                            <tr>
                        </table>
                    </div>
                    <div id="display_here">
                        

                        
                    </div>
                    
                </div>
                <div>
                    <h2>Note:- Don't Refresh a page until you generated a bill.</h2>
                    <div class="btns">
                        <button  class="btn2" style="background-color: #76ABAE; pointer:cursor; " name="save">SAVE</button>
                        <button class="btn2" style="background-color: #C73659;" name="cancle">CANCEL</button>
                    </div>
                      
                </div>
               
            </div>
            
        </form>

    </div>  <!--contaner-->
   
<script src="billingdemo.js?ver=3.1"></script>
</body>
</html>

<?php } else {
    header("Location: newlanding.php");
} ?>
