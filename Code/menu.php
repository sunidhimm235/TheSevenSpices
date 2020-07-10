<?php

session_start();

require_once ('php/CreateDb.php');
require_once ('./php/Functions.php');

// create instance of Createdb class
$database = new CreateDb("Productdb", "Indian");

if (isset($_POST['Add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], 'product_id');

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'menu.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu of Seven Spices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="menu.style.css">
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
                <li id="content2"><a href="about.html">About</li>
                <li class="Content-3">
                    <a href="cart.php"><img src="carticon.png"></a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="MidPart">
        <br>
        <h1 class="title">MENU</h1>
        <?php

            $result = $database->getData("Indian");
                    while ($row = mysqli_fetch_assoc($result)){
                        MenuItemBox($row['product_name'], $row['product_description'], $row['product_price'], $row['id']);
                    }

        ?>
    </div>
</body>

</html>