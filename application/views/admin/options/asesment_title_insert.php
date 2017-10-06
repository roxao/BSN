<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment title</title>
</head>
<body>
<table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>               
          <th><center><span class="badge bg-green">id_assessment_team_title</span></center></th>  
          <th><center><span class="badge bg-brown">title</span></center></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($data_asesment_title as $data) 
          { 
          ?>
            <tr>
            <td><center><?php echo $data->id_assessment_team_title;?></center></td>
            <td><center><?php echo $data->title;?></center></td>
            <td>

            </tr>

            <?php } ?>  
            </tbody>
</table>


<form action="<?php echo base_url('dashboard/insert_tim_asesment_title_proses') ?>" method="post">
	<div>
			Silakan Masukkan data asesment title
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ name ]</td>
      		<td width="304">
          <label>:
          <input name="title" type="text" id="title" value="Pengelola"/>
     		  </label>
          </td>
    	</tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>