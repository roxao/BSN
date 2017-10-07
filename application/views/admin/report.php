<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <h2 class="title_content">Laporan</h2>
    <div id="tableInbox" style=" margin: 0 -20px 0 -20px">
        <!-- ['nama_parameter','Nama yang tampil di field table'] -->
        <!-- ['id_application', 'Nomor Aplikasi']  -->
      <?php
        $s_name = [
          ['id_application', 'Nomor Aplikasi'], 
          ['applicant', 'Nama Pemohon'], 
          ['applicant_phone_number', 'Nomor Telepon Pemohon'],
          ['application_date', 'Tanggal Pengajuan'],
          ['instance_name', 'Nama Perusahaan'],
          ['instance_email', 'E-mail Perusahaan'],
          ['instance_director', 'Direktur Perusahaan'],
          ['mailing_location', 'Lokasi Pengajuan'],
          ['mailing_number', 'Nomor Surat'],
          ['application_type', 'Jenis Pengajuan'],
          ['display_name', 'Status Pengajuan'],
          ['display_name', 'Status Pengajuan'],
        ];
      ?>
      <div id="filtertable">
        <div class="clickfilter">Filter... </div>
        <div class="filtertable">
          <?php foreach($s_name as $x) {echo '<label><input type="checkbox" checked value="'.$x[0].'">'.$x[1].'</label>';} ?>
        </div>
      </div>

      <div class="parent_table">
        <table class="table_def tableInbox" style="width: 100%;">
          <tr>
            <?php foreach($s_name as $x) {
              echo '<th class="sort" data-sort="'.$x[0].'">'.$x[1].'</th>';
            } ?>
          </tr>
          <tbody class="list">
            <?php foreach($applications as $key=>$data) {
              echo '<tr>';
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

  <script type="text/javascript" src="<?php  echo base_url(); ?>/assets/js/list.min.js"></script>
  <script type="text/javascript">
    $('document').ready(function(){
      var datasort = [<?php foreach($s_name as $key=>$x) {echo '"'.$x[0].'",';}?>]
      var options = {valueNames: datasort,page: 10,pagination: true};
      var inboxList = new List('tableInbox', options);

      fd = $('#filtertable :checked');
      console.log(fd);

      $('#filtertable input').click(function(event) {
        fdv = $(this).attr('value');
        $('th[data-sort="'+fdv+'"]').toggle();
        $('td[data-sort="'+fdv+'"]').toggle();
      });

    });

    $('.listjsnext').on('click', function(){
    var list = $('.pagination').find('li');
    $.each(list, function(position, element){
        if($(element).is('.active')){
            $(list[position+1]).trigger('click');
        }
    })
    })
    $('.listjsprev').on('click', function(){
        var list = $('.pagination').find('li');
        $.each(list, function(position, element){
            if($(element).is('.active')){
                $(list[position-1]).trigger('click');
            }
        })
    })
  </script>
</section>




