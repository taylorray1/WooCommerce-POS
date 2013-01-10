<?php
$wpbh = './../../../wp-blog-header.php';
// inc stuffs
global $woocommerce;
if(file_exists($wpbh))
{
    require($wpbh);
}
$current_user = wp_get_current_user();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<meta name='robots' content='noindex,nofollow' />
<LINK href="./css/checkout-style.css" rel="stylesheet" type="text/css">

<script>
// #order_review
$(document).ready(function(){
	$("label").addClass("ui-hidden-accessible");
	$(".col-2").hide();
	$(".col-1").css("width", "100%");
	$("#shiptobilling-checkbox").hide();
	$("#billing_email").val("<?php echo $current_user->user_email; ?>");
	$("#billing_email").text("<?php echo $current_user->user_email; ?>");
	$("#billing_email").hide();
	$("#billing_email_field").hide();
	// Hide the admin bar to show the #show-hide-billing button 
	$("#wpadminbar").hide();
	$("#showhidebtn").click(function(){
		if($(".col-1").is(":visible"))
		{
			$(".col-1").hide(1000).slideUp();
		}
		else
		{
			$(".col-1").show(1000).slideDown();
		}
	});
	
	<?php
	if($_POST['customer-id'] and $_POST['customer-id'] != 1)
	{
		$user_id = $_POST['customer-id'];
		echo '	
				$("#billing_first_name").val("'.get_user_meta( $user_id, 'billing_first_name', true).'");
				$("#billing_last_name").val("'.get_user_meta( $user_id, 'billing_last_name', true).'");
				$("#billing_company").val("'.get_user_meta( $user_id, 'billing_company', true).'");
				$("#billing_address_1").val("'.get_user_meta( $user_id, 'billing_address_1', true).'");
				$("#billing_address_2").val("'.get_user_meta( $user_id, 'billing_address_2', true).'");
				$("#billing_city").val("'.get_user_meta( $user_id, 'billing_city', true).'");
				$("#billing_postcode").val("'.get_user_meta( $user_id, 'billing_postcode', true).'");
				$("#billing_state").val("'.get_user_meta( $user_id, 'billing_state', true).'");
				$("#billing_country").val("US");
				$("#billing_phone").val("'.get_user_meta( $user_id, 'billing_phone', true).'");';
	 }
	 else if($_POST['customer-id'] == 1)
	 {
		echo '  $("#billing_first_name").val("");
				$("#billing_last_name").val("");
				$("#billing_company").val("");
				$("#billing_address_1").val("");
				$("#billing_address_2").val("");
				$("#billing_city").val("");
				$("#billing_postcode").val("");
				$("#billing_state").val("");
				$("#billing_country").val("US");
				$("#billing_phone").val("");';
	}
	?>
});
</script>
<head> 
    <title>Cellular Angel POS</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
<body> 

<div data-role="page">
 
<div id="checkout-wrapper">
	<div id="showhidebtn"><button id="show-hide-billing" data-role="button">show/hide Billing</button></div>
<?php




$siteurl = get_site_url();
//$siteurl = $siteurl;

// empty cart 
$woocommerce->cart->empty_cart();

// fill it up with order
$json_cart = $_POST['jsoncart'];
$json_cart = str_replace("\\", "", $json_cart);
$m_cart = json_decode($json_cart, true);
if($json_cart != '')
{
foreach ($m_cart as $key => $value) 
{
	if($key > 0){
		for($i = 0; $i < $value; $i++)
		{
			$woocommerce->cart->add_to_cart($key);
	    }
	}
}
// logic to set sales order true to log commissions and for other reasons
// you might want to check if someone is doing a sales order
$paying_user = wp_get_current_user();
$referrer = get_userdata($paying_user->referrer);	


echo do_shortcode('[woocommerce_checkout]');
update_user_meta($paying_user->ID, 'sales-order', true);


include '../woocommerce/woocommerce.php'; 
$woocommerce->frontend_scripts();

?>
</div>
</div>
</body>
<script type='text/javascript' src='./js/brainchild-checkout.js'></script>
<script type='text/javascript' src='<?php echo $siteurl;?>/wp-content/plugins/woocommerce/assets/js/jquery-plugins.min.js?ver=1.6.5.2'></script>
<script type='text/javascript' src='<?php echo $siteurl;?>/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=1.6.5.2'></script>
<?php wp_footer();
}
else{
echo '<h2 style="margin:0 auto;"> No items in cart</h2>';
}?>