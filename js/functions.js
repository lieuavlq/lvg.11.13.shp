jQuery(function($){
  $('.op-list .post').matchHeight();

  // COMMOM VAR
  var storage = window.localStorage;
  var op_index_url = 'http://wpshop.localhost';
  var cart_url = "http://wpshop.localhost/gio-hang";
  var op_fi_url = "http://wpshop.localhost/shop-rdt";
  var op_success_url = 'http://wpshop.localhost/dat-hang-thanh-cong';

  // CHECK PAGE
  if($(".op-page-tien-hanh-dat-hang")[0]){
    if(storage.getItem('number_cart_real') === null){
      window.location.href = op_index_url;
    }
  }

  // CHECK CART EXITS
  var get_cart_day_exits = storage.getItem('op_fi_day');
  var get_cur_date = new Date();
  var get_cur_date_by_day = get_cur_date.getDate();
  if(get_cart_day_exits !== null){
    if(get_cur_date_by_day != parseInt(get_cart_day_exits)){
      var get_cart_exits_name = storage.getItem('op_fi_name_str');
      var get_cart_exits_phone = storage.getItem('op_fi_phone_str');
      var get_cart_exits_address = storage.getItem('op_fi_address_str');
      var get_cart_exits_email = storage.getItem('op_fi_email_str');
      var get_cart_exits_note = storage.getItem('op_fi_note_str');
      var get_cart_exits_bill = storage.getItem('lvgnumber1');
      storage.clear();
      storage.setItem('op_fi_name_str', get_cart_exits_name);
      storage.setItem('op_fi_phone_str', get_cart_exits_phone);
      storage.setItem('op_fi_address_str', get_cart_exits_address);
      storage.setItem('op_fi_email_str', get_cart_exits_email);
      storage.setItem('op_fi_note_str', get_cart_exits_note);
      storage.setItem('lvgnumber1', get_cart_exits_bill);
    }
  }

  // UP DOWN QUANTITY
  var op_number_input = $('.op-number input');
  var op_number_down = $('.op-number-down');
  var op_number_up = $('.op-number-up');
  op_number_down.click(function(){
    var inp_val = op_number_input.val();
    if(inp_val > 1) inp_val--;
    op_number_input.val(inp_val);
  });
  op_number_up.click(function(){
    var inp_val = op_number_input.val();
    inp_val++;
    op_number_input.val(inp_val);
  });

  // ADD TO CART
  var op_uvg_price = 50;
  $('.op-btn-add').click(function(){
    var op_title = $('h1.entry-title').text();
    var op_sku = $('.op-info-sku').attr('data-sku');
    var op_devices = $('#tags').val();
    var op_quatity = $('.op-number-inner input').val();
    var op_price_real = $('.iphidden-price').val();
    var op_img = $('.site-main > .post .post-thumbnail img').attr('src');
    var op_url = $('.iphidden-url').val();
    var op_uvg_checked = $('.op-select-input-checkbox');
    var op_price_final = 0;
    var current_d = new Date();
    storage.setItem('op_fi_day', current_d.getDate());

    if(op_devices !== ''){
      if(storage.getItem('opbillnum') === null){ storage.setItem('opbillnum', 0); }
      if(storage.getItem('number_cart_real') === null){ storage.setItem('number_cart_real', 0); }
      var billnum = storage.getItem('opbillnum');
      var number_cart_real_num = storage.getItem('number_cart_real');
      billnum++;
      number_cart_real_num++
      storage.setItem('opbillnum', billnum);
      storage.setItem('number_cart_real', number_cart_real_num);
      storage.setItem('billcurrent_img' + billnum, op_img);
      storage.setItem('billcurrent_title' + billnum, op_title);
      storage.setItem('billcurrent_sku' + billnum, op_sku);
      storage.setItem('billcurrent_devices' + billnum, op_devices);
      if(op_uvg_checked.is(':checked')){
        op_price_final = parseInt(op_price_real) + parseInt(op_uvg_price);
        storage.setItem('billcurrent_uvg' + billnum, '1');
      }else{
        op_price_final = op_price_real;
      }
      storage.setItem('billcurrent_price' + billnum, op_price_final);
      storage.setItem('billcurrent_quatity' + billnum, op_quatity);
      storage.setItem('billcurrent_url' + billnum, op_url);
      window.location.href = cart_url;
    }else{
      check_form_info('Bạn chưa nhập Thiết bị của mình', $( "#tags" ));
    }
  });

  // CART SHOPPING
  var op_cart = $('#op-cart');
  var op_cart_btn = $('.op-cart-btn');
  var op_cart_status = storage.getItem('opbillnum');
  if(op_cart_status !== null){
    if(op_cart.hasClass('op-cart-page')){
      op_cart.append('<p>Dưới đây là thông tin Giỏ hàng của bạn đã chọn, bạn có thể: Xóa sản phẩm, Tiến hành đặt hàng, Coi thêm sản phẩm.</p>');
    }else{
      if(op_cart.hasClass('op-cart-progress-page')){
        op_cart.append('<h3 class="op-cart-progress-page-h3">Chi Tiết Đơn Hàng</h3>');
      }
    }
    op_cart.append('<table class="op-cart-table"></table>');
    op_cart.children('table').append('<tr><th>STT</th><th style="width: 10%">Hình ảnh</th><th style="width: 22%">Tên sản phẩm</th><th style="width: 10%">Mã Sản phẩm</th><th>Loại (x cái)</th><th>Đơn giá</th><th>Thành tiền</th><th>&nbsp;</th></tr>');
    var get_all_store = storage.getItem('opbillnum');
    var run = 1;
    var total_price = 0, item_price_x_quantity = 0;
    var op_devices_uvg = '';
    for(var i=1; i<=get_all_store; i++){
      if(storage.getItem('billcurrent_img' + i) === null){
        get_all_store++;
      }else{
        item_price_x_quantity = parseInt(storage.getItem('billcurrent_price' + i))*parseInt(storage.getItem('billcurrent_quatity' + i));
        total_price += item_price_x_quantity;

        var op_cart_uvg_status = storage.getItem('billcurrent_uvg' + i);
        op_devices_uvg = storage.getItem('billcurrent_devices' + i);
        if(op_cart_uvg_status !== null){
          op_devices_uvg = storage.getItem('billcurrent_devices' + i) + '<br>(Chọn Ốp cường lực)';
        }

        op_cart.children('table').append('<tr><td>'+ run +'</td><td><img src="' + storage.getItem('billcurrent_img' + i) + '" alt=""></td><td><a href="' + storage.getItem('billcurrent_url' + i) + '" title="Coi lại chi tiết sản phẩm này">' + storage.getItem('billcurrent_title' + i) + '</a></td><td>' + storage.getItem('billcurrent_sku' + i) + '</td><td>' + op_devices_uvg + ' x ' + storage.getItem('billcurrent_quatity' + i) + '</td><td>' + change_price(storage.getItem('billcurrent_price' + i)) + '</td><td>' + change_price(item_price_x_quantity) + '</td><td><span class="op-cart-remove-item" data-num="'+ i +'">x</span></td></tr>');
        run++;
      }
    }
    op_cart.children('table').append('<tr><td colspan="5">Tổng tiền giỏ hàng</td><td colspan="2">' + change_price(total_price.toLocaleString()) + '</td><td></td></tr>');
    op_cart_btn.append('<a href="/tien-hanh-dat-hang">Tiến hành đặt hàng</a><a href="/">Coi thêm sản phẩm</a>');
  }else{
    op_cart.append('<p>Hiện trong Giỏ chưa có gì cả tiến hành tìm sản phẩm ưng ý nào!!</p>');
    op_cart_btn.append('<a href="/">Coi thêm sản phẩm</a>');
  }

  if(storage.getItem('opbillnum') === null){ $('.op-cart-count').text('0'); }else{
    $('.op-cart-count').text(storage.getItem('opbillnum'));
  }

  $('.op-cart-remove-item').click(function(){
    var id_current = $(this).attr('data-num');
    var num_current = storage.getItem('opbillnum');
    num_current--;
    if(num_current < 1){
      storage.removeItem('opbillnum');
      storage.removeItem('number_cart_real');
    }else{
      storage.setItem('opbillnum', num_current);
    }
    storage.removeItem('billcurrent_img' + id_current);
    storage.removeItem('billcurrent_title' + id_current);
    storage.removeItem('billcurrent_sku' + id_current);
    storage.removeItem('billcurrent_devices' + id_current);
    storage.removeItem('billcurrent_price' + id_current);
    storage.removeItem('billcurrent_quatity' + id_current);
    window.location.href = cart_url;
  });

  function change_price(val){
    return val + ',000 <sup>đ</sup>';
  }

  // BTN BOOK
  var op_fi_name = $('.op-form-info-name');
  var op_fi_phone = $('.op-form-info-phone');
  var op_fi_address = $('.op-form-info-address');
  var op_fi_email = $('.op-form-info-email');
  var op_fi_note = $('.op-form-info-note');
  var op_fi_method = $('input[name=op-form-info-method]');
  var op_fi_btn = $('.op-form-info-btn span');

  if(storage.getItem('op_fi_name_str') !== null){
    op_fi_name.val(storage.getItem('op_fi_name_str')).addClass('active');
  }
  if(storage.getItem('op_fi_phone_str') !== null){
    op_fi_phone.val(storage.getItem('op_fi_phone_str')).addClass('active');
  }
  if(storage.getItem('op_fi_address_str') !== null){
    op_fi_address.val(storage.getItem('op_fi_address_str')).addClass('active');
  }
  if(storage.getItem('op_fi_email_str') !== null){
    if(storage.getItem('op_fi_email_str') !== ''){
      op_fi_email.val(storage.getItem('op_fi_email_str')).addClass('active');
    }
  }
  if(storage.getItem('op_fi_note_str') !== null){
    if(storage.getItem('op_fi_note_str') !== ''){
      op_fi_note.val(storage.getItem('op_fi_note_str')).addClass('active');
    }
  }

  var op_fi_check = 0;
  op_fi_btn.click(function(){
    if(op_fi_name.val() === ''){
      check_form_info('Vui lòng nhập Họ và tên', op_fi_name);
    }else{
      if(op_fi_phone.val() === ''){
        check_form_info('Vui lòng nhập Số điện thoại', op_fi_phone);
      }else{
        if(!$.isNumeric(op_fi_phone.val())){
          check_form_info('Kiểm tra lại Số điện thoại', op_fi_phone);
        }else{
          if($.trim(op_fi_phone.val()).length != 10){
            check_form_info('Số điện thoại không đúng', op_fi_phone);
          }else{
            if(op_fi_address.val() === ''){
              check_form_info('Vui lòng nhập Địa chỉ nhận hàng', op_fi_address);
            }else{
              if(op_fi_email.val() !== ''){
                if(isEmail($.trim(op_fi_email.val()))){
                  op_fi_check = 1;
                }else{
                  check_form_info('Kiểm tra lại địa chỉ email', op_fi_email);
                }
              }else{
                op_fi_check = 1;
              }
            }
          }
        }
      }
    }

    if(op_fi_check != 0){
      storage.setItem('op_fi_name_str', op_fi_name.val());
      storage.setItem('op_fi_phone_str', op_fi_phone.val());
      storage.setItem('op_fi_address_str', op_fi_address.val());
      if(op_fi_email.val() !== ''){
        storage.setItem('op_fi_email_str', op_fi_email.val());
      }
      if(op_fi_note.val() !== ''){
        storage.setItem('op_fi_note_str', op_fi_note.val());
      }

      op_fi_url += '?op_fi_method=' + op_fi_method.filter(":checked").val();
      op_fi_url += '&op_fi_name=' + op_fi_name.val();
      op_fi_url += '&op_fi_phone=' + op_fi_phone.val();
      op_fi_url += '&op_fi_address=' + op_fi_address.val();
      op_fi_url += '&op_fi_email=' + op_fi_email.val();
      op_fi_url += '&op_fi_note=' + op_fi_note.val();

      var current_item_in_cart = storage.getItem('number_cart_real');

      var run = 1;
      for(var i=1;i<=current_item_in_cart;i++){
        var uvg_select = '';
        if(storage.getItem('billcurrent_uvg' + i) !== null){
          uvg_select = ' (Ốp cường lực)';
        }

        if(storage.getItem('billcurrent_title' + i) !== null){
          var para_item = run + '. ' + storage.getItem('billcurrent_title' + i) + ' - ' + storage.getItem('billcurrent_sku' + i) + ' - ' + storage.getItem('billcurrent_devices' + i) + uvg_select + ' - ' + change_price(storage.getItem('billcurrent_price' + i)) + ' - ' + storage.getItem('billcurrent_quatity' + i);

          op_fi_url += '&op_fi_item' + run + '=' + para_item;
          run++;
        }
      }

      op_fi_url += '&op_fi_total=' + change_price(total_price.toLocaleString());
      op_fi_url += '&op_fi_number=' + run;

      var op_fi_date = new Date();
      var op_fi_bill_id = 'LVG' + op_fi_date.getFullYear().toString().substr(-2) + add_to_zero(op_fi_date.getMonth() + 1) + add_to_zero(op_fi_date.getDate()) + add_to_zero(op_fi_date.getMinutes()) + add_to_zero(op_fi_date.getSeconds());

      function add_to_zero(op1){
        return (op1 < 10 ) ? '0' + op1 : op1.toString();
      }

      op_fi_url += '&op_fi_id=' + op_fi_bill_id;

      $('.op-order-loading').fadeIn(600);

      $.ajax({
        url: op_fi_url,
        success: function() {
          storage.clear();
          storage.setItem('lvgnumber1', op_fi_bill_id);
          storage.setItem('op_fi_name_str', op_fi_name.val());
          storage.setItem('op_fi_phone_str', op_fi_phone.val());
          storage.setItem('op_fi_address_str', op_fi_address.val());
          storage.setItem('op_fi_email_str', op_fi_email.val());
          storage.setItem('op_fi_note_str', op_fi_note.val());
          window.location.href = op_success_url;
        }
      });
    }
  });

  // CHECK EMAIL
  function isEmail(email) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(email)) {
      return true;
    }else{
      return false;
    }
  }

  // SUCCESS BILL
  $('.op-success-id span').text(storage.getItem('lvgnumber1'));

  function check_form_info(alert1,selector){
    alert(alert1);
    $('html, body').animate({
      scrollTop: selector.offset().top
    }, 600);
    selector.focus();
  }

  $('.op-select-input-wrap i').click(function(){
    $( "#tags" ).val('');
    $('.op-select-uvg, .op-select-uvg1').hide();
  });

  $( "#tags" ).autocomplete({
    source: availableTags,
    select: function (a, b) {
      if(uvg_array.indexOf(b.item.value) > -1){
        $('.op-select-uvg').show();
        $('.op-select-uvg1').hide();
      }else{
        $('.op-select-uvg').hide();
        $('.op-select-uvg1').show();
      }
    }
  });

});