<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<?php if(is_front_page() && is_home()): ?>
<meta name="description" content="<?php bloginfo( 'name' ); ?> Có Ốp lưng dẻo, Ốp lưng cường lực, Áo phong, Áo thun, ... nhiều thứ lắm đó.">
<?php endif; ?>
<?php if(is_single()): ?>
<meta name="description" content="<?php echo esc_html(get_the_excerpt()); ?>">
<?php endif; ?>
<?php if(is_single()): ?>
<meta name="keywords" content="<?php $metaKey = esc_html(get_post_meta(get_the_ID(), 'meta_keywords', true)); if($metaKey) echo $metaKey.','; ?>op lung,op cuong luc,op lung deo,op lung dien thoai,op lung tablet,ao thun,ao phong,phu kien du thu">
<?php else: ?>
<meta name="keywords" content="op lung,op cuong luc,op lung deo,op lung dien thoai,op lung tablet,ao thun,ao phong,phu kien du thu">
<?php endif; ?>
<?php if(is_single()): ?>
<meta name="robots" content="index, follow">
<!-- OGP Tag -->
<meta property="og:title" content="<?php echo esc_html(wp_title('&#8211;',false,'right')); bloginfo( 'name' ); ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php echo wp_get_canonical_url(); ?>">
<meta property="og:image" content="<?php the_post_thumbnail_url(); ?>">
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:description" content="<?php echo esc_html(get_the_excerpt()); ?>">
<meta property="og:locale" content="vi_VN">
<!-- /OGP Tag -->
<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@LVGamesDotNet">
<meta name="twitter:title" content="<?php echo esc_html(wp_title('&#8211;',false,'right')); bloginfo( 'name' ); ?>">
<meta name="twitter:description" content="<?php echo esc_html(get_the_excerpt()); ?>">
<meta name="twitter:image" content="<?php the_post_thumbnail_url(); ?>">
<!-- /Twitter Card -->
<?php endif; ?>
<link rel="apple-touch-icon" sizes="180x180" href="http://lvgames.net/icon.png">
<link rel="apple-touch-icon-precomposed" href="http://lvgames.net/icon.png">
<link rel="shortcut icon" href="http://lvgames.net/icon.png">
<link rel="icon" sizes="192x192" href="http://lvgames.net/icon.png">
<link rel="shortcut icon" href="http://lvgames.net/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="icon" href="http://lvgames.net/favicon.ico" type="image/vnd.microsoft.icon">
<meta name="author" content="LVGAMES.NET">
<!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrap-video-popup"></div>
<div id="page" class="hfeed site<?php if(is_page('tien-hanh-dat-hang')) echo ' op-page-tien-hanh-dat-hang'; ?>">
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
				lvgames_shop_the_custom_logo();

				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif;
			?>
			<span class="btn-menu only-sp">Menu</span>
		</div><!-- .site-branding -->
		<div class="op-cart"><a href="<?php echo esc_url( home_url( '/gio-hang' ) ); ?>" title="Xem giỏ hàng cái nào!">Giỏ hàng <span class="op-cart-count">0</span></a></div>
		<?php if ( has_nav_menu( 'top' ) ) : ?>
		<nav id="top-navigation" class="top-navigation" role="navigation">
			<?php
				// Top links navigation menu.
				wp_nav_menu( array(
					'theme_location' => 'top',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			?>
			<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
			<div id="widget-area5" class="widget-area only-sp" role="complementary">
				<?php dynamic_sidebar( 'sidebar-5' ); ?>
			</div><!-- .widget-area -->
    		<?php endif; ?>
		</nav><!-- .top-navigation -->
		<?php endif; ?>

		<?php if ( is_front_page() && is_home() ) : ?>
			<?php if ( has_nav_menu( 'product' ) ) : ?>
			<nav id="product-navigation" class="product-navigation" role="navigation">
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
		<?php endif; ?>
	</header><!-- .site-header -->

	<div id="content" class="site-content">
