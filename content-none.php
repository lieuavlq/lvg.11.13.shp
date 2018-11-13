<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Không tìm thấy gì cả!!', 'lvgames_shop' ); ?></h1>
	</header><!-- .page-header -->

	<div class="entry-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Hem có bài nào? <a href="%1$s">Bắt đầu nào!!</a>.', 'lvgames_shop' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else: ?>

			<div class="op-sc-wrap">
				<p><?php _e( 'Thử lại với cụm từ mới xem sao.', 'lvgames_shop' ); ?></p>
				<?php echo do_shortcode('[ivory-search id="99" title="Default Search Form"]'); ?>
			</div>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
