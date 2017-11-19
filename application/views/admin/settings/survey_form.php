<?php
  $page_title = 'Dashboard :: Pengaturan Survey :: Ubah Survey';
  $page_section = 'Survey Form';
?>



<section class="dashboard_content sheets_paper" style="max-width: 800px">
  <section class="main_dashboard_slidetab">
    <div class="site-map">
      <a href="<?php echo base_url('dashboard')?>">Dashboard</a><span></span>
      <a href="<?php echo base_url('dashboard')?>">Pengaturan</a><span></span>
      <?php echo $page_section ?>
    </div>
    <center><h2 class="title_content"><?php echo $page_section ?></h2></center>

    <div id="survey-form">
      <form action="" method="post">
        <input class="hidden" name="id_survey" value="">
        
        <div class="survey-option">
          <label>
            <span>Status Survei:</span>
            <select name="question_status">
              <option value="0">Aktif</option>
              <option value="1">Tidak Aktif</option>
            </select>
          </label>
          <label>
            <span id="btn-add-row-survey">Tambah Pertanyaan</span>
          </label>

        </div>
        <div class="survey-form"></div>
        <div class="survey-footer">
          <button class="btn-submit-survey" type="submit">MASUKAN SURVEY</button>
        </div>
        
      </form>
    </div>
  </section>

  <script type="text/javascript">
    $('document').ready(function(){
      document.title = '<?php echo $page_title ?>';
      // $.set_add_row_survey_form('.survey-form', 'RATING', '');

      $('#btn-add-row-survey').on('click', function(event) {
        $.set_add_row_survey_form('.survey-form', 'RATING', '');
      });
   });
  </script>
</section>





