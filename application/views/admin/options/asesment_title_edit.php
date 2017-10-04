<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title< EDIT</title>
</head>
<body>
<form action="<?php echo base_url('dashboard/tim_asesment_title_edit_proses') ?>" method="post">
  
  <?php
      foreach($data_asesment_title as $data)
      {
  ?>

	<div>
			Silakan Masukkan data asesment title
		</div>
		<div>

      <tr>
          <td width="250" height="32">[ id_assessment_team_title ]</td>
          <td width="304">
          <label>:
          <input name="id_assessment_team_title" type="text" id="id_assessment_team_title" value="<?php echo $data->id_assessment_team_title ?>"/>
          </label>
          </td>
      </tr>
	   
			<tr>
          <td width="250" height="32">[ title ]</td>
          <td width="304">
          <label>:
          <input name="title" type="text" id="title" value="<?php echo $data->title ?>"/>
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