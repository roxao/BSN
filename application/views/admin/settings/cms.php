<?php
  $page_title = 'Dashboard :: Pengaturan Konten';
  $page_section = 'Content Management System';
  $data_table = [
    ['id_cms'                 ,'#', '50'], 
    ['title'                  ,'Judul Content', '0'], 
    ['url'                    ,'URL', '200'],
    ['status'           ,'Status', '200'],
    ['created_by'             ,'Dibuat Oleh', '100']
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
        <button id="btn-add" class="btn-flat float_left">TAMBAH CMS</button>

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
              echo '<tr class="row_select" data-id="'.$data[$data_table[0][0]].'">';
                  foreach($data_table as $x) {
                    echo '<td class="'.$x[0].''. ($x[0]=='status'? strtolower($data[$x[0]]) : '') .'" width="'.$x[2].'" data-sort="'.$x[0].'">'.$data[$x[0]].'</td>';
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
      
      $('.row_select').on('click', function() {
        $('[name=id_cms').val($(this).attr('data-id'));
        $('.modal-form button').click();
      })

      $('#btn-add').on('click', function() {
        $('[name=id_cms').val('insert');
        $('.modal-form button').click();
      })
   });
  </script>
</section>





<div class="z-modal-frame" style="display: none;">
  <form class="modal-form" action="<?php echo base_url('dashboard/settings/cms_editor') ?>" method="post">
    <input name="id_cms" type="text">    
    <button type="submit"></button>
  </form>
</div>

