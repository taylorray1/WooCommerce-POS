<head>
    <title>Point of Sale | Brain Child Design</title> 
<LINK href="<?php echo $plugin_url ?>css/site-style.css" rel="stylesheet" type="text/css">
<LINK href="<?php echo $plugin_url ?>css/bootstrap.css" rel="stylesheet" type="text/css">
<LINK href="<?php echo $plugin_url ?>css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
<script src="<?php echo $plugin_url ?>js/searchable.js"></script>
<script src="<?php echo $plugin_url ?>js/bootstrap.js"></script>
<script type="text/javascript">
<?php
  include 'site-controller.php';
?>
</script>
</head>
<div id="main-wrapper">
<div id="POS-header">
<?php
    // Add a place where it shows who is logged in and gives loggout link
    $current_user = wp_get_current_user();
    echo '<p class="logged-in-show"> Salesperson: ' . $current_user->display_name;
    echo ' (<a href="'.wp_logout_url().'">Logout</a>)'; 
?>


<div id="POS-user-selection" class="head-wrapper">
<h2>Customer</h2>

<?php

// Customer select THIS SHOULD BE FUNCTIONIZED!
$current_customer_text = 'New Customer';
$current_customer_ID;
// prepare arguments
$args  = array('orderby' => 'display_name');
// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);
// Get the results
$users = $wp_user_query->get_results();
// Check for results
if (!empty($users))
{
    echo '<select name="customer" id="customer-select">';
    echo '<option value="0">Select an Existing Customer</option>';
    echo '<option value="1">New Customer</option>';
    // loop trough each user
    foreach ($users as $current_user)
    {
            // get all the user's data
            if(wp_get_current_user()->ID != $current_user->ID)
            {
                $current_user_info = get_userdata($current_user->ID);
                if($current_user_info->user_email != '')
                {
                    echo '<option value="'.$current_user_info->ID.'">'.$current_user_info->user_email.'</option>';
                }
                else{
                    echo '<option value="'.$current_user_info->ID.'">'.$current_user_info->display_name.'</option>';
                }
                
            }
    }
    echo '</select>';
} 
else 
{
    echo 'no users found for selection';
}
?>

<a href="#newuser" role="button" class="btn btn btn-primary" data-toggle="modal"><i class="icon-user icon-white"></i>Create New Customer</a>
</div>
<!-- CART -->

<div id="featured-products-wrapper" class="head-wrapper">
<h2>Customer Info</h2>
<div id="user-info"></div>
<span class="coming-soon-text"> Feature Coming Soon </span>
</div>

<div id="search-wrapper" class="head-wrapper">
<h2>Product Search</h2>
<div class="centered-div">
    <select type="text" id="product-search">
        <?php
            // HIDDEN FORM FOR PRODUCT SEARCH
            $args = array('post_type' => 'product', 'numberposts' => 1000);
            $post_array = get_posts( $args ); 
            $i = 0;
            
            foreach($post_array as $my_post_result) 
            {
                $product = new WC_Product($my_post_result->ID);
                if($product->price > 0)
                    echo '<option value="'. $my_post_result->ID .'">'. $my_post_result->post_title .'</option>';
                $i++;
            }

        ?>
    </select></div>
    <div style="margin: 0 auto; width: 126px;"><a href="#" id="addScnt" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Add Product</a></div>
</div>

<div id="checkout-wrapper" class="head-wrapper">
    <h2 style="padding-left:20px;"> Checkout </h2>
    <div id="total-view"><p><span style="font-size:20px;">$<span id="cart-total">0.00</span><span></p></div>
    <button id="BC-POS-Checkout" class="btn btn-primary" onclick="proc_to_checkout()"><i class="icon-shopping-cart icon-white"></i> Checkout</button>
</div>
</div>

<span class="seperator-div"><div id="featured-products"></div></span>

<table id="cart-table" class="table table-striped table-hover">
<thead>
    <tr>
        <th class="left-th">Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th class="right-th">Remove</th> 
    </tr>
</thead>

<tbody id="cart"></tbody>
</table>

<div id="empty-cart-wrapper"><div id="empty-cart"><span>Your Cart is Empty<br /><i class="icon-shopping-cart icon-white"></i> </span></div></div>
<!-- CART -->

</div>
<?php include 'nu_modal.php';?>