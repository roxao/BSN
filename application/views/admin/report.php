<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <div class="site-map">
      <a href="<?php echo base_url('dashboard') ?>">Dashboard</a><span></span>
      Laporan
    </div>
    <center><h2 class="title_content">LAPORAN</h2></center>
    <div id="tableInbox" style=" margin: 0 -20px 0 -20px">
      <?php
        $s_name = [
          ['id_application', '#'], 
          ['applicant', 'Nama Pemohon'], 
          ['applicant_phone_number', 'Telepon Pemohon'],
          ['application_date', 'Tanggal Pengajuan'],
          ['instance_name', 'Nama Perusahaan'],
          ['instance_email', 'E-mail Perusahaan'],
          ['instance_director', 'Direktur Perusahaan'],
          ['mailing_location', 'Lokasi Pengajuan'],
          ['mailing_number', 'Nomor Surat'],
          ['application_type', 'Jenis Pengajuan'],
          ['display_name', 'Status Pengajuan'],
        ];
      ?>
      <div class="clearfix"  style="margin: 0 15px">
        <div class="float_left">
          <button id="btnExport" class="btn-flat ">EXPORT</button>
          
        </div>

        <div id="filtertable" class="float_right">
          <div class="clickfilter">Filter... </div>
          <div class="filtertable"> 
            <?php foreach($s_name as $x){
              if($x[0] != $s_name[0][0]) echo '<label><input type="checkbox" checked value="'.$x[0].'">'.$x[1].'</label>';              
            } ?>
          </div>
        </div>
        <input class="search filter_search float_right" placeholder="Search ..." />
      </div>
      

      <div id="targetExcel" class="parent_table">
        <table class="table_def tableInbox" style="width: 100%;">
          <tr>
            <?php foreach($s_name as $x) {
            echo '<th class="sort" data-sort="'.$x[0].'">'.$x[1].'</th>';
            } ?>
          </tr>
          <tbody class="list">
            <?php foreach($applications as $key=>$data) {
              echo '<tr class="row_select"';
                foreach($s_name as $x) {
                  echo ' o-'.$x[0].'="'.$data[$x[0]].'"';
                }
              echo '>';
                foreach($s_name as $x) {
                echo '<td class="'.$x[0].'" data-sort="'.$x[0].'">'.$data[$x[0]].'</td>';
              }
              echo '</tr>';
            } ?>
          </tbody>
        </table>
      </div>
      <ul class="main_pagination">
        <li class="listjsprev"><</li>
        <ul class="pagination"></ul>
        <li class="listjsnext">></li>
      </ul>

      <div id="popup_box" style="display: none">
      </div>
    </div>
  </section>

  <script type="text/javascript" src="<?php  echo  base_url(); ?>/assets/js/list.min.js"></script>
  <script type="text/javascript" src="<?php  echo  base_url(); ?>/assets/js/export.js"></script>
  <script type="text/javascript">
    $('document').ready(function() {

       var url_u = "<?php echo base_url('dashboard/action_update/admin') ?>";
       var url_i = "<?php echo base_url('dashboard/action_insert/admin') ?>";
       var datasort = [<?php foreach($s_name as $key=>$x) {echo '"'.$x[0].'",';}?>]
       var options = {
           valueNames: datasort,
           page: 10,
           pagination: true
       };
       var inboxList = new List('tableInbox', options);

       fd = $('#filtertable :checked');

       $('#filtertable input').click(function(event) {
            checked = $("input[type=checkbox]:checked").length;
            if(checked < 4 ) {
              alert('Anda harus memilih minimal 5 kolom')
              return false;
            };
           fdv = $(this).attr('value');
           $('th[data-sort="' + fdv + '"]').toggle();
           $('td[data-sort="' + fdv + '"]').toggle();
       });
       $('#filtertable .clickfilter').click(function(event) {
           $('.filtertable').slideToggle();
       });
       $('.row_select').on('click', function() {
           <?php foreach($s_name as $x) { echo '$("#'.$x[0].'").val($(this).attr("o-'.$x[0].'"));';} ?>
           $('.z-modal-frame').fadeIn('fast', function() {
               $('#z-modal-edit').slideDown()
               $('.modal-form').attr('action', url_u);
           });
       })
       $('#expor-btn').on('click', function() {
          
       })
       $('.z-modal-close').on('click', function() {
           $('#z-modal-edit').slideUp('fast', function() {
               $('.z-modal-frame').fadeOut()
           });
       })
       $('.listjsnext').on('click', function() {
           var list = $('.pagination').find('li');
           $.each(list, function(position, element) {
               if ($(element).is('.active')) {
                   $(list[position + 1]).trigger('click');
               }
           })
       })
       $('.listjsprev').on('click', function() {
           var list = $('.pagination').find('li');
           $.each(list, function(position, element) {
               if ($(element).is('.active')) {
                   $(list[position - 1]).trigger('click');
               }
           })
       })
   });
  </script>
  <style> tr th:first-child{text-align: center !important} </style>
</section>




