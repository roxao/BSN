<?php
  $page_title = 'Dashboard :: Pengaturan Administrator';
  $page_section = 'ADMINISTRATOR';
  $data_table = [
    ['id_admin', 'ID', '20px'],
    ['username', 'Username', '150px'],  
    ['email', 'Alamat Email', '250px'],
    ['admin_role', 'Jabatan Admin', '150px'],
    ['admin_status', 'Status Admin', '150px']
  ];
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
        <button id="btn-add" class="btn-flat float_left">TAMBAH ADMIN</button>
        <div class="opt-table-filter float_right">
          <input class="search filter_search" placeholder="Search ..." />
          <div id="filtertable" style="display:none">
            <div class="clickfilter">Filter... </div>
            <div class="filtertable filters">
              <?php foreach($data_table as $x){ if($x[0]!=$data_table[0][0]) echo '<label><input type="checkbox" checked value="'.$x[0].'">'.$x[1].'</label>';}?>
            </div>
          </div>
        </div> 
      </div>

      <div id="targetExcel" class="parent_table">
        <table id="tableInbox" class="table_def tableInbox" style="width: 100%;">
          <tr><?php foreach($data_table as $x){echo '<th class="sort" data-sort="'.$x[0].'">'.$x[1].'</th>';}?></tr>
          <tbody class="list">
            <?php foreach($data as $key=>$data) {
              echo '<tr class="row_select"';
                  foreach($data_table as $x) {echo ' o-'.$x[0].'="'.$data[$x[0]].'"';}
              echo '>';
                  foreach($data_table as $x) {
                    echo '<td class="'.$x[0].' '. ($x[0]=='admin_status'? strtolower($data[$x[0]]) : '') .'" width="'.$x[2].'" data-sort="'.$x[0].'">'.$data[$x[0]].'</td>';
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

  <script type="text/javascript" src="<?php echo base_url('/assets/js/list.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/assets/js/export.js')?>"></script>
  <script type="text/javascript">
    var url_u = "<?php echo base_url('dashboard/action_update/admin') ?>";
    var url_i = "<?php echo base_url('dashboard/action_insert/admin') ?>";

    $('document').ready(function(){
      document.title = '<?php echo $page_title ?>';
      
      $('#filtertable input').click(function(event) {
        if($("input[type=checkbox]:checked").length<5){alert('Anda harus memilih minimal 5 kolom');return false;};
        $('th[data-sort="' + $(this).attr('value') + '"]').toggle();
        $('td[data-sort="' + $(this).attr('value') + '"]').toggle();
      });
      $('#filtertable .clickfilter').click(function(event){$('.filtertable').slideToggle()});
      var datasort = [<?php foreach($data_table as $key=>$x) {echo '"'.$x[0].'",';}?>]
      var SortTable = new List('tableInbox',{valueNames:datasort,page: 10,pagination: true});
      $('.listjsnext').on('click',function(){var list=$('.pagination').find('li');$.each(list,function(position,element){if($(element).is('.active')){$(list[position+1]).trigger('click')}})});
      $('.listjsprev').on('click',function(){var list=$('.pagination').find('li');$.each(list,function(position,element){if($(element).is('.active')){$(list[position-1]).trigger('click')}})});
      $('.tableInbox tr th:first-child').click();

      $('.z-modal-close').on('click',function(){$('#z-modal-edit').slideUp('fast',function(){$('.z-modal-frame').fadeOut()});})

      $('#btn-add').on('click', function() {
        $('.z-modal-title').html('Tambah Administrator');
        $('.z-modal-frame').fadeIn('fast', function() {
          $('.z-modal-frame input').val('');
          $('#z-modal-edit').slideDown()
          $('.modal-form').attr('action', url_i);
        });
      })
   });

    $('.row_select').on('click', function() {
        <?php foreach($data_table as $x){echo '$("[name='.$x[0].']").val($(this).attr("o-'.$x[0].'"));';} ?>
        $('.z-modal-title').html('Ubah Administrator');
        $('.z-modal-frame').fadeIn('fast', function() {
          $('#z-modal-edit').slideDown()
          $('.modal-form').attr('action', url_u);
        });
      })
  </script>
</section>





<div class="z-modal-frame" style="display: none;">
  <div id="z-modal-edit" style="display: none;">
    <div class="z-modal-header">
      <div class="z-modal-title">Ubah Administrator</div>
      <div class="z-modal-close"></div>
    </div>
    <div class="z-modal-content">
      <form  class="modal-form" action="<?php echo base_url('dashboard/set_action/user/update') ?>" method="post">
        <div class="z-modal-form">
            <input name="id_admin" type="hidden"/>
            <label>
                <span>Username</span>
                <input name="username" type="text" placeholder="Username" autocomplete="off"/>
            </label>

            <label>
                <span>Password</span>
                <input name="password" type="password" placeholder="Pa$$w0rd"  autocomplete="off"/>
            </label>

            <label>
                <span>E-mail</span>
                <input name="email" type="email" placeholder="example@mail.com"/>
            </label>
            
            <label>
                <span>Jabatan Admin</span> 
                <select name="admin_role">
                  <option>Super Admin</option>
                  <option>Admin</option>
                </select>
              </label>

            <label>
                <span>Status Admin</span>       
                <select name="admin_status">
                  <option>ACTIVE</option>
                  <option>INACTIVE</option>
                </select>
              </label>

            <button class="btn-flat">Lanjutkan</button>
          </div>
      </form>
    </div>
  </div>
</div>

