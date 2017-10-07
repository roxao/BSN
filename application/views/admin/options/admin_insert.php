<!DOCTYPE html>
<html>
<head>
	<title>supper admin </title>
</head>
<body>
<table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>               
          <th><center><span class="badge bg-green">id_admin</span></center></th>  
          <th><center><span class="badge bg-brown">email</span></center></th>
          <th><center><span class="badge bg-brown">username</span></center></th>
          <th><center><span class="badge bg-brown">password</span></center></th>
          <th><center><span class="badge bg-brown">admin_status</span></center></th>
          <th><center><span class="badge bg-brown">admin_role</span></center></th>
          <th><center><span class="badge bg-brown">created_date</span></center></th>
          <th><center><span class="badge bg-brown">created_by</span></center></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($data_admin as $data) 
          { 
          ?>
            <tr>
            <td><center><?php echo $data->id_admin;?></center></td>
            <td><center><?php echo $data->email;?></center></td>
            <td><center><?php echo $data->username;?></center></td>
            <td><center><?php echo $data->password;?></center></td>
            <td><center><?php echo $data->admin_status;?></center></td>
            <td><center><?php echo $data->admin_role;?></center></td>
            <td><center><?php echo $data->created_date;?></center></td>
            <td><center><?php echo $data->created_by;?></center></td>
            <td>

            </tr>

            <?php } ?>  
            </tbody>
</table>





<form action="<?php echo base_url('dashboard/insert_admin_proses') ?>" method="post">
	<div>
			Silakan Masukkan data admin atau super admin
		</div>
		<div>

			<tr>
      		<td width="250" height="32">[ email ]</td>
      		<td width="304">
          <label>:
          <input name="email" type="text" id="email" value="ifandimaulana05@gmail.com"/>
     		  </label>
          </td>
    	</tr>

        <tr>
          <td width="250" height="32">[ username ]</td>
          <td width="304">
          <label>:
          <input name="username" type="text" id="username" value="Santosa"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ password ]</td>
          <td width="304">
          <label>:
          <input name="password" type="text" id="password" value="123"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ admin_status ]</td>
          <td width="304">
          <label>:
          <input name="admin_status" type="text" id="admin_status" value="1"/>
          </label>
          </td>
      </tr>

        <tr>
          <td width="250" height="32">[ admin_role ]</td>
          <td width="304">
          <label>:
          <input name="admin_role" type="text" id="admin_role" value="1"/>
          </label>
          </td>
      </tr>

    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>
