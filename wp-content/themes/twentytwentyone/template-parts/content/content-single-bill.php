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
	  $name = get_field("name");
	  $address = get_field("address");
	  $telephone = get_field("telephone");
	  $email = get_field("email");
	  $bill_date = get_field("bill_date");
	  $bill_money = get_field("bill_money");
	  echo "<h4> Tên khách hàng: ".$name."</h4>";
	  echo "<h4> Địa chỉ: ".$address."</h4>";
	  echo "<h4> Điện thoại: ".$telephone."</h4>";
	  echo "<h4> Email: ".$email."</h4>";
	  echo "<h4> Ngày thu tiền: ".$bill_date."</h4>";
	  echo "<h4> Số tiền thu: ".$bill_money."</h4>";
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
