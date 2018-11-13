<?php
	$op_sku = get_post_meta(get_the_ID(), 'op_sku', true);
	$op_price = get_post_meta(get_the_ID(), 'op_price', true);
	$op_price_promotion = get_post_meta(get_the_ID(), 'op_price_promotion', true);
	$op_description = get_post_meta(get_the_ID(), 'op_description', true);
	$op_relate = get_post_meta(get_the_ID(), 'op_relate', true);
	$post_category = get_the_category( get_the_ID() );
	$op_status = get_post_meta(get_the_ID(), 'op_status', true);
	$op_status_current = get_post_meta(get_the_ID(), 'op_status_current', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		lvgames_shop_post_thumbnail();
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<?php if($post_category[0]->slug != 'don-hang'): ?>
	<div class="op-price-content<?php if(!empty($op_price_promotion)){ echo ' promotion'; } ?>">
		<span class="op-price"><?php echo change_price($op_price); ?></span>
		<?php if(!empty($op_price_promotion)): ?><span class="op-price-promotion"><?php echo change_price($op_price_promotion); ?></span><?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if(is_single()): ?>

	<?php if($post_category[0]->slug != 'don-hang'): ?>
	<div class="op-info">
		<?php
		if(!empty($op_sku)){ echo '<div class="op-info-sku" data-sku="'.$op_sku.'">Mã SP: '.$op_sku.'</div>'; }
		if(!empty($op_description)){ echo '<div class="op-info-desc">'.apply_filters( 'the_content', html_entity_decode( $op_description ) ).'</div>'; }
		?>
	</div>

	<div class="op-basic">
		<p class="op-basic-ship">Giao hàng tiêu chuẩn Dự kiến giao sau 1 hoặc 2 ngày (không tính ngày Chủ nhật hoặc ngày Lễ), Miễn phí giao hàng</p>
		<p class="op-basic-credit">Trả tiền sau khi nhận hàng hoặc chuyển tiền qua ngân hàng - <a href="<?php echo esc_url( home_url( '/lien-he#thong-tin-chuyen-khoan' ) ); ?>" target="_blank">Xem chi tiết</a></p>
	</div>

	<?php if($post_category[0]->slug === 'op-lung'): ?>
	<div class="op-select">
		<div id="tags-wrap" class="ui-widget">
		  <label for="tags">Nhập Thiết bị bạn muốn mua cho: </label><br>
		  <span class="op-select-input-wrap"><input id="tags" placeholder='Thí dụ như "iphone 6s"'><i>x</i></span>
		</div>
	</div>
	<div class="op-select-uvg">
		<p>Có hỗ trợ Ốp lưng Cường Lực.<br>Giá Ốp Cường Lực + 50k.</p>
		<p class="op-select-uvg-btn"><input type="checkbox" id="tags-uvg" class="op-select-input-checkbox"><label for="tags-uvg">Chọn mua Ốp Cường Lực</label></p>
	</div>
	<div class="op-select-uvg1">
		<p>Không hỗ trợ Ốp lưng Cường Lực.</p>
	</div>
	<?php else: ?>
	  <input id="tags" type="hidden" value="<?php echo $post_category[0]->name; ?>">
	<?php endif; ?>

	<div class="op-number">
		<p>Mua bao nhiu cái nè:</p>
		<div class="op-number-inner"><span class="op-number-down">-</span><input type="text" value="1" disabled><span class="op-number-up">+</span></div>
	</div>

	<div class="op-btn">
		<span class="op-btn-add">Bỏ vô giỏ nè</span>
	</div>

	<div class="op-div"></div>

	<input type="hidden" value="<?php if(!empty($op_price_promotion)){ echo $op_price_promotion; }else{ echo $op_price; } ?>" class="iphidden-price">
	<input type="hidden" value="<?php echo get_the_permalink(); ?>" class="iphidden-url">

	<?php endif; ?>

	<div class="entry-content">
		<?php if($post_category[0]->slug == 'don-hang'): ?>
			<h3>ĐƠN HÀNG TỚI ĐÂU RÙI</h3>
			<p>Tình trạng: <span class="op-status-clr"><?php if(!empty($op_status_current)){ echo $op_status_current; }else{ echo $op_status; } ?></span></p>
		<?php endif; ?>

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
	</div><!-- .entry-content -->

	<?php if($post_category[0]->slug == 'don-hang'): ?>
		<div class="op-chat-fb">
			<p>Hãy COPY và Gửi Mã Đơn Hàng lên Facebook Chat để tiện hỏi thăm hoặc lưu lại khỏi phải tìm kiếm.</p>
			<p><a href="https://www.facebook.com/messages/t/LVGamesDotNet" target="_blank">>> Gửi Mã Đơn Hàng</a></p>
		</div>
	<?php endif; ?>

	<?php endif; ?>
	
	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php lvgames_shop_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'lvgames_shop' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
