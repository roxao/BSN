<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/insert_tim_asesment_title_proses') ?>" method="post">
	<div>
			Silakan Masukkan data asesment title
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ name ]</td>
      		<td width="304">
          <label>:
          <input name="title" type="text" id="title" value="Pengelola"/>
     		  </label>
          </td>
    	</tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>