<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
		  <ul>
		    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		      <a itemprop="item" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		        <span itemprop="name">Trang Chủ <?php bloginfo( 'name' ); ?></span>
		      </a>
		      <meta itemprop="position" content="1">
		    </li>
		    <?php
		    $postcat = get_the_category( $post->ID );
		    $bcpos = 2;
        if ( ! empty( $postcat ) ) : ?>
		    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		      <a itemprop="item" href="<?php echo esc_url( home_url( '/' ) ).$postcat[0]->slug; ?>">
		        <span itemprop="name"><?php echo $postcat[0]->name; ?></span>
		      </a>
		      <meta itemprop="position" content="<?php echo $bcpos; ?>">
		    </li>
		    <?php $bcpos++; endif; ?>
		    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		      <span itemprop="name"><?php the_title(); ?></span>
		      <meta itemprop="position" content="<?php echo $bcpos; ?>">
		    </li>
		  </ul>
		</div>
		
		<main id="main" class="site-main" role="main">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;
			?>
			
			<?php
		    $op_relate = get_post_meta($post->ID, 'op_relate', true);
		    $category_current = get_category_by_slug('don-hang');
		    if(!empty($op_relate)){
	        $args = array(      
            'post_type'   => 'post',
            's'           => $op_relate,
            'post_status' => 'publish',
            'numberposts' => 8,
            'post__not_in' => array( $post->ID ),
            'category__not_in' => $category_current->term_id
          );
          $wp_query = new WP_Query($args);
          if($wp_query->post_count > 0){
          	echo '<h2 class="page-title">Sản phẩm liên quan</h2><div class="op-list">';
          	while ( $wp_query->have_posts() ) : $wp_query->the_post();
	      			get_template_part( 'content', get_post_format() );
	      		endwhile;
	      		echo '</div>';
          }
		    }
			?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
