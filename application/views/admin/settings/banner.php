<?php
  $page_title = 'Dashboard :: Pengaturan Konten';
  $page_section = 'Content Management System';
?>



<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <div class="site-map">
      <a href="<?php echo base_url('dashboard') ?>">Dashboard</a><span></span>
      <a href="<?php echo base_url('dashboard') ?>">Pengaturan</a><span></span>
      <?php echo $page_section ?>
    </div>
    <center><h2 class="title_content"><?php echo $page_section ?></h2></center>
    <div id="tableInbox" style=" margin: 0 -20px 0 -20px">
      <div class="opt-table clearfix">
        <button id="btn-add" class="btn-flat float_left">TAMBAH</button>

        <div class="opt-table-filter float_right">
          <input class="search filter_search" placeholder="Search ..." />
        </div> 
      </div>

      

      <div class="parent_table">
        <table id="tableInbox" class="table_def tableInbox" style="width: 100%;">
          <thead>
            <tr>
              <th class="sort asc"  data-sort="id_banner">No</th>
              <th class="sort"      data-sort="title">Judul</th>
              <th class="sort"      data-sort="text">Deskripsi</th>
              <th class="sort"      data-sort="path">Lokasi Gambar</th>
              <th class="sort"      data-sort="link">Link</th>
              <th class="sort"      data-sort="status">Status</th>
          </tr>
          </thead>
          <tbody class="list">
            <?php foreach ($data as $key => $data): ?>
              <tr class="row_select" data-id="<?=$data['id_banner']?>">
                <td class="id_banner" data-sort="id_banner"><?=($key+1)?></td>
                <td class="title"     data-sort="title"><?=$data['title']?></td>
                <td class="text"      data-sort="text"><?=$data['text']?></td>
                <td class="path"      data-sort="path"><?=$data['path']?></td>
                <td class="link"      data-sort="link"><?=$data['url']?></td>
                <td class="status"    data-sort="status"><?=$data['status']?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      
    </div>
  </section>

  <div id="modal-image-upload" style="display: none">
    <div class="image-upload-content sheets_paper">
      <h4 class="image-upload-title">Upload Banner  <span class="close_modal sp-icon-dark"></span></h4>
      <label class="insert-image">
        <input type="file" name="img_file">
        <span></span>
      </label>
      <form class="banner-option-desc">
        <input type="hidden" name="id_banner">
        <input type="hidden" name="file_name" class="file_name">
        <label>
          <select name="status">
            <option value="Y">Aktif</option>
            <option value="N">Tidak Aktif</option>
          </select>
        </label>
        <label>
          <input type="text" name="title" placeholder="Masukan Judul Gambar">
        </label>
        <label>
          <input type="text" name="url" placeholder="Masukan Alamat Banner">
        </label>
        <label>
          <textarea name="description" placeholder="Masukan Deskripsi"></textarea>
        </label>
        <div style="border-top:1px solid #ddd"><center><button>UPLOAD</button></center></div>
    </div>
  </div>


  <script type="text/javascript" src="<?php echo base_url('/assets/js/list.min.js')?>"></script>
  <script type="text/javascript">

    $('document').ready(function(){
      document.title = '<?php echo $page_title ?>';
      $.set_table_list();

      $("[name=img_file]").change(function() {
        var fileName = $(this).val().split('/').pop().split('\\').pop();
        var preview = $(this).next();

        $.upload_process($(this).prop('files')[0], 'banner').done(function(e){
          preview.css({'background-image': 'url("'+e.full_path+'")'}).addClass('upload-image-success');
          $('.file_name').val(e.file_name);
        })
      })



   });
    $('.close_modal').on('click', function(){
        $('#modal-image-upload').fadeOut('slow');
      })
     $('#btn-add').on('click', function(){
        $('#modal-image-upload').fadeIn('slow');
        $('.banner-option-desc [name=id_banner]').val('');
        $('.banner-option-desc [name=file_name]').val('');
        $('.banner-option-desc [name=status]').val('');
        $('.banner-option-desc [name=title]').val('');
        $('.banner-option-desc [name=url]').val('');
        $('.banner-option-desc [name=description]').val('');
      })
     $('.row_select').on('click', function(){
        console.log($(this).children('[data-sort=title]').val());
        $('#modal-image-upload').fadeIn('slow');
        $('.banner-option-desc [name=id_banner]').val($(this).prop('data-id');
        $('.banner-option-desc [name=file_name]').val('');
        $('.banner-option-desc [name=status]').val($(this).children('.status').text());
        $('.banner-option-desc [name=title]').val($(this).children('.title').text());
        $('.banner-option-desc [name=url]').val($(this).children('.link').text());
        $('.banner-option-desc [name=description]').val($(this).children('.text').text());
      })
  </script>
</section>