<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment team</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/insert_tim_asesment_proses') ?>" method="post">
	<div>
			Silakan Masukkan data asesment team
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ name ]</td>
      		<td width="304">
          <label>:
          <input name="name" type="text" id="name" value="Pedro"/>
     		  </label>
          </td>
    	</tr>
	   
			<tr>
          <td width="250" height="32">[ status ]</td>
          <td width="304">
          <label>:
          <input name="status" type="text" id="status" value="active"/>
          </label>
          </td>
      </tr>



    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>