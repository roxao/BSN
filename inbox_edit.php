<!DOCTYPE html>
<html>
<head>
	<title>form edit inbox</title>
</head>
<body>
<form action="<?php echo base_url('inbox_edit_proses') ?>" method="post">
	<?php
    	foreach($aplication as $data)
    	{
    ?>
    
    <div class="form-group">
        <label for="exampleInputPassword1">applicant</label>
        <input type="text" name="id_application"  class="form-control" value="<?php echo $data->id_application; ?>" required>
    </div>

	<div class="form-group">
        <label for="exampleInputPassword1">applicant</label>
        <input type="text" name="applicant"  class="form-control" value="<?php echo $data->applicant; ?>" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">instance_name</label>
        <input type="text" name="instance_name"  class="form-control" value="<?php echo $data->instance_name; ?>" required>
    </div>
    <input type="submit" name="update" value="update" class="btn btn-success"/>
    <?php
    	} 
    ?>  

</form>
</body>
</html>