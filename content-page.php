<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage LVGames_Shop
 * @since LVGames Shop 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		lvgames_shop_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 

			if(is_page('tien-hanh-dat-hang')): ?>

				<div class="op-order-loading"><div><img src="/img/ico_loading.gif" alt=""><br>Đang đặt hàng đợi xíu!!</div></div>

				<p><sup class="sup-note">*</sup> Hãy nhập thông tin bên dưới CHÍNH XÁC NHẤT CÓ THỂ để chúng tôi tiện Liên lạc và Giao hàng.</p>
				<h3 class="op-cart-progress-page-h3">Nhập Thông Tin Giao Hàng</h3>
				<div class="op-form-info">
					<div class="op-form-info-col">
						<dl>
							<dt>Họ và tên <sup>*</sup></dt>
							<dd><input type="text" name="" placeholder='Thí dụ "Trần Văn An"' class="op-form-info-name"></dd>
						</dl>
						<dl>
							<dt>Số điện thoại <sup>*</sup></dt>
							<dd><input type="tel" name="" placeholder='Thí dụ "084154154"' class="op-form-info-phone"></dd>
						</dl>
						<dl>
							<dt>Địa chỉ nhận hàng <sup>*</sup></dt>
							<dd><textarea name="" placeholder='Thí dụ "775 Điện Biên Phủ, P.12, Q. Bình Thạnh, HCM"' class="op-form-info-address"></textarea></dd>
						</dl>
						<dl>
							<dt>Email</dt>
							<dd><input type="email" name="" placeholder='Thí dụ "tranvanan@gmail.com"' class="op-form-info-email"></dd>
						</dl>
						<dl>
							<dt>Ghi chú thêm về giao nhận hàng</dt>
							<dd><textarea name="" placeholder='Thí dụ "Nhà tôi đối diện với trụ sở công an phường."' class="op-form-info-note"></textarea></dd>
						</dl>
					</div>
					<div class="op-form-info-col">
						<dl>
							<dt>Chọn cách thanh toán</dt>
							<dd><label><input type="radio" name="op-form-info-method" value="mt1" checked><span>Nhận hàng trả tiền</span></label><br><label><input type="radio" name="op-form-info-method" value="mt2"><span>Chuyển tiền qua ngân hàng <a href="/lien-he#thong-tin-chuyen-khoan" target="_blank">>> Coi số tài khoản</a></span></label></dd>
						</dl>
						<dl>
							<dt>Thông tin cần biết</dt>
							<dd>Giao hàng tiêu chuẩn Dự kiến giao sau 1 hoặc 2 ngày (không tính ngày Chủ nhật hoặc ngày Lễ), Miễn phí giao hàng</dd>
						</dl>
						<div class="op-form-info-btn">
							<span>Đặt hàng</span>
						</div>
					</div>
				</div>

			<?php endif; ?>

			<?php if(is_page('gio-hang')){
				echo '<div id="op-cart" class="op-cart-page"></div>';
			}else{
				if(is_page('tien-hanh-dat-hang')){
					echo '<div id="op-cart" class="op-cart-progress-page"></div>';
				}
			}
		?>

		<?php	if(is_page('dat-hang-thanh-cong')): ?>
			<div class="op-sc-wrap">
				<h3 class="op-success-id">ĐƠN HÀNG: <span>#</span></h3>
				<p><?php _e( 'Hãy nhập Mã đơn hàng bên dưới để tiện kiểm tra!!.', 'lvgames_shop' ); ?></p>
				<?php echo do_shortcode('[ivory-search id="103" title="search_bill_num"]'); ?>
				<div class="op-chat-fb">
					<p>Hãy COPY và Gửi Mã Đơn Hàng lên Facebook Chat để tiện hỏi thăm hoặc lưu lại khỏi phải tìm kiếm.</p>
					<p><a href="https://www.facebook.com/messages/t/LVGamesDotNet" target="_blank">>> Gửi Mã Đơn Hàng</a></p>
				</div>
			</div>
		<?php endif; ?>

		<?php	if(is_page('kiem-tra-don-hang')): ?>
			<div class="op-sc-wrap">
				<h3 class="op-success-id">ĐƠN HÀNG GẦN ĐÂY: <span>#</span></h3>
				<p><?php _e( 'Hãy nhập Mã đơn hàng bên dưới để tiện kiểm tra!!.', 'lvgames_shop' ); ?></p>
				<?php echo do_shortcode('[ivory-search id="103" title="search_bill_num"]'); ?>
				<div class="op-chat-fb">
					<p>Hãy COPY và Gửi Mã Đơn Hàng lên Facebook Chat để tiện hỏi thăm hoặc lưu lại khỏi phải tìm kiếm.</p>
					<p><a href="https://www.facebook.com/messages/t/LVGamesDotNet" target="_blank">>> Gửi Mã Đơn Hàng</a></p>
				</div>
			</div>
		<?php endif; ?>

		<?php	if(is_page('tim-kiem-san-pham')): ?>
			<div class="op-sc-wrap">
				<h3 class="op-success-id">HÃY NHẬP TÊN SẢN PHẨM CẦN TÌM</h3>
				<p><?php _e( 'Ví dụ như "Murad Siêu Việt".', 'lvgames_shop' ); ?></p>
				<?php echo do_shortcode('[ivory-search id="99" title="Default Search Form"]'); ?>
			</div>
		<?php endif; ?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Các trang:', 'lvgames_shop' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Trang', 'lvgames_shop' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
		<?php if(is_page('gio-hang')) echo '<div class="op-cart-btn"></div>'; ?>
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'lvgames_shop' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
