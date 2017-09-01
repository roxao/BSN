<!DOCTYPE html>
<html>
<head>
	<title>supper admin feature</title>
</head>
<body>
<form action="<?php echo base_url('insert_admin_proses') ?>" method="post">
	<div>
			Silakan Masukkan data untuk admin atau supper admin
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ email ]</td>
      		<td width="304"><label>:
          	<input name="email" type="text" id="email" value=""/>
     		 </label></td>
    		</tr>
	
			<tr>
      		<td width="250" height="32">[ username ]</td>
      		<td width="304"><label>:
         	<input name="username" type="text" id="username" value=""/>
     		</label></td>
    		</tr>

    		<tr>
      		<td width="250" height="32">[ password ]</td>
      		<td width="304"><label>:
         	<input name="password" type="text" id="password" value=""/>
     		</label></td>
    		</tr>

    		<tr>
      		<td width="250" height="32">[ admin_status ]</td>
      		<td width="304"><label>:
         	<input name="admin_status" type="text" id="admin_status" value=""/>
     		</label></td>
    		</tr>

    		<tr>
      		<td width="250" height="32">[ admin_role ]</td>
      		<td width="304"><label>:
         	<input name="admin_role" type="text" id="admin_role" value=""/>
     		</label></td>
    		</tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>