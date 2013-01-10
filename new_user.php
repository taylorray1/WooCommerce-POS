<?php
/* 
     * @author: The BrainChild Design
     * Desc: Creates new wordpress user for Brainchild Design POS
     * Creates new users as customers, auto generates passwords,
     * and updates their shipping/billing information.
*/

$wpbh = './../../../wp-blog-header.php';
if ( file_exists( $wpbh ) ) {
    require $wpbh;
}

//if (current_user_can('add_users')) {

    /* Array For WordPress User Creation */
    $user_data = array(
        'user_pass' => wp_generate_password(),
        'user_login' => $_POST['username'],
        'user_url' => $_POST['website'],
        'user_email' => $_POST['email'],
        'first_name' => $_POST['fname'],
        'last_name' => $_POST['lname'],
        'company' => $_POST['company'],
        'website' => $_POST['website'],
        'role' => 'customer'
    );

    /* Add New User to DB */
    $user_id = wp_insert_user( $user_data );
    add_user_meta($user_id, 'billing_first_name', $_POST['fname']);
    add_user_meta($user_id, 'billing_last_name', $_POST['lname']);
    add_user_meta($user_id, 'billing_company', $_POST['company']);
    add_user_meta($user_id, 'billing_address_1', $_POST['address']);
    add_user_meta($user_id, 'billing_city', $_POST['city']);
    add_user_meta($user_id, 'billing_postcode', $_POST['zip']);
    add_user_meta($user_id, 'billing_state', $_POST['state']);
    add_user_meta($user_id, 'billing_country', $_POST['country']);
    add_user_meta($user_id, 'billing_email', $_POST['email']);
    add_user_meta($user_id, 'billing_phone', $_POST['phone']);

	/* If Different Shipping Information */
    if($_POST['dsa'] == 'no') {
        add_user_meta($user_id, 'shipping_first_name', $_POST['shippingfname']);
        add_user_meta($user_id, 'shipping_last_name', $_POST['shippinglname']);
        add_user_meta($user_id, 'shipping_company', $_POST['shippingcompany']);
        add_user_meta($user_id, 'shipping_address_1', $_POST['shippingaddress']);
        add_user_meta($user_id, 'shipping_city', $_POST['shippingcity']);
        add_user_meta($user_id, 'shipping_postcode', $_POST['shippingzip']);
        add_user_meta($user_id, 'shipping_state', $_POST['shippingstate']);
        add_user_meta($user_id, 'shipping_country', $_POST['shippingcountry']);
    
	/* If Same Shipping, use same from billing */
	} else {
        add_user_meta($user_id, 'shipping_first_name', $_POST['fname']);
        add_user_meta($user_id, 'shipping_last_name', $_POST['lname']);
        add_user_meta($user_id, 'shipping_company', $_POST['company']);
        add_user_meta($user_id, 'shipping_address_1', $_POST['address']);
        add_user_meta($user_id, 'shipping_city', $_POST['city']);
        add_user_meta($user_id, 'shipping_postcode', $_POST['zip']);
        add_user_meta($user_id, 'shipping_state', $_POST['state']);
        add_user_meta($user_id, 'shipping_country', $_POST['country']);
    }

	/* Returns The user ID For JS */

	$return = json_encode($user_id);
    echo $return;

//} else {
    // If not logged In/Cant create users

	//$current_user = wp_get_current_user();
	//if ( $current_user->ID == 0 ) {
	//	echo 'Login to access';
	//} else {
	//	echo 'Unable to create user';
	//}

	
//}

?>