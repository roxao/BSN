

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
</script>
