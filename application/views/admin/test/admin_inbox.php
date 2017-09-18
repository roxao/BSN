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
					<th class="sort" data-sort="id_status">Status Pengajuan</th>
				</tr>
				<tbody class="list"><script>console.log(<? echo json_encode($applications) ?>)</script>
					<? foreach($applications as $data) { ?>
						<tr class="get_process" 
							data-id="<? echo $data->id_application ?>" 
							data-status="<? echo $data->display_name ?>" 
							data-step="<? echo $data->application_status_name ?>">
							<td class="id_no"><? echo $data->id_application ?></td>
							<td class="id_name"><? echo $data->applicant ?></td>
							<td class="id_pt"><? echo $data->instance_name ?></td>
							<td class="id_type"><? echo $data->application_type ?></td>
							<td class="id_date"><? echo $data->application_date ?></td>
							<td class="id_status <? echo $data->application_status_name ?>">
								<span><? echo $data->display_name ?></span></td></td>
						</tr>
					<? } ?>
				</tbody>
			</table>

			<div id="popup_box" style="display:none">
				<section id="modal_content">
					<section class="class_modal sheets_paper">
					<div class="close_modal sp-icon-dark"></div>
					<h1 class="title_modal">PENGAJUAN PERMOHONAN</h1>
						<div id="content_model">
							
						</div>
					</section>
				</section>
			</div>
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



