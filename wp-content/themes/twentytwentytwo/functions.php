<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */
/*
function check_custom_field_requirement($post_id) {
	
   // echo $post_id;
    $repeater_value = get_field("import");
    if(!$repeater_value)
    	return;
   // var_dump($repeater_value);
   // wp_die();
    foreach ($repeater_value as $row_value) {
    	$ID = $row_value["book_name"];
    	$amount = (int)$row_value["book_count"];
    //	echo $ID .' ' .$amount;
    	
    	$currentAmount = get_field("amount",$ID);
    //	var_dump($currentAmount);
    	update_field("amount",$currentAmount+$amount,$ID);
    }
   // wp_die();
}
add_action('save_post_inputbook', 'check_custom_field_requirement',100,1);*/

function updateBook($post_id) {
	if(get_post_type($post_id)!='inputbook')
		return;
     // echo $post_id;
    $repeater_value = get_field("import");
    if(!$repeater_value)
    	return;
   // var_dump($repeater_value);
   // wp_die();
    foreach ($repeater_value as $row_value) {
    	$ID = $row_value["book_name"];
    	$amount = (int)$row_value["book_count"];
    //	echo $ID .' ' .$amount;
    	
    	$currentAmount = get_field("amount",$ID);
    //	var_dump($currentAmount);
    	update_field("amount",$currentAmount+$amount,$ID);
    }
   // wp_die();
}
add_action('wp_after_insert_post', 'updateBook');


function getReceipt($post_id) {
	if(get_post_type($post_id)!='receipt')
		return;
     // echo $post_id;
    $repeater_value = get_field("orderBooks");
    if(!$repeater_value)
    	return;
   // var_dump($repeater_value);
   // wp_die();
    $totalPrice = 0 ;
    foreach ($repeater_value as $row_value) {
    	$ID = $row_value["book_name"];
    	$amount = (int)$row_value["book_amount"];
    	$currentAmount = get_field("amount",$ID);
    	$amount = (int) min($amount,$currentAmount);
    	$price = $row_value["book_price"];
    	$totalPrice += $price*$amount;
    //	var_dump($currentAmount);
    	update_field("amount",$currentAmount-$amount,$ID);
    }
    update_field("total_price",$totalPrice,$post_id);
   // wp_die();
}
add_action('wp_after_insert_post', 'getReceipt');

// add pdf print support to post type ‘product’
if(function_exists('set_pdf_print_support')) {
set_pdf_print_support(array('post', 'page', 'product','book','inputbook','receipt'));
}

if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';
