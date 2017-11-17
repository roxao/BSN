<section section-id="2" class="section_iin float_right" style="display:none">
	<!-- <h1 class="title_iin">Submit Kelengkapan Dokumen Permohonan IIN</h1>
	<p>Silakan mengunggah dokumen-dokumen yang sudah dilengkapi dan dipersiapkan ke dalam berdasarkan urutan di bawah ini.</p> -->

	<h1 class="title_iin"><?php echo $title_iin;?></h1>
	<p><?php echo $text_iin;?></p>
	<?php echo form_open_multipart('submit_iin/upload_files');?>
	<ul class="list_iin_download">
		<?php 

			$no=0; 
			foreach($step2_upload as $data) { 

				?>

				<li class="item-upload"> 
					<input type="checkbox" <?php echo (($upload_status == "success") ? "checked ": "" );?> disabled/> 
					<?php  
						$no++;
						// $files = "file".$no;
						$files = "file".$data->key;
						$mandatory = ($data->mandatory == '1') ? '*': '' ;
						$name = "{$no}. {$data->display_name} {$mandatory}";

						echo $name;

					?>
					
					<label class="upload_button">
						<span>Cari...</span>
						<input type="file"  id="<?php echo $data->key?>" class="fileChoser" name="<?php echo $files?>" 
						<?php echo (($data->mandatory == "1") ? "required": "" );?>	/>
						<i id="<?php echo $files?>" ></i>

					</label>
					
				</li> 	
			<?php
			} 

			?> 
	</ul>


	<input type="hidden" id="no_count" name="no_count" >


	<p >*Dokumen yang wajib disertakan</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: #01923f" class="float_right uploadstep3" name="upload" value="uploadstep3" onclick="checkUploadedFile()">Proses</button>	
	</div>
	</form>
</section>




<!-- DEFAULT ALDY -->
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

	function checkUploadedFile(){
		var temp = "";
		$(".fileChoser").each(function(){
			var value = $(this).val();
			// alert(value);
			if(value != null && value != ""){
				
				if(temp == "" || temp == null){
					temp = $(this).attr("id");
				} else {
					temp = temp +","+$(this).attr("id");
				}
			}
		});

		$("#no_count").val(temp);

		// alert($("#no_count").val());
	}
</script>	




