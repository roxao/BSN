<section section-id="6" class="section_iin float_right" style="display:none">
	<h1 class="title_iin">Konfirmasi Tim Verifikasi Lapangan</h1>
	<p>Bersama ini kami informasikan bahwa Badan Standardisasi Nasional (BSN) akan melaksanakan verifikasi lapangan dalam rangka penerbitan nomor Issuer Identification Number (IIN) sesuai dengan ISO/IEC 7812 pada tanggal 29 Maret 2017.</p>
	<br/>
	<table class="table_def table_assessment" style="width: 100%;">
	    <tr>
	      	<th class="sort" data-sort="id_no"><center>#</center></th>
	      	<th class="sort" data-sort="id_name">Nama Anggota</th>
	      	<th class="sort" data-sort="id_roles">Jabatan</th>
	    </tr>
	    <tbody class="list">
	        <?php foreach($aplication_asesment as $key=>$datas) { ?>
	        <tr>
	          	<td><?php echo ($key+1).".";?></td>
	          	<td><?php echo $datas->name;?></td>
				<td><?php echo $datas->title;?></td>
	        </tr>
	        <?php } ?> 
	    </tbody>
	</table>
	<br/>	
	<p >Konfirmasi atas persetujuan Saudara terhadap pelaksanaan dan tim verifikasi tersebut di atas, mohon dapat disampaikan kepada kami sebelum tanggal 25 Maret 2017.
		Demikian kami sampaikan, atas perhatian dan kerjasama yang diberikan, kami mengucapkan terima kasih
		Usulan Tim Verifikasi Lapangan IIN
		Surat Informasi Tim Verifikasi Lapngan IIN .</p>
		<br/>
		
		<ul class="list_iin_download">
		 <?php $no=0; 
		 	foreach($download_upload as $data) { 
		 	 	switch ($data->key) {
		 	 		case 'IPPSA':?>
		 				<div class="item-download">
							<div><?php $no++; echo "$no.  "; echo $data->display_name; ?></div>
							 <a href="<?php echo base_url();?>submit_iin/download?var1=<?php echo $data->file_url;?>" class="btn_download"  >Download</a>
		 				</div>	
		 <?php 			break;
				} 
	 		} ?> 
		</ul>

		<br/>

	<div class="clearfix">
		<button style="background: red" class="float_left">Kembali</button>	
		<button style="background: #01923f" class="float_right">Lanjutkan Proses</button>	
	</div>
</section>
