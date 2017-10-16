<div class="content-background"></div>

<!-- <div>
	<button class="show_popup">TAMPILKAN POPUP BOX</button>
</div>

 -->

<div class="page" style="margin-top: 150px">

	<div class="clearfix">
		<ul id="section_progress" style="width: 100%">
			<!-- <li stepId="0" class="<?php echo $this->session->flashdata('satu') == 'PENDING' ? 'PENDING' : $this->session->flashdata('satu');?>"><button>Pengajuan Surat Permohonan ke BSN</button></li>
			<li stepId="1" class="<?php echo $this->session->flashdata('dua') == 'PENDING' ? 'PENDING' : $this->session->flashdata('dua');?>"><button>Hasil Verifikasi Status Permohonan</button></li>
			<li stepId="2" class="<?php echo $this->session->flashdata('tiga') == 'PENDING' ? 'PENDING' : $this->session->flashdata('tiga');?>"><button>Submit Kelengkapan Dokumen</button></li>
			<li stepId="3" class=""><button>Proses Verifikasi dan Validasi</button></li>
			<li stepId="4" class=""><button>Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</button></li>
			<li stepId="5" class=""><button>Submit Bukti Transfer Pembayaran</button></li>
			<li stepId="6" class=""><button>Menerima Konfirmasi Tim Verifikasi Lapangan</button></li>
			<li stepId="7" class=""><button>Assessment Lapangan</button></li>
			<li stepId="8" class=""><button>Proses Permohonan ke CRA</button></li>
			<li stepId="9" class=""><button>Menerima IIN Baru Berserta Kelengkapan Dokumen</button></li> -->

			<li stepId="0" class="<?php echo $box_status_0?>"><button>Pengajuan Surat Permohonan ke BSN</button></li>
			<li stepId="1" class="<?php echo $box_status_1?>"><button>Hasil Verifikasi Status Permohonan</button></li>	   
			<li stepId="2" class="<?php echo $box_status_2?>"><button>Submit Kelengkapan Dokumen</button></li>
			<li stepId="3" class="<?php echo $box_status_3?>"><button>Proses Verifikasi dan Validasi</button></li>
			<li stepId="4" class="<?php echo $box_status_4?>"><button>Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</button></li>
			<li stepId="5" class="<?php echo $box_status_5?>"><button>Submit Bukti Transfer Pembayaran</button></li>
			<li stepId="6" class="<?php echo $box_status_6?>"><button>Menerima Konfirmasi Tim Verifikasi Lapangan</button></li>
			<li stepId="7" class="<?php echo $box_status_7?>"><button>Assessment Lapangan</button></li>
			<li stepId="8" class="<?php echo $box_status_8?>"><button>Proses Permohonan ke CRA</button></li>
			<li stepId="9" class="<?php echo $box_status_9?>"><button>Menerima IIN Baru Berserta Kelengkapan Dokumen</button></li>
		</ul>

		<script type="text/javascript">
			$('document').ready(function(){
				$('#section_progress>li.PENDING').click();
			})

		</script>

		<?php 
// echo $this->session->flashdata('1');
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}

		$id_user = $this->session->userdata('id_user');	
		$Status =  $this->user_model->get_applications_Status($id_user);
		$data['download_upload']    = $this->user_model->getdocument_aplication($id_user);
		$datas['aplication_asesment']    = $this->user_model->getAssesmentStatus($id_user);

		$this->load->view('submitIIN/step0');
		$this->load->view('submitIIN/step1',$data); 
		$this->load->view('submitIIN/step2',$data);
		$this->load->view('submitIIN/step3',$data);	
		$this->load->view('submitIIN/step4',$data);
		$this->load->view('submitIIN/step5',$data); 
		$this->load->view('submitIIN/step6',$datas, $data);
		$this->load->view('submitIIN/step7',$data);
		$this->load->view('submitIIN/step8',$data);
		$this->load->view('submitIIN/step9',$data);

?>
	</div>
</div>
