<?php
    $op_sku = get_post_meta(get_the_ID(), 'op_sku', true);
    $op_price = get_post_meta(get_the_ID(), 'op_price', true);
    $op_price_promotion = get_post_meta(get_the_ID(), 'op_price_promotion', true);
    $op_description = get_post_meta(get_the_ID(), 'op_description', true);
    $op_relate = get_post_meta(get_the_ID(), 'op_relate', true);
    $post_category = get_the_category( $post->ID );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php lvgames_shop_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

    <?php if($post_category[0]->slug != 'don-hang'): ?>

    <div class="op-price-content<?php if(!empty($op_price_promotion)){ echo ' promotion'; } ?>">
        <span class="op-price"><?php echo change_price($op_price); ?></span>
        <?php if(!empty($op_price_promotion)): ?><span class="op-price-promotion"><?php echo change_price($op_price_promotion); ?></span><?php endif; ?>
    </div>

    <?php endif ?>

	<!-- <div class="entry-summary">
		<?php the_excerpt(); ?>
	</div> --><!-- .entry-summary -->

	<?php if ( 'post' == get_post_type() ) : ?>

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

	<?php else : ?>

		<?php edit_post_link( __( 'Edit', 'lvgames_shop' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

	<?php endif; ?>

</article><!-- #post-## -->
