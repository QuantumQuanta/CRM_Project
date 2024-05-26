var $r = jQuery.noConflict();

$r(document).ready(function () {
    
    // var form = $('#yourFormId'); 
    var submitButton = $r('#contact_admin_submit'); 


    $r('#contact_admin_ss').on('change', function () {
        var fileInput = $r(this)[0];

        if (fileInput.files.length > 0) {
            var fileName = fileInput.files[0].name;
            var fileExtension = fileName.split('.').pop().toLowerCase();

            var allowedExtensions = ['png', 'gif', 'jpeg', 'jpg'];

            if (allowedExtensions.includes(fileExtension)) {
                submitButton.prop('disabled', false);
            } else {
                submitButton.prop('disabled', true);
                $r('#contact_admin_ss').val("");
                alert('Please select a valid image file.');
            }
        } else {
            submitButton.prop('disabled', false);
        }
    });
});
