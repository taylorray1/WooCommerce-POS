var prices = new Object();
var cart = new Object();
var names = new Object();

<?php
    $args = array('post_type' => 'product', 'numberposts' => 1000);
    $post_array = get_posts( $args ); 
    $i = 0;
    
    foreach($post_array as $my_post_result) 
    {
        $product = new WC_Product($my_post_result->ID);
        $price = $product->price;
        $title = $my_post_result->post_title;
        if($price == "")
            $price = "0.00";
        if($price != "")
        {
            echo 'prices["'.$my_post_result->ID.'"] = '.$price.';';
            echo 'names["'. $my_post_result->ID.'"] = "'.$title.'";';
        }
    }
    i++;
?>

function set_item_qty(product_id, qty)
{
    if(qty > 0)
        cart[product_id] = qty;
    else
        cart[product_id] = 0;
}

function add_to_cart(product_id)
{
    if(product_id in cart)
        cart[product_id]++;
    else
        cart[product_id] = 1;
}

function get_price(product_id)
{
	return prices[product_id];
}

function get_name(product_id)
{
	return names[product_id];
}

function remove_one_from_cart(product_id)
{
    if(product_id in cart)
        cart[product_id]--;
    if(cart[product_id] < 0)
    	cart[product_id] = 0;
}

function remove_from_cart(product_id)
{
    if(product_id in cart)
        cart[product_id] = 0;
}

function get_cart()
{
	return cart;
}

function get_cart_total()
{
	var total = 0.00;
	var current_id;
    for (current_id in cart) 
    {
        if(cart[current_id] > 0)
        {
        	total += prices[current_id] * cart[current_id];
    	}
    }
    total = Math.round(total*100)/100;
    return total.toFixed(2);
}

function get_neat_cart()
{
    var temp_cart = new Object();
    var unique_count = 0;
    for (current_id in cart) 
    {
        if(cart[current_id] > 0)
        {
            temp_cart[current_id] = cart[current_id];
            unique_count++;
        }
    }
    temp_cart[0] = unique_count;
    return temp_cart;
}
