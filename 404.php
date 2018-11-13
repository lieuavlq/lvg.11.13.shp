<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Không có trang này rùi!.', 'lvgames_shop' ); ?></h1>
				</header><!-- .page-header -->

				<div class="entry-content">
					<div class="op-sc-wrap">
						<p><?php _e( 'Tìm cái gì khác nhập từ khóa bên dưới kìa!', 'lvgames_shop' ); ?></p>
						<?php echo do_shortcode('[ivory-search id="99" title="Default Search Form"]'); ?>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
