<section section-id="5" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Konfirmasi Pembayaran</h1>
	<p>Silakan mengunggah bukti transfer yang telah anda lakukan melalui SIMPONI :.</p>

	<?php echo form_open_multipart('submit_iin/upload_files');?>

	<label class="button-upload-big">
		<img src="<?php base_url() ?>assets/upload.svg" alt="">
		<input type="file" name="file" />
		<!-- <input type="file" name="images[]" /> -->
		<span></span>
	</label>
	<div><center>Bukti Transfer PT. Codysseia</center></div>
	<br/><br/>
	<p >Silakan klik tombol “Lanjutkan Proses Permohonan IIN Baru” untuk melanjutkan ke proses pembayaran penerbitan IIN baru..</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left" >Kembali</button>	
		<button style="background: #01923f" class="float_right uploadstep5" id="uploadstep5" value="uploadstep5" name="upload">Lanjutkan Proses</button>	
	</div>


	<input type="hidden" id="key_step5" name="key_step5" value="BT PT">

	</form>
</section>




<script>
	$("input[type=file]").change(function() {
	    var fileName = $(this).val().split('/').pop().split('\\').pop();
	    $(this).next().html(fileName);
	});
</script>
<script type="text/javascript">
	var upload_status = "<?php echo $upload_status3?>";
	console.log(upload_status);

	if (upload_status == 'success') {
		$(".uploadstep5").hide();
	} else {
		$(".uploadstep5").show();
	}
</script>