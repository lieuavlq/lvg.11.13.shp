<?php
/**
 * LVGames Shop back compat functionality
 *
 * Prevents LVGames Shop from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */

/**
 * Prevent switching to LVGames Shop on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since LVGames Shop 1.0
 */
function lvgames_shop_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'lvgames_shop_upgrade_notice' );
}
add_action( 'after_switch_theme', 'lvgames_shop_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * LVGames Shop on WordPress versions prior to 4.1.
 *
 * @since LVGames Shop 1.0
 */
function lvgames_shop_upgrade_notice() {
	$message = sprintf( __( 'LVGames Shop requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'lvgames_shop' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 *
 * @since LVGames Shop 1.0
 */
function lvgames_shop_customize() {
	wp_die( sprintf( __( 'LVGames Shop requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'lvgames_shop' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'lvgames_shop_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since LVGames Shop 1.0
 */
function lvgames_shop_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'LVGames Shop requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'lvgames_shop' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'lvgames_shop_preview' );
