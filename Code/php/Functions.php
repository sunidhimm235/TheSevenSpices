<?php

function MenuItemBox($product_name, $product_description, $product_price, $productid){
    $element="

    <div class=\"box\">
        <form action=\"menu.php\" method=\"post\">
        <h1 class=\"product-name\">$product_name</h1>
        <p class=\"description\">$product_description</p>
        <p class=\"price\">&#8377;$product_price</p>
        <button type=\"submit\" name=\"Add\" class=\"btn\">ORDER</button>
        <input type='hidden' name='product_id' value='$productid'>
        </form>
    </div>

    ";
echo $element;
}

function cartElement($product_name, $product_price, $productid){
    $element="
    
    <div class=\"container1\">
        <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
        <h1 class=\"product-name\">$product_name</h1>
        <p class=\"price\">&#8377;$product_price</p>
        <button type=\"submit\" name=\"remove\" class=\"btn\">Delete</button>
        </form>
    </div>

    ";
echo $element;
}

function cartElement2($product_name){
    $element="

                <h6 class=\"h6-3\">$product_name</h6>
    
    ";
echo $element;

}


?>