<?php
/* Define the custom box */

/* Adds a box to the main column on the Post and Page edit screens */
function BC_add_featured_box() {
    add_meta_box( 
        'BC_featured_box',
        __( 'Point of Sale Featured Items', 'BC_featured_box_title' ),
        'BC_inner_featured_box',
        'product', 
		'normal',
		'high'
    );
}

/* Prints the box content */
function BC_inner_featured_box( $post ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'BC_featured_nonce' );
	$product_meta = get_post_meta($post->ID, 'pos-feature', true);
    if($product_meta == 'true')
	{
		echo '<input type="radio" name="feature" value="true" checked>&nbsp;Feature Product on Point of Sales<br>';
		echo '<input type="radio" name="feature" value="false">&nbsp;Do Not Feature on Point of Sales<br>';
	}
	else
	{
		echo '<input type="radio" name="feature" value="true">&nbsp;Feature Product on Point of Sales<br>';
		echo '<input type="radio" name="feature" value="false" checked>&nbsp;Do Not Feature on Point of Sales<br>';
	}

}

/* When the post is saved, saves our custom data */
function BC_save_featured_postdata( $post_id ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	  return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !wp_verify_nonce( $_POST['BC_featured_nonce'], plugin_basename( __FILE__ ) ) )
	  return;


	// Check permissions
	if ( 'page' == $_POST['post_type'] ) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) )
			return;
	}
	else
	{
		if ( !current_user_can( 'edit_post', $post_id ) )
			return;
	}
	

	update_post_meta($post_id, 'pos-feature', $_POST['feature']);
	
}
?>