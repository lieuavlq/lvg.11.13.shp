<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Kết quả của: "%s"', 'lvgames_shop' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<div class="entry-content">
				<div class="op-sc-wrap">
	        <h3 class="op-success-id">XEM KẾT QUẢ BÊN DƯỚI</h3>
	        <p><?php _e( 'Hoặc nhập lại cái khác nào!!.', 'lvgames_shop' ); ?></p>
	        <?php echo do_shortcode('[ivory-search id="99" title="Default Search Form"]'); ?>
		    </div>
	    </div>

			<div class="op-list">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );

			// End the loop.
			endwhile; ?>

			</div>

			<?php // Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Trang trước', 'lvgames_shop' ),
				'next_text'          => __( 'Trang kế', 'lvgames_shop' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Trang', 'lvgames_shop' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
