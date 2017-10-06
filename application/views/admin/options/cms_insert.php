<!DOCTYPE html>
<html>
<head>
	<title>supper admin asesment team</title>
</head>
<body>

<table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>               
          <th><center><span class="badge bg-green">id_cms</span></center></th>  
          <th><center><span class="badge bg-brown">content</span></center></th>
          <th><center><span class="badge bg-brown">title</span></center></th>
          <th><center><span class="badge bg-brown">url</span></center></th>
          <th><center><span class="badge bg-brown">created_date</span></center></th>
          <th><center><span class="badge bg-brown">created_by</span></center></th>
          <th><center><span class="badge bg-brown">modified_date</span></center></th>
          <th><center><span class="badge bg-brown">modified_by</span></center></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach($cms as $data) 
          { 
          ?>
            <tr>
            <td><center><?php echo $data->id_cms;?></center></td>
            <td><center><?php echo $data->content;?></center></td>
            <td><center><?php echo $data->title;?></center></td>
            <td><center><?php echo $data->url;?></center></td>
            <td><center><?php echo $data->created_date;?></center></td>
            <td><center><?php echo $data->created_by;?></center></td>
            <td><center><?php echo $data->modified_date;?></center></td>
            <td><center><?php echo $data->modified_by;?></center></td>
            <td>

            </tr>

            <?php } ?>  
            </tbody>
</table>

<form action="<?php echo base_url('dashboard/insert_cms_proses') ?>" method="post">
	<div>
			Silakan Masukkan data asesment team
		</div>
		<div>

			
<!-- 			<tr>
          <td width="250" height="32">[ content ]</td>
          <td width="304">
          <label>:
          <input name="content" type="text" id="content" value=""/>
          </label>
          </td>
      </tr> -->

      <tr>
          <td width="250" height="32">[ title ]</td>
          <td width="304">
          <label>:
          <input name="title" type="text" id="title" value=""/>
          </label>
          </td>
      </tr>

      <tr>
          <td width="250" height="32">[ url ]</td>
          <td width="304">
          <label>:
          <input name="url" type="text" id="url" value=""/>

          </label>
          </td>
      </tr>

      
      <textarea class='test' name="content" > </textarea>
                <script src="https://cloud.tinymce.com/dev/tinymce.min.js?apiKey=qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc"></script>
  <script>tinymce.init({
  selector: '.test',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    'http://fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    
  ]
 });</script>

      

      


    	<button type="insert" name="insert" value="insert">insert</button>
		</div>
</form>

</body>
</html>