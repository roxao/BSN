<div class="content-background"></div>
<section id="section-survey" class="sheets_paper">
		<div class="survey-desc">
			<h1 class="title-survey">Survei Kepuasan Pelanggan</h1>
			<p class="p-survey">Silakan mengisi survei kepuasan pelanggan terhadap pelayanan penerbitan dan pengawasan IIN oleh Sekretariat Layanan dan submit melalui sistem SIPIN ini. Dokumen Informasi Penerbitan IIN anda akan otomatis terunduh setelah Anda submit survei kepuasan pelanggan. Terima kasih.</p>
		</div>
		
		<br/>
		<article>
			<div id="questionnaire">
				<form action="<?php echo base_url('SurveyController/insert_question_survey') ?>" method="post" accept-charset="utf-8">
					<!-- nilai 5 diganti dengan jumlah pertanyaan dari json -->
					<!-- Masukan validasi if untuk type questionnaire nya -->
					<!-- Ganti lorem ipsum dengan question dari json -->
					<input name="number_of_question" value="<?php echo sizeof($data).'|'. $survey ?>">
					<?php for ($i=0; $i < sizeof($data); $i++) { ?>
						<!-- RATING TYPE -->
						<?php 
							if($data[$i]['type'] == 'RATING')
							{

							
						?>
						
						<div class="questionnaire rating">
							<div class="quiz-question">
								<div class="quiz-no"><?php echo $data[$i]['no'] ?>.</div>
								<div class="quiz-question-content"><?php echo $data[$i]['msg']; ?></div>
							</div>
							<div class="answer-choice">
								<div class="answer-hint">Nilai:</div>
								<div class="answer-rate display-flex">
									<!-- INI GAK USAH DI EDIT -->
									<?php for ($rate=1;$rate<6;$rate++) { ?>
										<label for="rate<?php echo $data[$i]['type'].$rate ?>"><?php echo $rate ?></label>
										<input
											type="radio" 
											id="rate<?php echo $data[$i]['type'].$rate ?>" 
											name="answer<?php echo $data[$i]['no'] ?>" 
											value="<?php echo $rate ?>" 
											<?php echo ($rate==5?'checked':'') ?>>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php
							}else
							{

							
						?>			
											<!-- COMMENT TYPE-->
						<div class="questionnaire comment">
							<div class="quiz-question">
								<div class="quiz-no"><?php echo ($i+1); ?>.</div>
								<div class="quiz-question-content"><?php echo $data[$i]['msg']; ?></div>
							</div>
							<div class="quiz-answer-content">
								<textarea class="answer-comment" name="comment<?php echo $data[$i]['no'] ?>"></textarea>
							</div>
						</div>

					<?php }} ?>



					<button class="btn-submit-survey" type="submit">KIRIM</button>
				</form>
			</div>
		</article>
</section>	
