<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */
?>

		<div id="main-sidebar" class="main-sidebar">
			<?php get_sidebar(); ?>
		</div><!-- .sidebar -->
	</div><!-- .site-content -->
</div><!-- .site -->

<?php if ( has_nav_menu( 'product' ) ) : ?>
<nav id="product-navigation-bottom" class="product-navigation-bottom" role="navigation">
	<?php
		// Top links navigation menu.
		wp_nav_menu( array(
			'theme_location' => 'product',
			'depth'          => 1,
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		) );
	?>
</nav><!-- .product-navigation -->
<?php endif; ?>

<div class="op-cart"><a href="<?php echo esc_url( home_url( '/gio-hang' ) ); ?>" title="Xem giỏ hàng cái nào!">Giỏ hàng <span class="op-cart-count">0</span></a></div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<?php
			/**
			 * Fires before the LVGames Shop footer text for footer customization.
			 *
			 * @since LVGames Shop 1.0
			 */
			do_action( 'lvgames_shop_credits' );
		?>
		<?php
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
		}
		?>LVGAMES #SHOP &copy; 2018, <a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="imprint"><?php printf( __( '%s', 'lvgames_shop' ), 'Mọi thắc mắc xin liên hệ với chúng tôi.' ); ?></a>
	</div><!-- .site-info -->
</footer><!-- .site-footer -->

<?php wp_footer(); ?>
<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
<div id="widget-area6" class="widget-area op-display-none" role="complementary">
	<?php dynamic_sidebar( 'sidebar-6' ); ?>
</div><!-- .widget-area -->
<?php endif; ?>
</body>
</html>
