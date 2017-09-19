<!DOCTYPE html>
<html>
<head>
	<title>INBOX</title>
</head>
<body>
<form>

		<table id="example1" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                      
                     <!--    <th><center><span class="badge bg-green">id_application</span></center></th>
                        <th><center><span class="badge bg-green">id_user</span></center></th>
                        <th><center><span class="badge bg-green">id_admin</span></center></th> -->
                        <th><center><span class="badge bg-green">applicant</span></center></th>
                        <!-- <th><center><span class="badge bg-green">applicant_phone_number</span></center></th>
                        <th><center><span class="badge bg-green">application_date</span></center></th> -->
                        <th><center><span class="badge bg-green">instance_name</span></center></th>
                       <!--  <th><center><span class="badge bg-green">instance_email</span></center></th>
                        <th><center><span class="badge bg-green">instance_phone</span></center></th>
                        <th><center><span class="badge bg-green">instance_director</span></center></th>
                        <th><center><span class="badge bg-green">mailing_location</span></center></th>
                        <th><center><span class="badge bg-green">mailing_number</span></center></th> -->
                        <th><center><span class="badge bg-green">iin_status</span></center></th>
                        <th><center><span class="badge bg-green">application_type</span></center></th>
                        <th><center><span class="badge bg-green">created_date</span></center></th>
                        <!-- <th><center><span class="badge bg-green">created_by</span></center></th>
                        <th><center><span class="badge bg-green">last_updated_date</span></center></th>
                        <th><center><span class="badge bg-green">modified_by</span></center></th> -->
                        <th><center><span class="badge bg-green">process_status</span></center></th>
              
             			<th><center><span class="badge bg-brown">Option</span></center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                       <?php
                        
                          foreach($applications as $data) 
                          { 
                          ?>
                          <tr>
                          
                        <!--   <td><center><?php echo $data->id_application;?></center></td>
                          <td><center><?php echo $data->id_user;?></center></td>
                          <td><center><?php echo $data->id_admin;?></center></td> -->
                          <td><center><?php echo $data->applicant;?></center></td>
                          <!-- <td><center><?php echo $data->applicant_phone_number;?></center></td>
                          <td><center><?php echo $data->application_date;?></center></td> -->
                          <td><center><?php echo $data->instance_name;?></center></td>
                 <!--          <td><center><?php echo $data->instance_email;?></center></td>
                          <td><center><?php echo $data->instance_phone;?></center></td>
                          <td><center><?php echo $data->instance_director;?></center></td>
                          <td><center><?php echo $data->mailing_location;?></center></td>
                          <td><center><?php echo $data->mailing_number;?></center></td> -->
                          <td><center><?php echo $data->iin_status;?></center></td>
                          <td><center><?php echo $data->application_type;?></center></td>
                          <td><center><?php echo $data->created_date;?></center></td>
                          <!-- <td><center><?php echo $data->created_by;?></center></td>
                          <td><center><?php echo $data->last_updated_date;?></center></td>
                          <td><center><?php echo $data->modified_by;?></center></td> -->
                          <td><center><?php  echo $data->process_status;?></center></td>
                          
                           <td>

                           <center> <div class="btn-group">
                    
                                            
                     

                          
               <a href="<?php echo base_url() ?>Admin_controller/edit_aplication/<?=$data->id_application?>">Edit</a>
               <a href="<php echo base_url() ?>">setujui</a>      
              
                    </div>  </center></td>
                          </tr>

                        <?php } ?>  
                       
                    </tbody>
                   
          
                  </table>
                  <a href="<?php echo base_url('admin_controller/homedds') ?>">home</a>
</form>
</body>
</html>