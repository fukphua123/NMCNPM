<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twenty_twenty_one_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
	     $date = get_field( 'date');
	     $username = get_field( 'username');
	     $orderBooks = get_field( 'orderBooks');
	      foreach ($orderBooks as $row_value) {
    	$ID = $row_value["book_name"];
    	$amount = (int)$row_value["book_amount"];
    	$price = (int)$row_value["book_price"];
        echo "<h4>Tên sách: ". get_the_title($ID) .", Số lượng: ".$amount .", Đơn giá: ".$price."</h4>";
    }
    $totalPrice = get_field('total_price');
    if($totalPrice>0){
    	echo "<h4>Tổng tiền: ".$totalPrice."</h4>";
    }
		?>
    }
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
