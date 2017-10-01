<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <h2 class="title_content">Laporan</h2>
    <div id="tableInbox" style=" margin: 0 -20px 0 -20px">
      <div id="filtertable">
        <label><input type="checkbox" value="id_1" checked>Nama Pemohon</label>
        <label><input type="checkbox" value="id_2" checked>Nama Pemohon</label>
        <label><input type="checkbox" value="id_3" checked>Nama Pemohon</label>
        <label><input type="checkbox" value="id_4" checked>Nama Pemohon</label>
        <label><input type="checkbox" value="id_5">Nama Pemohon</label>
        <label><input type="checkbox" value="id_6">Nama Pemohon</label>
        <label><input type="checkbox" value="id_7">Nama Pemohon</label>
        <label><input type="checkbox" value="id_8">Nama Pemohon</label>
        <label><input type="checkbox" value="id_9">Nama Pemohon</label>
        <label><input type="checkbox" value="id_10">Nama Pemohon</label>
        <label><input type="checkbox" value="id_11">Nama Pemohon</label>
        <label><input type="checkbox" value="id_12">Nama Pemohon</label>
      </div>
      <script>
      $("#filtertable input").change(function() {
          check_field($(this).val())
      });
      function check_field(datasort){
        if($(this).not(':checked')) {
            $('.parent_table th[data-sort="'+datasort+'"]').hide();
            $('.parent_table td[class="'+datasort+'"]').hide();
        } 

        if($(this).is(':checked')) {
            $('.parent_table th[data-sort="'+datasort+'"]').show();
            $('.parent_table td[class="'+datasort+'"]').show();
        } 
      }
      </script>


      <div class="parent_table">
        <table class="table_def tableInbox" style="width: 100%;">
          <tr>
            <th class="sort" data-sort="id_1"><center>#</center></th>
            <th class="sort" data-sort="id_2">Nama Pemohon</th>
            <th class="sort" data-sort="id_3">Nama Instansi</th>
            <th class="sort" data-sort="id_4">Jenis Pengajuan</th>
            <th class="sort" data-sort="id_5">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_6">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_7">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_8">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_9">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_10">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_11">Tanggal Pengajuan</th>
            <th class="sort" data-sort="id_12">Tanggal Pengajuan</th>

          </tr>
          <tbody class="list">
            <? foreach($applications as $key=>$data) { ?>
              <tr>
                <td class="id_1"><? echo $data->id_application ?> </td>
                <td class="id_2"><? echo $data->applicant ?></td>
                <td class="id_3"><? echo $data->application_date ?></td>
                <td class="id_4"><? echo $data->application_type ?></td>
                <td class="id_5"><? echo $data->created_by ?></td>
                <td class="id_6"><? echo $data->display_name ?></td>
                <td class="id_7"><? echo $data->instance_director ?></td>
                <td class="id_8"><? echo $data->application_date ?></td>
                <td class="id_9"><? echo $data->application_date ?></td>
                <td class="id_10"><? echo $data->application_date ?></td>
                <td class="id_11"><? echo $data->application_date ?></td>
                <td class="id_12"><? echo $data->application_date ?></td>

              </tr>
            <? } ?>
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

  <script type="text/javascript" src="<?php base_url(); ?>/BSN/assets/js/list.min.js"></script>
  <script type="text/javascript">
    $('document').ready(function(){
      var datasort = [ 'id_1', 'id_2', 'id_3', 'id_4', 'id_5', 'id_6', 'id_7', 'id_8', 'id_9', 'id_10', 'id_11', 'id_12' ]
      var options = {valueNames: datasort,page: 10,pagination: true};
      var inboxList = new List('tableInbox', options);
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




