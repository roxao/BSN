<section section-id="2" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Submit Kelengkapan Dokumen Permohonan IIN</h1>
	<p>Silakan mengunggah dokumen-dokumen yang sudah dilengkapi dan dipersiapkan ke dalam berdasarkan urutan di bawah ini.</p>
	<?php echo form_open_multipart('submit_iin/do_upload');?>
	<ul class="list_iin_download">
		<?php $no=0; 
			
			foreach($step2_upload as $data) { ?>
				<li class="item-upload"> 
					<input type="checkbox" <?php echo (($upload_status == "success") ? "checked disabled": "" );?> /> 
					<?php  $no++; echo "$no.  "; echo $data->display_name;  
						echo (($data->mandatory == '1') ? ' * ': '' );
					?>
					
					<label class="upload_button">
						<span>Cari...</span>
						<input type="file" name="images[]" 
						<?php echo (($data->mandatory == "1") ? "required": "" );?>	/>
					</label>
					
				</li> 	
			<?php
			} ?> 
	</ul>

	<p >*Dokumen yang wajib disertakan</p>
		<br/>
		<br/>

	<div class="clearfix">
		<!-- <button id="btn_back" style="background: red" class=" btn_back float_left">Kembali</button>	 -->
		<button style="background: #01923f" class="float_right"  value="uploadstep3" name="upload" >Proses</button>	
		
	</div>
	</form>
<!-- 	<div class="clearfix">
		<button id="btn_back" style="background: red" class=" btn_back float_left">Kembali</button>	
		
	</div> -->
</section>



<script>
	$("input[type=file]").change(function() {
	    var fileName = $(this).val().split('/').pop().split('\\').pop();
	    $(this).next().html(fileName);
		$(this).parent().prev().prop('checked',(fileName.length>1?true:false));
	});
</script>
<script type="text/javascript">
	var upload_status = "<?php echo $upload_status ?>";


	if (upload_status == 'success') {
		$(".upload_button").hide();
	} else {
		$(".upload_button").show();
	}
</script>






<!-- KALAU GAGAL UPLOAD -->

