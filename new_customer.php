<?php

function new_customer($order_id)
{
	//echo 'checking if ' . $_POST['billing_email']. ' exitsts';
	if(email_exists($_POST['billing_email']) == false)
	{
		 /* Array For WordPress User Creation */
	    $user_data = array(
	        'user_pass' => wp_generate_password(),
	        'user_login' => $_POST['billing_email'],
	        'user_email' => $_POST['billing_email'],
	        'first_name' => $_POST['billing_first_name'],
	        'last_name' => $_POST['billing_last_name'],
	        'company' => $_POST['billing_company'],
	        'role' => 'customer'
	    );

	    /* Add New User to DB */
	    $user_id = wp_insert_user( $user_data );
	    $current_user = wp_get_current_user();
	    add_user_meta($user_id, 'billing_first_name', $_POST['billing_first_name']);
	    add_user_meta($user_id, 'billing_last_name', $_POST['billing_last_name']);
	    add_user_meta($user_id, 'billing_company', $_POST['billing_company']);
	    add_user_meta($user_id, 'billing_address_1', $_POST['billing_address_1']);
	    add_user_meta($user_id, 'billing_city', $_POST['billing_city']);
	    add_user_meta($user_id, 'billing_postcode', $_POST['billing_postcode']);
	    add_user_meta($user_id, 'billing_state', $_POST['billing_state']);
	    add_user_meta($user_id, 'billing_country', $_POST['billing_country']);
	    add_user_meta($user_id, 'billing_email', $_POST['billing_email']);
	    add_user_meta($user_id, 'billing_phone', $_POST['billing_phone']);
	    update_usermeta( $user_id, 'referrer', $current_user->ID);
	}
}
?>