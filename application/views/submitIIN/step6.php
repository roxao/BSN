<section section-id="6" class="section_iin float_right" style="width: 70%; display:none">
	<h1 class="title_iin">Konfirmasi Tim Verifikasi Lapangan</h1>
	<p>Bersama ini kami informasikan bahwa Badan Standardisasi Nasional (BSN) akan melaksanakan verifikasi lapangan dalam rangka penerbitan nomor Issuer Identification Number (IIN) sesuai dengan ISO/IEC 7812 pada tanggal 29 Maret 2017.</p>

	<table>
		<thead>
			<th>No</th>
			<th>Nama</th>
			<th>Posisi</th>
		</thead>
		<tr>
			<td>1</td>
			<td>Novalen Ramadan</td>
			<td>Lead Verificator</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Dicki Dharma Saputra</td>
			<td>Member</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Akhmad Andaru</td>
			<td>Member</td>
		</tr>
	</table>

	<p >Konfirmasi atas persetujuan Saudara terhadap pelaksanaan dan tim verifikasi tersebut di atas, mohon dapat disampaikan kepada kami sebelum tanggal 25 Maret 2017.
		Demikian kami sampaikan, atas perhatian dan kerjasama yang diberikan, kami mengucapkan terima kasih
		Usulan Tim Verifikasi Lapangan IIN
		Surat Informasi Tim Verifikasi Lapngan IIN .</p>
		<br/>
		<ul class="section_iin_download">
		
		<?php $no=0; foreach($download_upload as $data) { 
		 	 switch ($data->key) {
		 	 	case 'IPPSA':?>

		<li> <?php $no++; echo "$no.  "; echo $data->display_name; ?>  <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->path_file;?>" class="btn_download"  >Download</a></li> 	
 <?php break;} 
 } ?> 
		
		</ul>
		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>
