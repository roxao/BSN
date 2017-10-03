<div style="height: 100vh; margin-bottom: -50px; z-index: 0">
	<embed src="http://localhost/BSN/assets/sample.pdf" type="application/pdf" width="100%" height="100%">
</div>
<div style="position: fixed; z-index: 2; top: 0; bottom: 0; left: 0; right: 0">
	
</div>

<script type="text/javascript">
$(document).ready(function () {
    //Disable full page
    $("body").on("contextmenu",function(e){
        return false;
    });
    
    //Disable full page
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
});
</script>
