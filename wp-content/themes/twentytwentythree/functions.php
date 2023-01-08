<?php 

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

 ?>