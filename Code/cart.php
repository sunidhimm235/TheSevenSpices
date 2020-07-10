<?php

session_start();

require_once ("./php/CreateDb.php");
require_once ("./php/Functions.php");

$db = new CreateDb("Productdb", "Indian");

if (isset($_POST['remove'])){
    if ($_GET['action'] == 'remove'){
        foreach ($_SESSION['cart'] as $key => $value){
            if($value["product_id"] == $_GET['id']){
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>

<meta charset="UTF-8">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Oswald:wght@600&family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Merriweather&family=Montserrat+Subrayada:wght@700&family=Teko:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fondamento&family=Kalam&family=Laila:wght@500&family=Rajdhani:wght@600&family=Tillana:wght@600&display=swap" rel="stylesheet">

</head>

<body>

    <header>
        <nav class="NavigationBar">
            <ul class="ContentOfNav">
                <li class="Content-2">
                    <a href="index.html">Seven Spices</a>
                </li>
                <li id="content2"><a href="menu.php">Menu</a></li>
                <li id="content2"><a href="blog.html">Blog</a></li>
                <li id="content2"><a href="deals.html">Deals</a></li>
                <li id="content2"><a href="about.html">About</a></li>
            </ul>
        </nav>
    </header>
    <div class="MidPart">
        <br>
        <h1>Your Order&nbsp;&nbsp;:</h1>
        <br>
        <?php

            $total = 0;
                    if (isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'], 'product_id');

                    $result = $db->getData("Indian");
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($product_id as $id){
                            if ($row['id'] == $id){
                                cartElement($row['product_name'],$row['product_price'],$row['id']);
                                $total = $total + (int)$row['product_price'];
                                }
                            }
                        }
                    }else{
                        echo "<h5>Cart is Empty</h5>";
                    }

        ?>
        <div class="container2">
            <form action="queensunu09@gmail.com" method="post">
            <h2 class="h2">Price Details &nbsp;:</h2>
            <hr>
            <h6 class="h63">Food Items:</h6>
            <div class="container3">
                <?php
                    if (isset($_SESSION['cart'])){
                        $product_id = array_column($_SESSION['cart'], 'product_id');
    
                        $result = $db->getData("Indian");
                        while ($row = mysqli_fetch_assoc($result)){
                            foreach ($product_id as $id){
                                if ($row['id'] == $id){
                                    cartElement2($row['product_name']);
                                    }
                                }
                            }
                        }else{
                            echo "<h5>Cart is Empty</h5>";
                        }
                ?>
            </div>
            <?php
                if (isset($_SESSION['cart'])){
                    $count  = count($_SESSION['cart']);
                    echo "<h6>Price ($count items)</h6>";
                }else{
                    echo "<h6>Price (0 items)</h6>";
                }
            ?>
            <h6 class="h6-1">&#8377;<?php echo $total; ?></h6>
            <h3 class="h3">Delivery Charges</h3>
            <h3 class="free">FREE</h3>
            <hr>
            <h4 class="h4">Amount Payable</h4>
            <h6 class="h6-2">&#8377;<?php echo $total; ?></h6>
            <hr>
            <label class="label">
                Your Name:
                <input type="text" name="name" class="input" required>
            </label>
            <br>
            <label class="label">
                Your Email:
                <input type="email" name="_replyto" class="input" required>
            </label>
            <br>
            <label class="label">
                Address:
                <textarea name="address" class="address" required></textarea> 
            </label>
            <br>
            <input type="submit" value="Order" class="btn1">
            <!--<button type="submit" name="Order" class="btn1">Order</button>-->
            </form>
        </div>
    </div>

</body>

</html>