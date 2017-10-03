<div id="the-canvas"></div>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
var url='<?php echo $file_iso ?>';
var currPage=1;var numPages=0;var thePDF=null;PDFJS.getDocument(url).then(function(pdf){thePDF=pdf;numPages=pdf.numPages;pdf.getPage(1).then(handlePages)});function handlePages(page)
{var viewport=page.getViewport(1.5);var canvas=document.createElement("canvas");canvas.style.display="block";var context=canvas.getContext('2d');canvas.height=viewport.height;canvas.width=viewport.width;page.render({canvasContext:context,viewport:viewport});var target=document.getElementById('the-canvas');target.appendChild(canvas);currPage++;if(thePDF!==null&&currPage<=numPages)
{thePDF.getPage(currPage).then(handlePages)}}
</script>
<script type="text/javascript">
$(document).ready(function () {
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>
