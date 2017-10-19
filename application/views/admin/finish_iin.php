<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <div class="site-map">
      <a href="<?php echo base_url('dashboard') ?>">Dashboard</a>
      <span></span>Inbox
    </div>
    <h2 class="title_content">Inbox Status </h2>

    <div id="tableInbox" style=" margin: 0 -20px 0 -20px;overflow: auto; ">
      <table class="table_def tableInbox" style="width: 100%;">
        <tr>
          <th style="min-width:55px"  class="sort sort-center click_auto"  data-sort="id_no">#</th>
          <th style="min-width:140px" class="sort" data-sort="id_name">Nama Pemohon</th>
          <th style="min-width:190px" class="sort" data-sort="id_pt">Nama Instansi</th>
          <th style="min-width:140px" class="sort" data-sort="id_type">Jenis Pengajuan</th>
          <th style="min-width:140px" class="sort" data-sort="id_date">Tanggal Pengajuan</th>
          <th width="" class="sort sort-center" data-sort="id_status">Status Pengajuan</th>
        </tr>
        <tbody class="list">
          <?php  foreach($applications as $data) { ?>
            <tr class="<?php echo $data->owner == "ADMIN" ? "get_process" : ""?>" 
                data-id="<?php  echo $data->id_application ?>"  
                data-id-status="<?php  echo $data->id_application_status ?>"  
                data-status="<?php  echo $data->display_name ?>" 
                data-step="<?php  echo $data->application_status_name ?>">
              <td class="id_no"><?php  echo $data->id_application ?></td>
              <td class="id_name"><?php  echo $data->applicant ?></td>
              <td class="id_pt"><?php  echo $data->instance_name ?></td>
              <td class="id_type"><?php  echo ($data->application_type == 'new' ? "Penerbitan IIN Baru": "Pengawasan IIN Lama") ?></td>
              <td class="id_date"><?php  echo date("D, d M Y", strtotime($data->application_date)) ?></td>
              <td class="id_status"><span class="<?php  echo $data->owner ?>"><?php  echo $data->display_name ?></span></td>
            </tr>
          <?php  } ?>
        </tbody>
      </table>

      <ul class="main_pagination">
        <li class="listjsprev"><</li>
        <ul class="pagination"></ul>
        <li class="listjsnext">></li>
      </ul>

      <div id="popup_box" style="display: none">
      </div>
    </div>
  </section>

  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/list.min.js"></script>
  <script type="text/javascript">
    $('document').ready(function(){
      var options = {valueNames: [ 'id_no', 'id_name', 'id_pt', 'id_type', 'id_date','id_status' ],page: 10,pagination: true};
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



