<!DOCTYPE html>
<html>
<head>
	<title>supper admin feature</title>
</head>
<body>
<form action="<?php echo base_url('insert_assesment_admin_proses') ?>" method="post">
	<div>
			Silakan Masukkan data untuk admin atau supper admin
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ name ]</td>
      		<td width="304"><label>:
          	<input name="name" type="text" id="name" value=""/>
     		 </label></td>
    		</tr>
	
			<tr>
      		<td width="250" height="32">[ title ]</td>
      		<td width="304"><label>:
         	<input name="title" type="text" id="title" value=""/>
     		</label></td>
    		</tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>