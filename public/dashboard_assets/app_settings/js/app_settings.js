"use strict";
$(document).ready(function () {
    const base_url="http://127.0.0.1:8000/";

    $('#change_app_logo_form').on('submit',function (e) {  
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"update_app_logo",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function (response) {
                if(response==true){
                    location.reload();
                    // $('.user_updated_msg').removeClass('d-none');
                }
                
            }
        });
    })
    // disapper logo msg 
    
});