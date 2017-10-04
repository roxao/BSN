<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title< EDIT</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/user_edit_proses') ?>" method="post">
  
  <?php
      foreach($data_user as $data)
      {
  ?>

	<div>
			edit admin data
		</div>
		<div>

      <tr>
          <td width="250" height="32">[ id_user ]</td>
          <td width="304">
          <label>:
          <input name="id_user" type="text" id="id_user" value="<?php echo $data->id_user ?>"/>
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
          <td width="250" height="32">[ name ]</td>
          <td width="304">
          <label>:
          <input name="name" type="text" id="name" value="<?php echo $data->name ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ status_user ]</td>
          <td width="304">
          <label>:
          <input name="status_user" type="text" id="status_user" value="<?php echo $data->status_user ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ survey_status ]</td>
          <td width="304">
          <label>:
          <input name="survey_status" type="text" id="survey_status" value="<?php echo $data->survey_status ?>"/>
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