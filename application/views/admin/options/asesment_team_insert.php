<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment team</title>
</head>
<body>

<table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>               
          <th><center><span class="badge bg-green">id_assessment_team</span></center></th>  
          <th><center><span class="badge bg-brown">name</span></center></th>
          <th><center><span class="badge bg-brown">status</span></center></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($data_asesment as $data) 
          { 
          ?>
            <tr>
            <td><center><?php echo $data->id_assessment_team;?></center></td>
            <td><center><?php echo $data->name;?></center></td>
            <td><center><?php echo $data->status;?></center></td>
            <td>

            </tr>

            <?php } ?>  
            </tbody>
</table>

<form action="<?php echo base_url('dashboard/insert_tim_asesment_proses') ?>" method="post">
	<div>
			Silakan Masukkan data asesment team
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ name ]</td>
      		<td width="304">
          <label>:
          <input name="name" type="text" id="name" value="Pedro"/>
     		  </label>
          </td>
    	</tr>
	   
			<tr>
          <td width="250" height="32">[ status (active/inactive) ]</td>
          <td width="304">
          <label>:
          <input name="status" type="text" id="status" value="active"/>
          </label>
          </td>
      </tr>



    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>