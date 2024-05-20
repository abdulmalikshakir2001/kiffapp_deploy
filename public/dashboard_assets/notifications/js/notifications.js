"use strict";
$(document).ready(function () {
    const base_url="http://127.0.0.1:8000/";
    $('#email_on_off_form').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"on_off_email",
            data: $('#email_on_off_form').serialize(),
            success: function (response) {
                if(response){
                    $('.user_updated_msg').removeClass('d-none');
                }
                
            }
        });
    })
});