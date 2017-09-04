<!DOCTYPE html>
<html>
<head>
	<title>Tim Asesment</title>
</head>
<body>
<form>

		<table id="example1" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                      
                        <th><center><span class="badge bg-green">Nama</span></center></th>
              
             			<th><center><span class="badge bg-brown">Option</span></center></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      
                       <?php
                        
                          foreach($data_asesment as $data) 
                          { 
                          ?>
                          <tr>
                          
                          <td><center><?php echo $data->name;?></center></td>

                          
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