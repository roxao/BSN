
    <section id="cms-section" class="clearfix sheets_paper">
      <div class="cms-header">
        <span class="cms-header-date"><a href="<?php echo base_url() ?>" style="color:#3b9f58">HOME</a> > Penerima IIN</span>
        <h1 class="cms-header-title">DAFTAR PENERIMA IIN</h1>  
      </div>
      <article id="tableiin"  style="max-width: 1000px">
        <table class="table_def" width="100%" style="border: 1px solid #ddd">
          <thead>
            <tr>
              <th class="sort auto_click" data-sort="id_1"><center>No.</center></th>
              <th class="sort" data-sort="id_2">Nama Perusahaan</th>
              <th class="sort" data-sort="id_3">Email Perusahaan</th>
              <th class="sort" data-sort="id_4">Telepon Perusahaan</th>
              <th class="sort" data-sort="id_5">Lokasi</th>
              <th class="sort" data-sort="id_6">Pengesahan</th>
              <th class="sort" data-sort="id_7">Kadaluarsa</th>
              <th class="sort" data-sort="id_8"><center>Nomor IIN</center></th>
            </tr>
          </thead>
          <tbody class="list">
          <?php foreach ($iin as $row) {?>
            <tr>
              <td class="id_1"> <?php echo $row->id_iin ?> </td>
              <td class="id_2"> <?php echo $row->instance_name ?> </td>
              <td class="id_3"> <?php echo $row->instance_email ?> </td>
              <td class="id_4"> <?php echo $row->instance_phone ?> </td>
              <td class="id_5"> <?php echo $row->mailing_location ?> </td>
              <td class="id_6"><?php echo date("D, d M Y", strtotime($row->iin_established_date)) ?> </td>
              <td class="id_7"> <?php echo date("D, d M Y", strtotime($row->iin_expiry_date)) ?> </td>
              <td class="id_8"><center><?php echo $row->iin_number ?></center></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        <ul class="main_pagination">
          <li class="listjsprev"><</li>
          <ul class="pagination"></ul>
          <li class="listjsnext">></li>
        </ul>
      </article>
    </section>

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/list.min.js"></script>
  <script type="text/javascript">
    $('document').ready(function(){
      var options = {valueNames: ['id_1','id_2','id_3','id_4','id_5','id_6','id_7','id_8'],page: 25,pagination: true};
      var inboxList = new List('tableiin', options);
            $('.auto_click').click();

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
