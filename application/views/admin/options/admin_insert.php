<!DOCTYPE html>
<html>
<head>
	<title>supper admin </title>
</head>
<body>
<form action="<?php echo base_url('dashboard/insert_admin_proses') ?>" method="post">
	<div>
			Silakan Masukkan data admin atau super admin
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ email ]</td>
      		<td width="304">
          <label>:
          <input name="email" type="text" id="email" value="ifandimaulana05@gmail.com"/>
     		  </label>
          </td>
    	</tr>

        <tr>
          <td width="250" height="32">[ username ]</td>
          <td width="304">
          <label>:
          <input name="username" type="text" id="username" value="Santosa"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ password ]</td>
          <td width="304">
          <label>:
          <input name="password" type="text" id="password" value="123"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ admin_status ]</td>
          <td width="304">
          <label>:
          <input name="admin_status" type="text" id="admin_status" value="1"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ admin_role ]</td>
          <td width="304">
          <label>:
          <input name="admin_role" type="text" id="admin_role" value="1"/>
          </label>
          </td>
      </tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>