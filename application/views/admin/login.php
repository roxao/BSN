<!DOCTYPE html>
<html>
<head>
	<title>login Admin</title>
</head>
<body>
	<form action="<?php echo base_url('dashboard/login_process') ?>" method="post">
		<div>
			Silakan LOGIN dengan Username dan Password Anda 
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ Username ]</td>
      		<td width="304"><label>:
          	<input name="username" type="text" id="username" value=""/>
     		 </label></td>
    		</tr>
	
			<tr>
      		<td width="250" height="32">[ Password ]</td>
      		<td width="304"><label>:
         	<input name="password" type="text" id="password" value=""/>
     		</label></td>
    		</tr>
		<button type="submit" name="input" value="login">Login</button>
		</div>
	</form>
</body>
</html>