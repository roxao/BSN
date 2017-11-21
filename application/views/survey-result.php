
    <section id="cms-section" class="clearfix sheets_paper">
      <div class="cms-header">
        <span class="cms-header-date"><a href="<?=base_url()?>" style="color:#3b9f58">HOME</a> >Hasil SURVEI</span>
        <h1 class="cms-header-title">HASIL SURVEI</h1>  
      </div>
      <article style="max-width: 1000px">
          <div class="survey-header">
            <div class="id_no">No.</div>
            <div class="id_qs">Pertanyaan</div>
            <div class="id_as">Nilai</div>
          </div>
          <?php for ($i=0; $i < count($survey['survey_questions']) ; $i++):$x=$survey['survey_questions'][$i]?>
          <div class="survey-row">
            <div class="id_no"> <?= $x['no'] ?> </div>
            <div class="id_qs"> <?= $x['question'] ?> </div>
            <div class="id_as td-stars"> 
              <?php for ($j=0;$j < round($x['average']) ; $j++): echo "<span></span>";endfor ?>
            </div>
          </div>
          <?php endfor ?>
      </article>
    </section>