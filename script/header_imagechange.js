$(document).ready(() => {
    $("#profileimg").change(function () {
        const file = this.files[0];
        //console.log("file",file)
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {                
                $("#profileImage")
                    .attr("src", event.target.result);
                // console.log("in profileimage");
                $("#dp")
                    .attr("src", event.target.result);
                // console.log("in profileimage");
                $("#drop_content_Image")
                    .attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});