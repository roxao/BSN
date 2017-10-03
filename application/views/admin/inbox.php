<section class="dashboard_content sheets_paper">
  <section class="main_dashboard_slidetab">
    <h2 class="title_content">Inbox Status </h2>
    
    <div id="tableInbox" style=" margin: 0 -20px 0 -20px">
      <table class="table_def tableInbox" style="width: 100%;">
        <tr>
          <th class="sort click_auto"  data-sort="id_no"><center>#</center></th>
          <th class="sort" data-sort="id_name">Nama Pemohon</th>
          <th class="sort" data-sort="id_pt">Nama Instansi</th>
          <th class="sort" data-sort="id_type">Jenis Pengajuan</th>
          <th class="sort" data-sort="id_date">Tanggal Pengajuan</th>
          <th class="sort" data-sort="id_status"><center>Status Pengajuan</center></th>
        </tr>
        <tbody class="list">
          <? foreach($applications as $data) { ?>
            <tr class="<?php echo $data->owner == "ADMIN" ? "get_process" : ""?>" 
                data-id="<? echo $data->id_application ?>"  
                data-id-status="<? echo $data->id_application_status ?>"  
                data-status="<? echo $data->display_name ?>" 
                data-step="<? echo $data->application_status_name ?>">
              <td class="id_no"><? echo $data->id_application ?></td>
              <td class="id_name"><? echo $data->applicant ?></td>
              <td class="id_pt"><? echo $data->instance_name ?></td>
              <td class="id_type"><? echo $data->application_type ?></td>
              <td class="id_date"><? echo $data->application_date ?></td>
              <td class="id_status"><span class="<? echo $data->owner ?>"><? echo $data->display_name ?></span></td>
            </tr>
          <? } ?>
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

  <script type="text/javascript" src="<?php base_url(); ?>/BSN/assets/js/list.min.js"></script>
  <script type="text/javascript">
    $('document').ready(function(){
      var options = {valueNames: [ 'id_no', 'id_name', 'id_pt', 'id_type', 'id_date' ],page: 10,pagination: true};
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




