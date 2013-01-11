<?php

function pos_form() {
	global $woocommerce;
	$siteurl = get_site_url();
	$plugin_name = "Brain-Child-POS";
	$current_user = wp_get_current_user();
	$current_customer_text = 'New Customer';
	$current_customer_ID;

	// So we can use plugin_url to get to the plugin directory
	$file = dirname( __FILE__ ) . '/pos.php';
	$plugin_url = plugin_dir_url( $file );
	$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');

	if($current_user->ID != 0)
	{
		if(user_can($current_user->ID, 'salesperson') or user_can($current_user->ID, 'shop_manager') or user_can($current_user->ID, 'salesmanager') or user_can($current_user->ID, 'administrator'))
		{
			if($isiPad)
				include 'site-view.php';
			if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) 
			{
        			include 'mobile-view.php';
    			}
    			else
    			{
				include 'site-view.php';
			}
		}
		else	
			echo '<h2> You do not have permissions to access this page.<br /> Plaese contact your site admin. </h2>';
	}
	else
		wp_login_form();
}
?>
