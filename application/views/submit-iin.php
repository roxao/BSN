<div class="page" style="margin-top: 150px">
	<div class="clearfix">
		<ul id="section_progress" style="width: 100%">
			<li stepId="0" class="verifiedStep"><button>Pengajuan Surat Permohonan ke BSN</button></li>
			<li stepId="1" class="verifiedStep"><button>Hasil Verifikasi Status Permohonan</button></li>
			<li stepId="2" class="verifiedStep"><button>Submit Kelengkapan Dokumen</button></li>
			<li stepId="3" class="processStep"><button>Proses Verifikasi dan Validasi</button></li>
			<li stepId="4" class="waitingStep"><button>Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</button></li>
			<li stepId="5" class="waitingStep"><button>Submit Bukti Transfer Pembayaran</button></li>
			<li stepId="6" class="waitingStep"><button>Menerima IIN Baru Berserta Kelengkapan Dokumen</button></li>
			<li stepId="7" class="waitingStep"><button>Assessment Lapangan</button></li>
			<li stepId="8" class="waitingStep"><button>Proses Permohonan ke CRA</button></li>
			<li stepId="9" class="waitingStep"><button>Menerima Konfirmasi Tim Verifikasi Lapangan</button></li>
		</ul>

		<!-- Section 1 get view "submitIIN/step0.php -->
		<?php $this->load->view('submitIIN/step0')  ?>
		<!-- Section 1 get view "submitIIN/step1.php -->
		<?php $this->load->view('submitIIN/step1')  ?>
		<!-- Section 2 get view "submitIIN/step2.php -->
		<?php $this->load->view('submitIIN/step2')  ?>
		<!-- Section 3 get view "submitIIN/step3.php -->
		<?php $this->load->view('submitIIN/step3')  ?>
		<!-- Section 4 get view "submitIIN/step4.php -->
		<?php $this->load->view('submitIIN/step4')  ?>
		<!-- Section 5 get view "submitIIN/step5.php -->
		<?php $this->load->view('submitIIN/step5')  ?>
		<!-- Section 6 get view "submitIIN/step6.php -->
		<?php $this->load->view('submitIIN/step6')  ?>
		<!-- Section 7 get view "submitIIN/step7.php -->
		<?php $this->load->view('submitIIN/step7')  ?>
		<!-- Section 8 get view "submitIIN/step8.php -->
		<?php $this->load->view('submitIIN/step8')  ?>
		<!-- Section 9 get view "submitIIN/step9.php -->
		<?php $this->load->view('submitIIN/step9')  ?>

	</div>
</div>
