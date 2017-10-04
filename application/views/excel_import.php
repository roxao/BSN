<?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename = Data Event Marketing.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 <table>
 	<thead>
                      <tr>
                      
                        <th><center><span class="badge bg-green">applicant</span></center></th>
                        <th><center><span class="badge bg-green">instance_name</span></center></th>                        
                        <th><center><span class="badge bg-green">iin_status</span></center></th>
                        <th><center><span class="badge bg-green">application_type</span></center></th>
                        <th><center><span class="badge bg-green">created_date</span></center></th>
                        <th><center><span class="badge bg-green">process_status</span></center></th>
              
             			<th><center><span class="badge bg-brown">Option</span></center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                       <?php
                        
                          foreach($report as $data) 
                          { 
                          ?>
                          <tr>
                            
                          <td><center><?php echo $data->applicant;?></center></td>
                          <td><center><?php echo $data->instance_name;?></center></td>
                          <td><center><?php echo $data->iin_status;?></center></td>
                          <td><center><?php echo $data->application_type;?></center></td>
                          
                           <td>

                           <center> <div class="btn-group">
                    
            
                    </div>  </center></td>
                          </tr>

                        <?php } ?>  
                       
                    </tbody>
 </table>