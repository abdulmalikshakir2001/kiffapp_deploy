"use strict";
$(document).ready(function () {
    const base_url="http://127.0.0.1:8000/"
    $("#change_password_form").validate({
        rules: {
            old_password: {
                required: true,
                // remote:base_url+'register_user'
                remote: {
                    url: base_url + "check_password",
                    type: "post",
                    data: {
                        old_password: function () {
                            return $("#old_password").val();
                        },
                        
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                },
            },
            'new_password':{
                required:true
            },
            'new_password_confirmation':{
                required:true,
                equalTo:'#new_password'
            }
           
           
        },
        messages: {
       
            old_password: {
                required: "Old password Required",
                remote:"Old password is incorrect",
            },
            new_password: {
                required: "New password Required",
            },
            new_password_confirmation: {
                required: " confirmation  Required",
                equalTo:"Entered password not matched with the new password"
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_password",
                data: $('#change_password_form').serialize(),
                // dataType: "json",
                success: function (response) {
                    // alert(response);
                    // console.log( response);
                    if (response) {
                        $('#change_password_form').trigger('reset')
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    
});