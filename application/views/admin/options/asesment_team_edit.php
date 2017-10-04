<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment team< EDIT</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/tim_asesment_edit_proses') ?>" method="post">
  
  <?php
      foreach($data_asesment as $data)
      {
  ?>

	<div>
			Silakan Masukkan data asesment team
		</div>
		<div>

      <tr>
          <td width="250" height="32">[ id_assessment_team ]</td>
          <td width="304">
          <label>:
          <input name="id_assessment_team" type="text" id="id_assessment_team" value="<?php echo $data->id_assessment_team ?>"/>
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
          <td width="250" height="32">[ status ]</td>
          <td width="304">
          <label>:
          <input name="status" type="text" id="status" value="<?php echo $data->status ?>"/>
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