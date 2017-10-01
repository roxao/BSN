<!DOCTYPE html>
<html>
<head>
    <title>cek bukti transfer
    </title>
</head>
<body>

<p><h1>INPUT TIM ASESMENT</h1></p>
<form action="<?php echo base_url('admin_verifikasi_controller/FIELD_ASSESS_REQ_SUCCEST') ?>" method="post">



    <?php
        foreach($aplication_setujui as $data)
        {
    ?>
    
    <div class="form-group">
        <label for="exampleInputPassword1">id_application_status</label>
        <input type="text" name="id_application_status"  class="form-control" value="<?php echo $data->id_application_status; ?>" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">id_application</label>
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

       <div class="form-group">
        <label for="exampleInputPassword1">process_status</label>
        <input type="text" name="process_status"  class="form-control" value="<?php echo $data->process_status; ?>" required>
    </div>

     </div>

    <div class="form-group">
        <label for="exampleInputPassword1">applicant_phone_number</label>
        <input type="text" name="applicant_phone_number"  class="form-control" value="<?php echo $data->applicant_phone_number; ?>" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">instance_director</label>
        <input type="text" name="instance_director"  class="form-control" value="<?php echo $data->instance_director; ?>" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">iin_status</label>
        <input type="text" name="iin_status"  class="form-control" value="<?php echo $data->iin_status; ?>" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">created_date</label>
        <input type="text" name="created_date"  class="form-control" value="<?php echo $data->created_date; ?>" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">created_by</label>
        <input type="text" name="created_by"  class="form-control" value="<?php echo $data->created_by; ?>" required>
    </div>

    
    
    <input type="submit" name="setujui" value="setujui" class="btn btn-success"/>

    <?php
        } 
    ?>  

</form>
</body>
</html>