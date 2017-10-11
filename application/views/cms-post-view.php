

    <section id="cms-section" class="clearfix sheets_paper">
      <div class="cms-header">
        <span class="cms-header-date date-format" date-id="<?php echo $cms[0]['created_date'] ?>"></span>
        <h1 class="cms-header-title"><?php echo $cms[0]['title'] ?></h1>  
      </div>
      <article class="cms-content">
        <?php echo $cms[0]['content'] ?>
      </article>
    </section>

<script>
    document.title = '<?php echo $cms[0]['title'] ?>';
    parseDate(".date-format");
  function parseDate(o){date=$(o).attr('date-id');var x=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];y=date.substr(0,4);m=date.substr(5,2);d=date.substr(8,2);$(o).html(d+" "+x[m-1]+" "+y)}
</script>
