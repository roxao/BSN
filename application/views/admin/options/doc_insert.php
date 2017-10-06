<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment team</title>
</head>
<body>
<form >
<table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>               
          <th><center><span class="badge bg-green">id_document_config</span></center></th>  
          <th><center><span class="badge bg-brown">type</span></center></th>
          <th><center><span class="badge bg-brown">key</span></center></th>
          <th><center><span class="badge bg-brown">display_name</span></center></th>
          <th><center><span class="badge bg-brown">file_url</span></center></th>
          <th><center><span class="badge bg-brown">mandatory</span></center></th>
          <th><center><span class="badge bg-brown">created_date</span></center></th>
          <th><center><span class="badge bg-brown">created_by</span></center></th>
          <th><center><span class="badge bg-brown">last_updated_date</span></center></th>
          <th><center><span class="badge bg-brown">modified_by</span></center></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($document as $data) 
          { 
          ?>
            <tr>
            <td><center><?php echo $data->id_document_config;?></center></td>
            <td><center><?php echo $data->type;?></center></td>
            <td><center><?php echo $data->key;?></center></td>
            <td><center><?php echo $data->display_name;?></center></td>
            <td><center><?php echo $data->file_url;?></center></td>
            <td><center><?php echo $data->mandatory;?></center></td>
            <td><center><?php echo $data->created_date;?></center></td>
            <td><center><?php echo $data->created_by;?></center></td>
            <td><center><?php echo $data->last_updated_date;?></center></td>
            <td><center><?php echo $data->modified_by;?></center></td>
            <td>

            </tr>

            <?php } ?>  
            </tbody>
</table>
</form>

	<div>
			Silakan Masukkan data asesment team
		</div>
		<div>
<?php echo form_open_multipart('dashboard/insert_doc_proses') ?>
			
			<tr>
          <td width="250" height="32">[ type ]</td>
          <td width="304">
          <label>:
          <input name="type" type="text" id="type" value=""/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ key ]</td>
          <td width="304">
          <label>:
          <input name="key" type="text" id="key" value=""/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ display_name ]</td>
          <td width="304">
          <label>:
          <input name="display_name" type="text" id="display_name" value=""/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ file_url ]</td>
          <td width="304">
          <label>:
          <input name="file_url[]" type="file" id="file_url" value=""/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ mandatory ]</td>
          <td width="304">
          <label>:
          <input name="mandatory" type="text" id="mandatory" value=""/>
          </label>
          </td>
      </tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>


</body>
</html>