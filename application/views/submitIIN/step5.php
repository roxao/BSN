<section section-id="5" class="section_iin float_right" style="width: 70%; display:none">
	<h1 class="title_iin">Konfirmasi Pembayaran</h1>
	<p>Silakan mengunggah bukti transfer yang telah anda lakukan melalui SIMPONI :.</p>

<?php echo form_open_multipart('submit_iin/do_upload');?>
	<button> <input type="file" name="images[]" /> Unggah</button>
	<div>Bukti Transfer PT. Codysseia</div>
	
	<p >Silakan klik tombol “Lanjutkan Proses Permohonan IIN Baru” untuk melanjutkan ke proses pembayran penerbitan IIN baru..</p>
		<br/>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left" value="uploadstep6" name="upload">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
	</form>
</section>
