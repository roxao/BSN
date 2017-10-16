<?php
  $page_title = 'Dashboard :: Pengaturan Konten :: Editor';
  $page_section = 'Content Management System Editor';
  $data_table = [
    ['id_cms'], 
    ['title'], 
    ['content'],
    ['created_date'],
    ['created_by']
  ];
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
      <!-- JIKA type_editor = INSERT, VALUE $DATA[X]['X']  TIDAK PERLU DI ECHO TAPI DI KOSONGKAN-->
      <!-- DAN ISI FORM ACTION DI BAWAH JIKA INSERT MENJADI base_url('dashboard/action_insert/cms') dan sebaliknya jika update -->
      <form action="cms_editor_submit" method="get" accept-charset="utf-8">
        <input type="hidden" name="id_cms" value="<?php echo $data[0]['id_cms'] ?>">
        <input class="cms_title" type="text" name="title" value="<?php echo $data[0]['title']?>" placeholder="Judul Content">
        <textarea class='test' name="content" > </textarea>
      </form>
    </div>
  </section>


  <script src="https://cloud.tinymce.com/dev/tinymce.min.js?apiKey=qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc"></script>
  <script>tinymce.init({
    selector: '.test',
    min_height: 500,
    menubar: false,
  });
</script>

  <script type="text/javascript">
    $('document').ready(function(){
      document.title = '<?php echo $page_title ?>';      
   });
  </script>
</section>

