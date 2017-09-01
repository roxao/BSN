<!DOCTYPE html>
<html>
<head>
	<title>data User</title>
</head>
<body>
<form>

		<table id="example1" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                      
                        <th><center><span class="badge bg-green">id_user</span></center></th>
                        <th><center><span class="badge bg-green">email</span></center></th>
                        <th><center><span class="badge bg-green">username</span></center></th>
                        <th><center><span class="badge bg-green">password</span></center></th>
                        <th><center><span class="badge bg-green">name</span></center></th>
                        <th><center><span class="badge bg-green">status_user</span></center></th>
                        <th><center><span class="badge bg-green">survey_status</span></center></th>
                        <th><center><span class="badge bg-green">created_date</span></center></th>
                        <th><center><span class="badge bg-green">created_by</span></center></th>
                        <th><center><span class="badge bg-green">last_updated_date</span></center></th>
                        <th><center><span class="badge bg-green">modified_by</span></center></th>
              
             			<th><center><span class="badge bg-brown">Option</span></center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                       <?php
                        
                          foreach($data_user as $data) 
                          { 
                          ?>
                          <tr>
                          
                          <td><center><?php echo $data->id_user;?></center></td>
                          <td><center><?php echo $data->email;?></center></td>
                          <td><center><?php echo $data->username;?></center></td>
                          <td><center><?php echo $data->password;?></center></td>
                          <td><center><?php echo $data->name;?></center></td>
                          <td><center><?php echo $data->status_user;?></center></td>
                          <td><center><?php echo $data->survey_status;?></center></td>
                          <td><center><?php echo $data->created_date;?></center></td>
                          <td><center><?php echo $data->created_by;?></center></td>
                          <td><center><?php echo $data->last_update_date;?></center></td>
                          <td><center><?php echo $data->modified_by;?></center></td>
                          
                           <td>

                           <center> <div class="btn-group">
                    
                      <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>Aksi
                      </button>
                        
                      <ul class="dropdown-menu" role="menu">

                          
               <li><a href="">Edit</a></li>
               <li><a href="">Hapus</a></li>
      
              </ul>
                    </div>  </center></td>
                          </tr>

                        <?php } ?>  
                       
                    </tbody>
                   
          
                  </table>
                  <a href="<?php echo base_url('admin_controller/homedds') ?>">home</a>
</form>
</body>
</html>