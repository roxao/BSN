


<div class="o-layout">
  <!-- LOGIN FORM -->
  <div id="box-login" class="box-layout">
      <div class="o-title">
        <div class="o-text-title">MASUK</div>
        <div class="o-close">x</div>
      </div>
      <div class="o-header">
        <div class="o-logo">
          <img src="<?php echo base_url(); ?>/assets/logo.png" alt="SIPIN">
          <div class="o-sub-logo">Silakan masuk ke dalam akun</div>
        </div>
      </div>
      <div class="o-content">
        <form class="o-form" action="<?php echo base_url();?>SipinHome/login" method = "POST">
            <!-- TAMPILKAN ERROR MESSAGE DISINI -->
            <div class="o-error" data-msg="login">Tampilkan error message disini</div>
            <input required type="username" name="username" placeholder="Username">
            <input required type="password" name="password" placeholder="Password">
            <div class="o-url float_right" o-data="box-forgot">Lupa Kata Sandi?</div>
            <button type="submit">Masuk</button>
        </form>
      </div>
      <div class="o-footer">
        <div class="o-separator">
          <span>ATAU</span>
        </div>
        <div class="o-link-footer">
          Belum Punya Akun?
          <div class="o-url" o-data="box-register">Daftar Sekarang</div>
        </div>
    </div>
  </div>

  <!-- REGISTER FORM -->
  <div id="box-register" class="box-layout" style="display:none">
    <div class="o-title">
        <div class="o-text-title">DAFTAR</div>
        <div class="o-close">x</div>
      </div>
      <div class="o-header">
        <div class="o-logo">
          <img src="<?php echo base_url(); ?>/assets/logo.png" alt="SIPIN">
          <div class="o-sub-logo">Daftar akun baru sekarang</div>
        </div>
      </div>
      <div class="o-content">
        <form class="o-form" action="<?php echo base_url();?>SipinHome/register" method = "POST">
            <!-- TAMPILKAN ERROR MESSAGE DISINI -->
            <div class="o-error" data-msg="register">Tampilkan error message disini</div>
            <input required required type="text" name="fullname" placeholder="Nama Lengkap">
            <input required type="username" name="username" placeholder="Username">
            <input  type="number" name="iin-number" placeholder="Nomor IIN" >
            <span><i style="color:red" >*</i> Jika sudah memiliki IIN</span>
            <input required type="email" name="email" placeholder="E-mail">
            <input required type="password" name="password" placeholder="Kata Sandi">
            <input required type="password" name="retype-password" placeholder="Ulang Kata Sandi"> 


              <div class="g-recaptcha" style="background: #ddd;width: 250px;display: table;vertical-align: middle;text-align: center;color:#aaa;font-size: 28px;margin: 0 auto;padding: 20px;" >  <?php echo $this->session->userdata('myimgcaptcha');?> </div>

          <input type="text" name='security_code' placeholder="Type the character you see ..." style="width: 200px; margin: 10px auto"><br/> <br/><br/><br/>


            <button type="submit">Daftar</button>
        </form>
      </div>
      <div class="o-footer">
        <div class="o-separator">
          <span>ATAU</span>
        </div>
        <div class="o-link-footer">
          Sudah Punya Akun?
          <div class="o-url" o-data="box-login">Masuk</div>
        </div>
    </div>
  </div>

    <!-- FORGOT FORM -->
  <div id="box-forgot" class="box-layout" style="display:none">
    <div class="o-title">
        <div class="o-text-title">LUPA KATA SANDI</div>
        <div class="o-close">x</div>
      </div>
      <div class="o-header">
        <div class="o-logo">
          <img src="<?php echo base_url(); ?>/assets/logo.png" alt="SIPIN">
          <div class="o-sub-logo">Kirim ulang email aktivasi</div>
        </div>
      </div>
      <div class="o-content">
        <form class="o-form" action="<?php echo base_url();?>SipinHome/forgot_password" method = "POST">
            <!-- TAMPILKAN ERROR MESSAGE DISINI -->
            <div class="o-error" data-msg="forgot">Tampilkan error message disini</div>
            <input required type="email" name="E-mail" placeholder="E-mail">
            <span><i style="color:red" >*</i> Pastikan E-mail yang dimasukkan sudah benar</span>
            <button type="submit">Kirim Kata Sandi</button>
        </form>
      </div>
      <div class="o-footer">
        <div class="o-separator">
          <span>ATAU</span>
        </div>
        <div class="o-link-footer">
          Kembali ke halaman 
          <div class="o-url" o-data="box-login">Login</div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?php echo base_url() ?>/assets/style.css">
<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/jquery-3.2.1.min.js"></script>


<script>
  $('.o-url').on('click', function(event) {
    event.preventDefault();
    show_box($(this).attr('o-data'));
  });
  // show_box("box-login");
  function show_box(x){  
    $('.box-layout').hide();
    $('#'+x).fadeIn('slow');
    }

    console.log("<?php echo $type ?> <?php echo $message ?>");
  show_action("<?php echo $type ?>", "<?php echo $message ?>");
  $('.o-close').on('click', function(event) {
    event.preventDefault();
    $('#show_popup').remove();
  });
  $('input[type="number"]').keydown(function(event) {
    console.log($(this).val().length);
    if($(this).val().length > 5){
      return false;
    }
  });

  function show_action(a,b){
    if(a!=""){
      show_box("box-"+a+"");
    }
    else {
      show_box("box-login");
    }
    if(b!=""){
      show_box("box-"+a+"");
      $('div[data-msg="'+a+'"').slideDown();
      $('div[data-msg="'+a+'"').html(b);
    }
  }
</script>
<style>
  .popup_box{position:fixed;margin:10vh auto;left:0;right:0;top:0;max-width:400px;min-width:300px;z-index:20000;background:#fff;max-height:80vh;overflow:auto;border-radius:2px}
  .popup_box .o-header{ display: none  }
  .popup_box .o-title{ display: block  }
  .popup_box .o-content{ padding: 20px 25px 0 25px  }
  .frame_popup{background: rgba(0,0,0,0.5); position: fixed; top:0;left:0;right:0;bottom: 0;z-index: 19999}
</style>
