<?php

	$op_fi_name = $_GET['op_fi_name'];
	$op_fi_phone = $_GET['op_fi_phone'];
	$op_fi_address = $_GET['op_fi_address'];
	$op_fi_email = $_GET['op_fi_email'];
	$op_fi_note = $_GET['op_fi_note'];
  $op_fi_method = $_GET['op_fi_method'];
  $op_fi_number = $_GET['op_fi_number'];
  $op_fi_total = $_GET['op_fi_total'];
  $op_fi_id = $_GET['op_fi_id'];

	if(isset($op_fi_name)) {
    $op_fi_name_esc = esc_html($op_fi_name);
	}

  if(isset($op_fi_phone)) {
    $op_fi_phone_esc = esc_html($op_fi_phone);
  }

  if(isset($op_fi_address)) {
    $op_fi_address_esc = esc_html($op_fi_address);
  }

  if(isset($op_fi_email)) {
    $op_fi_email_esc = esc_html($op_fi_email);
  }

  if(isset($op_fi_note)) {
    $op_fi_note_esc = esc_html($op_fi_note);
  }

  if(isset($op_fi_method)) {
    $op_fi_method_esc = esc_html($op_fi_method);
  }

  if(isset($op_fi_total)) {
    $op_fi_total_esc = esc_html($op_fi_total);
  }

  if(isset($op_fi_id)) {
    $op_fi_id_esc = esc_html($op_fi_id);
  }

  $cart_item_each = '';
  if(isset($op_fi_number)) {
    $op_fi_number_esc = esc_html($op_fi_number);
    for($i=1; $i<=(int)$op_fi_number_esc; $i++){
      if(isset($_GET['op_fi_item'.$i])) {
        $cart_item_each .= esc_html($_GET['op_fi_item'.$i]).'<br>';
      }
    }
  }

  $content_current = '';
  $content_current .= '<h3>THÔNG TIN NHẬN HÀNG</h3>';
  $content_current .= '<p>Họ và tên: '.$op_fi_name_esc.'<br>';
  $content_current .= 'Số điện thoại: '.$op_fi_phone_esc.'<br>';
  $content_current .= 'Địa chỉ: '.$op_fi_address_esc.'<br>';
  $content_current .= 'Email: '.$op_fi_email_esc.'<br>';
  $content_current .= 'Ghi chú: '.$op_fi_note_esc.'<br>';

  if($op_fi_method_esc != 'mt1'){
    $paywithbank = 'Trả qua ngân hàng<br><a href="/lien-he#thong-tin-chuyen-khoan" target="_blank">>> Coi thông tin chuyển khoản</a>';
  }else{
    $paywithbank = 'Trả khi nhận hàng';
  }

  $content_current .= 'Phướng thức thanh toán: '.$paywithbank.'</p>';
  $content_current .= '<h3>CHI TIẾT ĐƠN HÀNG</h3>';
  $content_current .= '<p>'.$cart_item_each.'</p>';
  $content_current .= '<p>Tổng tiền đơn hàng: '.$op_fi_total_esc.'</p>';

  $item_status = 'publish';

  $new_content = apply_filters( 'the_content', html_entity_decode( $content_current ) );

  // insert post
  $post = array(
    'post_title' => $op_fi_id_esc,
    'post_status' => $item_status,
    'post_content' => $new_content,
    'post_type' => 'post'
  );
  $post_id = wp_insert_post( $post, true );

  add_post_meta($post_id, 'op_status', 'Vừa nhận...', true);
  add_post_meta($post_id, 'op_meta_name', $op_fi_name_esc, true);
  add_post_meta($post_id, 'op_meta_phone', $op_fi_phone_esc, true);
  add_post_meta($post_id, 'op_meta_address', $op_fi_address_esc, true);
  add_post_meta($post_id, 'op_meta_email', $op_fi_email_esc, true);
  add_post_meta($post_id, 'op_meta_note', $op_fi_note_esc, true);

  $item_category_txt = 'Đơn hàng';
  $item_category = term_exists( $item_category_txt, 'category' );
  wp_set_object_terms( $post_id, (int)$item_category['term_id'], 'category' );

?>