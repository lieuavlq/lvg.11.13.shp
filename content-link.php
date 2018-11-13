<?php
/**
 * The template for displaying link post formats
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php lvgames_shop_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( sprintf( '<h1 class="entry-title"><a href="%s">', esc_url( lvgames_shop_get_link_url() ) ), '</a></h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( lvgames_shop_get_link_url() ) ), '</a></h2>' );
			endif;
		?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Đọc tiếp %s', 'lvgames_shop' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Các trang:', 'lvgames_shop' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Trang', 'lvgames_shop' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div>
	<!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php
		$postcat = get_the_category( $post->ID );
		if(!empty($postcat)) : ?>
		<span class="posted-cat">
			<span class="screen-reader-text">Chuyên mục </span>
			<a href="<?php echo esc_url( home_url( '/' ) ).$postcat[0]->slug; ?>" rel="category tag"><?php echo $postcat[0]->name; ?></a>
		</span>
		<?php endif; ?>
		<?php lvgames_shop_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'lvgames_shop' ), '<span class="edit-link">', '</span>' ); ?>
		<?php if(!is_single()): ?>
		<span class="rdmore"><a href="<?php the_permalink(); ?>">Xem tiếp...</a></span>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
	<!-- .entry-footer -->

</article><!-- #post-## -->
