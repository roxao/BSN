<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title< EDIT</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/admin_edit_proses') ?>" method="post">
  
  <?php
      foreach($data_admin as $data)
      {
  ?>

	<div>
			edit admin data
		</div>
		<div>

      <tr>
          <td width="250" height="32">[ id_admin ]</td>
          <td width="304">
          <label>:
          <input name="id_admin" type="text" id="id_admin" value="<?php echo $data->id_admin ?>"/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ email ]</td>
          <td width="304">
          <label>:
          <input name="email" type="text" id="email" value="<?php echo $data->email ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ username ]</td>
          <td width="304">
          <label>:
          <input name="username" type="text" id="username" value="<?php echo $data->username ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ password ]</td>
          <td width="304">
          <label>:
          <input name="password" type="text" id="password" value="<?php echo $data->password ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ admin_status ]</td>
          <td width="304">
          <label>:
          <input name="admin_status" type="text" id="admin_status" value="<?php echo $data->admin_status ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ admin_role ]</td>
          <td width="304">
          <label>:
          <input name="admin_role" type="text" id="admin_role" value="<?php echo $data->admin_role ?>"/>
          </label>
          </td>
      </tr>

  <?php
      } 
    ?> 


    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>