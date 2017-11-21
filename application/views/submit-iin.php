<div class="content-background"></div>

<!-- <div>
	<button class="show_popup">TAMPILKAN POPUP BOX</button>
</div>

 -->

<div class="page" style="margin-top: 150px">

	<div class="clearfix">
		
		<?php 
			echo "|state0 : {$state0}";
			echo "|state2 : {$state2}";
			echo "|state3 : {$state3}";
			echo "|state5 : {$state5}";
			echo "|state6 : {$state6}";
			echo "|state7 : {$state7}";
			echo "|state8 : {$state8}";
			echo "|iin_status : {$this->session->userdata('iin_status')}";
			echo "|survey_status : {$this->session->userdata('survey_status')}";
			echo "|have_iin : {$this->session->userdata('have_iin')}";

		?>
		<ul id="section_progress" style="width: 100%">
			<li stepId="<?php echo $state0?>" class="<?php echo $box_status_0?>"><button>Pengajuan Surat Permohonan ke BSN</button></li>
			<li stepId="1" class="<?php echo $box_status_1?>"><button>Hasil Verifikasi Status Permohonan</button></li>	   
			<li stepId="<?php echo $state2?>" class="<?php echo $box_status_2?>"><button>Submit Kelengkapan Dokumen</button></li>
			<li stepId="<?php echo $state3?>" class="<?php echo $box_status_3?>"><button>Proses Verifikasi dan Validasi</button></li>
			<li stepId="4" class="<?php echo $box_status_4?>"><button>Konfirmasi Surat Lulus Kelengkapan dan Kode Billing</button></li>
			<li stepId="<?php echo $state5?>" class="<?php echo $box_status_5?>"><button>Submit Bukti Transfer Pembayaran</button></li>
			<li stepId="<?php echo $state6?>" class="<?php echo $box_status_6?>"><button>Menerima Konfirmasi Tim Verifikasi Lapangan</button></li>
			<li stepId="<?php echo $state7?>" class="<?php echo $box_status_7?>"><button>Assessment Lapangan</button></li>
			<li stepId="<?php echo $state8?>" class="<?php echo $box_status_8?>"><button>Proses Permohonan ke CRA</button></li>
			<li stepId="9" class="<?php echo $box_status_9?>"><button>Menerima IIN Baru Berserta Kelengkapan Dokumen</button></li>
		</ul>

		<script type="text/javascript">
			$('document').ready(function(){
				$('#section_progress>li.PENDING').click();
			})

		</script>
		
		<?php
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url("SipinHome"));
		}

		// $id_user 	= $this->session->userdata('id_user');	
		// $Status 	= $this->user_model->get_applications_Status($id_user);
		// $data['download_upload']    		= $this->user_model->get_doc_statis($id_user);
		// $data['upload']	= $this->user_model->get_doc_user_upload($id_user);
		// $data['download_upload_kode_bill']  = $this->user_model->get_doc_kbs();
		// $datas['aplication_asesment']    	= $this->user_model->getAssesmentStatus($id_user);



		$this->load->view('submitIIN/step0');

		if ($page >= '1') {
			// $this->load->view('submitIIN/step1',$data);
			$this->load->view('submitIIN/step1');
			
			if ($page >= '2') {
				// $this->load->view('submitIIN/step2',$data,$id_user);
				$this->load->view('submitIIN/step2');
			
				if ($page >= '3') {
					// $this->load->view('submitIIN/step3',$data,$id_user);
					$this->load->view('submitIIN/step3');
					
					if ($page >= '4') {
						// $this->load->view('submitIIN/step4',$data);
						$this->load->view('submitIIN/step4');	
						
						if ($page >= '5') {
							// $this->load->view('submitIIN/step5',$data);
							$this->load->view('submitIIN/step5');
							if ($page >= '6') {
								// $this->load->view('submitIIN/step6',$datas, $data);
								$this->load->view('submitIIN/step6');

								if ($page >= '7') {
									// $this->load->view('submitIIN/step7',$data);
									$this->load->view('submitIIN/step7');
									if ($page >= '8') {
										// $this->load->view('submitIIN/step8',$data);
										$this->load->view('submitIIN/step8');
										
										if ($page >= '9') {
											// $this->load->view('submitIIN/step9',$data);
											$this->load->view('submitIIN/step9');
											
										}
									}
								}
							}
						}
					}	
				}	
			}
		}


		//ANDARU DEFAULT
		// $this->load->view('submitIIN/step0');
		// $this->load->view('submitIIN/step1',$data); 
		// $this->load->view('submitIIN/step2',$data,$id_user);
		// $this->load->view('submitIIN/step3',$data);	
		// $this->load->view('submitIIN/step4',$data);
		// $this->load->view('submitIIN/step5',$data); 
		// $this->load->view('submitIIN/step6',$datas, $data);
		// $this->load->view('submitIIN/step7',$data);
		// $this->load->view('submitIIN/step8',$data);
		// $this->load->view('submitIIN/step9',$data);

		// ON PROCESS VIEW
		
		// $data['process_view'] = array(
		// 		'title' => 'Submit Kelengkapan Dokumen Permohonan IIN',
		// 		'text'  => 'Dokumen yang anda unggah sudah <b>BERHASIL</b> masuk ke dalam database <b>SIPIN</b>. Silakan menunggu hasil verifikasi dan validasi yang akan diproses dalam waktu kurang lebih 3 hari kerja.'
		// 	);

		$data['process_view'] = array(
			'title' => $title,
			'text'  => $text
		);
		$this->load->view('submitIIN/process', $data);


		// $data['rejected_view'] = array(
		// 		'title' => 'Submit Kelengkapan Dokumen Permohonan IIN',
		// 		'text'  => 'Dokumen yang anda unggah sudah <b>BERHASIL</b> masuk ke dalam database <b>SIPIN</b>. Silakan menunggu hasil verifikasi dan validasi yang akan diproses dalam waktu kurang lebih 3 hari kerja.'
		// 	);

		$data['rejected_view'] = array(
			'title' => $title,
			'text'  => $text,
			'reject_msg'  => $reject_msg
		);
		$this->load->view('submitIIN/rejected', $data);
		
		$data['assessment_rev'] = array(
			'title' => $title,
			'text'  => $text,
		);
		$this->load->view('submitIIN/assessment_rev', $data);

		// $this->load->view('submitIIN/step0-rejected', $data);

		// REVISION VIEW
		// $this->load->view('submitIIN/step2-revision');

?>
	</div>
</div>
