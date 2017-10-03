<div class="">
    <div class="box_title">
      <!-- ||||  TITLE DINAMIS TERGANTUNG CONTENT YANG DITAMPILKAN |||| -->
      <h1> $$DINAMIS TITLE$$ </h1>
      <!-- ||||  END |||| -->
      <div class="box_btn_close"><img src="assets/cancel.svg" /></div>

    </div>
    <div class="box_content">
        <form id="login_frame" class="content_frame" action="<?php base_url()?>SipinHome/login" method="post" style="padding: 0 30px; width: 300px">
          <label class="input_class">
            <input type="text" id="username" name="username" autocomplete="off" placeholder="Username/Email/No. IIN:" required>
          </label>
          <label class="input_class">
            <input type="password" id="password" name="password" autocomplete="off" placeholder="Password:" required>
          </label>  
          <button type="submit" class="login btn_modal_flat" style="width: 100%; margin: 10px 0">Masuk</button>
          <div class="clearfix" style="padding: 10px 0; border-top: 1px solid #ddd">
            <div class="float_left" action="modal_pupop" data-id="forgot_frame" style="line-height: 32px"><small><i>Lupa Password?</i></small></div>
            <div class="float_right btn_modal_flat_line"><a href="#" action="modal_pupop" data-id="#register_frame">DAFTAR</a></div>
          </div>
        </form>

  </div>


<script>
  $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>

