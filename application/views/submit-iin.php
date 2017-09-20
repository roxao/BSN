<div class="page" style="margin-top: 150px">
	<div class="clearfix">
		<ul id="section_progress" style="width: 100%">
			<li stepId="0" class="verifiedStep"><button>Pengajuan Surat Permohonan ke BSN</button></li>
			<li stepId="1" class="verifiedStep"><button>Hasil Verifikasi Status Permohonan</button></li>
			<li stepId="2" class="verifiedStep"><button>Submit Kelengkapan Dokumen</button></li>
			<li stepId="3" class="processStep"><button>Proses Verifikasi dan Validasi</button></li>
			<li stepId="4" class="verifiedStep"><button>Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</button></li>
			<li stepId="5" class="verifiedStep"><button>Submit Bukti Transfer Pembayaran</button></li>
			<li stepId="6" class="verifiedStep"><button>Menerima IIN Baru Berserta Kelengkapan Dokumen</button></li>
			<li stepId="7" class="verifiedStep"><button>Assessment Lapangan</button></li>
			<li stepId="8" class="verifiedStep"><button>Proses Permohonan ke CRA</button></li>
			<li stepId="9" class="verifiedStep"><button>Menerima Konfirmasi Tim Verifikasi Lapangan</button></li>
		</ul>


		<?php 
		$id_user = $this->session->userdata('id_user');
	if ($this->user_model->getdocument_aplication($id_user) ){

		$data['download_upload']    = $this->user_model->getdocument_aplication($id_user);
		$datas['aplication_asesment']    = $this->user_model->getAplicationStatus($id_user);
	}


	// if ($this->user_model->getAplicationStatus($id_user) ){

		
	// }

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
