<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title< EDIT</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/iin_edit_proses') ?>" method="post">
  
  <?php
      foreach($iin as $data)
      {
  ?>

	<div>
			edit admin data
		</div>
		<div>

      <tr>
          <td width="250" height="32">[ id_iin ]</td>
          <td width="304">
          <label>:
          <input name="id_iin" type="text" id="id_iin" value="<?php echo $data->id_iin ?>"/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ id_user ]</td>
          <td width="304">
          <label>:
          <input name="id_userid_user" type="text" id="id_user" value="<?php echo $data->id_user ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ iin_number ]</td>
          <td width="304">
          <label>:
          <input name="iin_number" type="text" id="iin_number" value="<?php echo $data->iin_number ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ iin_established_date ]</td>
          <td width="304">
          <label>:
          <input name="iin_established_date" type="text" id="iin_established_date" value="<?php echo $data->iin_established_date ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ iin_expiry_date ]</td>
          <td width="304">
          <label>:
          <input name="iin_expiry_date" type="text" id="iin_expiry_date" value="<?php echo $data->iin_expiry_date ?>"/>
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