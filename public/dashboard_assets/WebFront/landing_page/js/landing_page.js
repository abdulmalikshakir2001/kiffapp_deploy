$(document).ready(function () {
    const base_url="http://127.0.0.1:8000/";
    // add users start
    $("#register_job_candidate_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                remote: {
                    url: base_url + "is_exist_user_name",
                    type: "post",
                    data: {
                        username: function () {
                            return $("#username").val();
                        },
                        user_id: function () {
                            return $("#user_id").val();
                        },
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                },
            },

            email: {
                required: true,
                email: true,
                remote: {
                    url: base_url + "is_exist_email",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val();
                        },
                        user_id: function () {
                            return $("#user_id").val();
                        },
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                },
            },
            password: {
                required: true,
            },
            phone_number:{
                required: true,
                maxlength:15
            },
            password_confirmation:{
                required:true,
                equalTo:'#password'
            }

        },
        messages: {
            username: {
                required: "Please Enter Your name",
                remote: "an account with this user name already exist",
            },
            
            phone_number: {
                required: "Contact required",
                maxlength: "Length should be less than 15 charactor",
            },
            email: {
                required: "Email Required",
                email: "Please enter a valid Email",
                remote: "Email already register",
            },
            password: {
                required: "Password Required",
            },
            password_confirmation:{
                required:"Confirmation required",
                equalTo:"password and Confirm password does'nt match",
            }
            
            
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url+"register_job_cand",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response == "allow_active_is_1") {
                        location.replace(base_url+"job_candite_profile_form");
                    }
                },
            });
        },
    });
    // add users end
});