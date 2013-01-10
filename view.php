<LINK href="<? echo $plugin_url ?>css/register-style.css" rel="stylesheet" type="text/css">
<LINK href="<? echo $plugin_url ?>css/bootstrap.css" rel="stylesheet" type="text/css">
<LINK href="<? echo $plugin_url ?>css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<? echo $plugin_url ?>js/searchable.js"></script>
<script src="<? echo $plugin_url ?>js/bootstrap.js"></script>
<script type="text/javascript">
<? 
  include 'cartjs.php';
?>
</script>
<?php
    $current_user = wp_get_current_user();
    echo 'salesperson:' . $current_user->display_name;
?>
<div id="POS-user-selection">
<h2>Customer</h2>
<?php
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
&nbsp;OR&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#newuser" role="button" class="btn btn btn-primary" data-toggle="modal"><i class="icon-user icon-white"></i>Create New User</a>
</div>
<div id="cartoverview">
<!-- CART -->

<h2>Featured Products</h2>
<div id="featured-products"></div>
<span style="clear:both;width:100%;display:block;margin:10px;padding:10px"></span>
<table class="table table-striped table-hover">

<thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Remove</th> 
    </tr>
</thead>

<tbody id="cart"></tbody>

</table>
<a href="#" id="addScnt" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Add Product</a>
<div style="float:right;">
<h3 style="float:left;">Total:</h3>
<div id="total">$0.00</div>
</div>
<div style="clear:both;"></div>
<!-- CART -->

<button id="BC-POS-Checkout" class="btn btn-primary" onclick="proc_to_checkout()"><i class="icon-shopping-cart icon-white"></i> Checkout</button>
</div>
<? include 'nu_modal.php' ?>