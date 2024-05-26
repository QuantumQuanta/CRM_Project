var $n = jQuery.noConflict();
$n(document).ready(function(e){
    var tblObj = {
        data:'go'
    }
    $n.ajax({
        url: '../action/cReq_config.php',
        type: 'POST',
        data:tblObj,
        dataType: 'JSON',
        success: function(){
            
        }
    })
});
