<div id="the-canvas"></div>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
		

 

<script>
	$(document).ready(function() {
		$('body').bind('cut copy paste',function(e){e.preventDefault()}).on("contextmenu",function(e){e.preventDefault()}).keydown(function(objEvent){objEvent.preventDefault()});
		<?php foreach($file_iso as $data){echo 'implement_pdf("'.base_url().$data->file_url.'");';}?> 


		function implement_pdf(url){
			var currPage=1;var numPages=0;var thePDF=null;PDFJS.getDocument(url).then(function(pdf){thePDF=pdf;numPages=pdf.numPages;pdf.getPage(1).then(handlePages)});function handlePages(page)
			{var viewport=page.getViewport(1.5);var canvas=document.createElement("canvas");canvas.style.display="block";var context=canvas.getContext('2d');canvas.height=viewport.height;canvas.width=viewport.width;page.render({canvasContext:context,viewport:viewport});var target=document.getElementById('the-canvas');target.appendChild(canvas);currPage++;if(thePDF!==null&&currPage<=numPages)
			{thePDF.getPage(currPage).then(handlePages)}}
		};
	});
</script>
<style type="text/css" media="print">
    body {visibility:hidden;display:none}
</style>
