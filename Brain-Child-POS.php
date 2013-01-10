<?php

/*
Plugin Name: Brain Child Point of Sale
Plugin URI: http://www.thebrainchilddesign.com/
Description: A Plugin Currently in Devlopment for Brainchild personal use (Point of Sale Application)
Author: Justin Marbutt
Version: 0.1
Author URI: http://www.thebrainchilddesign.com
*/

include 'pos.php';
include 'product-menus.php';
add_shortcode('POS', 'pos_form');
add_action( 'add_meta_boxes', 'BC_add_featured_box' );
/* Do something with the data entered */
add_action( 'save_post', 'BC_save_featured_postdata' );

function BCPOS_addMenu() {
    add_menu_page('Brain Child Point of Sales', 'Point Of Sale', 'remove_users',
        'BC-POS', 'BC_POS_admin_page', null);
}

function BC_POS_admin_page()
{
	echo 'test page';
}

//add_action("admin_menu", "BCPOS_addMenu");
//include 'new_customer.php';
//add_action('woocommerce_checkout_update_order_meta', 'new_customer');

?>
