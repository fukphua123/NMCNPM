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
	  $termsAuthor = get_the_terms( $post->ID, 'book-author' );
	   echo "<h4>" . 'Tác giả: ';

        foreach ( $termsAuthor as $term ) {
            echo $term->name .' ';
        }

        echo "</h4>";
        echo "<h4>" . 'Category: ';
     $termsCategory = get_the_terms( $post->ID, 'book-category' );
      foreach ( $termsCategory as $term ) {
            echo $term->name.' ';
        }
 echo "</h4>";
        echo "</span>";
	$amount = get_field("amount");
	$price = get_field("price");
    echo '<h4> Số lượng: '.$amount.'</h4>';
     if($amount>0)
     {
     	 echo '<h4> Giá tiền: '.$price.'</h4>';
     }

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
