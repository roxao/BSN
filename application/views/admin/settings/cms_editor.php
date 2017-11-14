<?php
  $page_title = 'Dashboard :: Pengaturan Konten :: Editor';
  $page_section = 'Content Management System Editor';
?>



<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <div class="site-map">
      <a href="<?php echo base_url('dashboard')?>">Dashboard</a><span></span>
      <a href="<?php echo base_url('dashboard')?>">Pengaturan</a><span></span>
      <?php echo $page_section ?>
    </div>
    <center><h2 class="title_content"><?php echo $page_section ?></h2></center>
    <div id="cms_editor">
      <form action="cms_editor_submit" method="post" accept-charset="utf-8">
        <input type="hidden" name="id_cms" value="<?php echo ($data) ? '' : $data[0]['id_cms'] ?>">
        <div class="cms_editor_title">
          <label>Judul Konten
            <input  type="text" name="title" value="<?php echo $data[0]['title']?>" placeholder="Judul Content">
          </label>
          <button type="submit">Posting</button>
        </div>
        <textarea class='editor' name="content"> </textarea>
      </form>
    </div>
  </section>


  <script src="<?php echo base_url('assets/js/wysiwyg/tinymce.min.js')?>"></script>
  <script>tinymce.init({
    selector: '.editor',
    min_height: 500,
    menubar: false,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor textcolor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code help'
      ],
    images_upload_url: '<?php echo base_url('dashboard/upload_acceptor') ?>',
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '<?php echo base_url('dashboard/upload_acceptor') ?>');

        xhr.onload = function() {
          var json;

          if (xhr.status != 200) {
            failure('HTTP Error: ' + xhr.status);
            return;
          }

          json = JSON.parse(xhr.responseText);

          if (!json || typeof json.location != 'string') {
            failure('Invalid JSON: ' + xhr.responseText);
            return;
          }

          success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
      },
    init_instance_callback: function (ed) {
      ed.execCommand('mceImage');
    },
    toolbar: 'undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image media | removeformat',
  });
</script>

  <script type="text/javascript">
    $('document').ready(function(){
      document.title = '<?php echo $page_title ?>';      
   });
  </script>
</section>

