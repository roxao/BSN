<section section-id="2-revision" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Revisi Kelengkapan Dokumen Permohonan IIN</h1>

	<p class="p-alert">Terjadi kesalahan atau kekurangan pada dokumen yang anda unggah. Silakan upload kembali dokumen-dokumen permohonan IIN</p>

	<?php echo form_open_multipart('submit_iin/do_upload');?>
	<ul class="list_iin_download">
		<?php $no=0; 
			foreach($download_upload as $data) {
				switch ($data->type) { 
 	 			// INI TINGGAL DI UBAH KEYNYA
	 	 		case 'DYNAMIC': ?>
					<li class="item-upload"> 
						<input type="checkbox" /> 
						<?php  $no++; echo "$no.  "; echo $data->display_name; ?>  
						<label><span>Cari...</span><input type="file" name="images[]"/><i></i></label> 
					</li> 	
			<?php break; 
 				}
			} ?> 
	</ul>

	<p >*Dokumen yang wajib disertakan</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button id="btn_back" style="background: red" class=" btn_back float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right"  value="uploadstep3" name="upload" >Upload Ulang</button>	
		</form>
	</div>
</section>



<script>
	$("input[type=file]").change(function() {
	    var fileName = $(this).val().split('/').pop().split('\\').pop();
	    $(this).next().html(fileName);
		$(this).parent().prev().prop('checked',(fileName.length>1?true:false));
	});
</script>






<!-- KALAU GAGAL UPLOAD -->

