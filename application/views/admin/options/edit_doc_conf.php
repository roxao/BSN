<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title< EDIT</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/document_config_edit_proses') ?>" method="post">
  <?php echo form_open_multipart('dashboard/document_config_edit_proses') ?>
  <?php
      foreach($document as $data)
      {
  ?>

	<div>
			edit admin data
		</div>
		<div>

      <tr>
          <td width="250" height="32">[ id_document_config ]</td>
          <td width="304">
          <label>:
          <input name="id_document_config" type="text" id="id_document_config" value="<?php echo $data->id_document_config ?>"/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ type ]</td>
          <td width="304">
          <label>:
          <input name="type" type="text" id="type" value="<?php echo $data->type ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ key ]</td>
          <td width="304">
          <label>:
          <input name="key" type="text" id="key" value="<?php echo $data->key ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ file_url ]</td>
          <td width="304">
          <label>:
          <input name="file_url[]" type="file" id="file_url[]" value="<?php echo $data->file_url ?>"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ mandatory ]</td>
          <td width="304">
          <label>:
          <input name="mandatory" type="text" id="mandatory" value="<?php echo $data->mandatory ?>"/>
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