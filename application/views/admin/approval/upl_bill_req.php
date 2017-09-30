<article style="margin: 20px">
	<div class="clearfix content_application_next">
		<div class="section_upload_list_file">
			<div class="addFileButton"><span>Tambah Unggah Dokumen</span></div>
			<form class="section_iin_upload_list attach_admin_file" action="">
				<div class="item_upload clearfix"><label><input type="file" class="inputfile"><div>Pilih Dokumen</div></label></div>
			</form>
			<div class="section_upload_list_verify">
				<div class="clearfix" style="padding:0 10% 0 10%">
					<!-- <button class="btn_back_upload float_left" style="background: red">KEMBALI</button> -->
					<button class="btn_process_upload float_right" style="background: #01923f">PROSES</button>
				</div>
			</div>
		</div>
	</div>
</article>

<script>
$(document).ready(function(){
	value = respJson.doc_user;
	console.log(respJson);

	$(".addFileButton").click(function(){ 
		$('.section_iin_upload_list').append('<div class="item_upload clearfix"><label><input type="file"><div>Pilih Document</div></label><span class="del_upload">DELETE</span></div>');
		// setPosition('.class_modal');
	})
	$('input:file').change( function(e){
		var filename = $(this).val().replace(/.*[\/\\]/, '');
		$(this).next().html(filename);
	});
	$('.del_upload').on('click', function() {
		$(this).parent('.item_upload').remove();
		// setPosition('.class_modal');
	});
});
</script>
