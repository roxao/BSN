<section class="dashboard_content sheets_paper">
	<section class="main_dashboard_slidetab">
		<div id="tableInbox" style=" margin: 0 -20px 0 -20px">
			<table class="table_def tableInbox" style="width: 100%;">
				<tr>
					<th class="sort" data-sort="id_no">#</th>
					<th class="sort" data-sort="id_name">Nama Pemohon</th>
					<th class="sort" data-sort="id_pt">Nama Instansi</th>
					<th class="sort" data-sort="id_type">Jenis Pengajuan</th>
					<th class="sort" data-sort="id_date">Tanggal Pengajuan</th>
					<th class="sort" data-sort="id_status"><center>Status Pengajuan</center></th>
					<th></th>
				</tr>
				<tbody class="list">
					<? foreach($applications as $data) { ?>
						<tr>
							<td class="id_no"><? echo $data->id_application ?></td>
							<td class="id_name"><? echo $data->applicant ?></td>
							<td class="id_pt"><? echo $data->instance_name ?></td>
							<td class="id_type"><? echo $data->application_type ?></td>
							<td class="id_date"><? echo $data->application_date ?></td>
							<!-- ISI IIN STATUS DIBAWAH DENGAN STATUS NAME -->
							 <!-- CONTOH: VERIF_NEW_REQ -->
							<td class="id_status <? echo $data->iin_status ?>">
								 <!-- ISI IIN STATUS DIBAWAH DENGAN APPLICATION STATUS DISPLAY NAME -->
								 <!-- CONTOH: Verifikasi Pengajuan Permohonan -->
								<span><? echo $data->iin_status ?></span></td></td>
								<!-- ISI ATTRIBUTE data-id DENGAN id aplikasi. Ex. 1 || 2 || 3 -->
								<!-- ISI ATTRIBUTE data-step DENGAN STEP POP UP YANG AKAN MUNCUL. Ex 1 || 2 || 3-->
							<td><div class="btn_inbox_process" data-id="<? echo $data->id_application ?>" data-step="1">Proses</div></td>
						</tr>
					<? } ?>
				</tbody>
			</table>

			<div id="popup_box" style="display:none"></div>
		</div>
	</section>

	<script type="text/javascript" src="<?php base_url(); ?>/BSN/assets/js/list.min.js"></script>
	<script type="text/javascript">
		$('document').ready(function(){
			var options = {
			  	valueNames: [ 'id_no', 'id_name', 'id_pt', 'id_type', 'id_date' ]
			};
			var inboxList = new List('tableInbox', options);
		});
	</script>
</section>




