<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment team</title>
</head>
<body>

<table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>               
          <th><center><span class="badge bg-green">id_iin</span></center></th>  
          <th><center><span class="badge bg-brown">id_user</span></center></th>
          <th><center><span class="badge bg-brown">iin_number</span></center></th>
          <th><center><span class="badge bg-brown">iin_established_date</span></center></th>
          <th><center><span class="badge bg-brown">iin_expiry_date</span></center></th>
          <th><center><span class="badge bg-brown">created_date</span></center></th>
          <th><center><span class="badge bg-brown">created_by</span></center></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($iin as $data) 
          { 
          ?>
            <tr>
            <td><center><?php echo $data->id_iin;?></center></td>
            <td><center><?php echo $data->id_user;?></center></td>
            <td><center><?php echo $data->iin_number;?></center></td>
            <td><center><?php echo $data->iin_established_date;?></center></td>
            <td><center><?php echo $data->iin_expiry_date;?></center></td>
            <td><center><?php echo $data->created_date;?></center></td>
            <td><center><?php echo $data->created_by;?></center></td>
            <td>

            </tr>

            <?php } ?>  
            </tbody>
</table>

<form action="<?php echo base_url('dashboard/insert_iin_proses') ?>" method="post">
	<div>
			Silakan Masukkan data asesment team
		</div>
		<div>

			
			<tr>
          <td width="250" height="32">[ id_user ]</td>
          <td width="304">
          <label>:
          <input name="id_user" type="text" id="id_user" value=""/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ iin_number ]</td>
          <td width="304">
          <label>:
          <input name="iin_number" type="text" id="iin_number" value="123456"/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ iin_established_date ]</td>
          <td width="304">
          <label>:
          <input name="iin_established_date" type="text" id="iin_established_date" value="2017-10-03
"/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ iin_expiry_date ]</td>
          <td width="304">
          <label>:
          <input name="iin_expiry_date" type="text" id="iin_expiry_date" value="2017-10-03"/>
          </label>
          </td>
      </tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>