$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
    $("#gender").select2({
        // dropdownParent: $('#register_form'),
        // dropdownCssClass:'increasezindex',
        placeholder: "Select gender",
        allowClear: true,
        width: "100%",
    });
    // martial status
    $("#company_id").select2({
        placeholder: "Select company",
        allowClear: true,
        width: "100%",
    });
    // martial company_id
    $("#marital_status").select2({
        placeholder: "Martial status",
        allowClear: true,
        width: "100%",
    });
    // country id
    $("#country_id").select2({
        placeholder: "Select Country",
        allowClear: true,
        width: "100%",
    });
    // ui_lang
    $("#ui_language").select2({
        placeholder: "Select Language",
        allowClear: true,
        width: "100%",
    });
    // ui_lang
    $("#user_type").select2({
        placeholder: "User type",
        allowClear: true,
        width: "100%",
    });
    // positon id
    $("#position_id").select2({
        placeholder: "Position",
        allowClear: true,
        width: "100%",
    });
    //deapartment   id
    $("#department_id").select2({
        placeholder: "Department",
        allowClear: true,
        width: "100%",
    });
    //blood group
    $("#blood_group").select2({
        placeholder: "Bloo group",
        allowClear: true,
        width: "100%",
    });

    //
    // add users start
    $("#user_added_form").validate({
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
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            phone_number: {
                required: true,
                number: true,
                maxlength: 15,
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
            
            
            user_type: {
                required: true,
            },
        },
        messages: {
            username: {
                required: "Please Enter Your name",
                remote: "an account with this user name already exist",
            },
            first_name: {
                required: "Enter First Name",
            },
            last_name: {
                required: "Enter Last Name",
            },
            phone_number: {
                required: "Contact required",
                number: "Only numbers are allowed",
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
            
            

            user_type: {
                required: "User Type Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "users",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // alert(response);
                    // console.log( response);
                    if (response == 1) {
                        // alert("user updated successfully")
                        // $('.update_msg').removeClass("d-none");
                        $("#user_added_form").trigger("reset");
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
    // add users end

    // update  user start

    $("#user_update_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                remote: {
                    url: base_url + "is_exist_user_name_for_update",
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
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            phone_number: {
                required: true,
                number: true,
                maxlength: 15,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: base_url + "is_exist_email_for_update",
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

            country_id: {
                required: true,
                number: true,
            },
            position_id: {
                required: true,
                number: true,
            },
            department_id: {
                required: true,
                number: true,
            },
            company_id: {
                required: true,
            },
            user_type: {
                required: true,
            },
        },
        messages: {
            username: {
                required: "Please Enter Your name",
                remote: "an account with this user name already exist",
            },
            first_name: {
                required: "Enter First Name",
            },
            last_name: {
                required: "Enter Last Name",
            },
            phone_number: {
                required: "Contact required",
                number: "Only numbers are allowed",
                maxlength: "Length should be less than 15 charactor",
            },
            email: {
                required: "Email Required",
                email: "Please enter a valid Email",
                remote: "Email already register",
            },

            country_id: {
                required: "Country Required",
                number: "only numbers are allowed",
            },
            position_id: {
                required: "Positin Required",
                number: "only numbers are allowed",
            },
            department_id: {
                required: "Department Required",
                number: "only numbers are allowed",
            },
            company_id: {
                required: "Company required",
            },
            user_type: {
                required: "User Type Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_user",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // alert(response);
                    // console.log( response);
                    if (response.status == 1) {
                        $("#user_update_form").trigger("reset");

                        // alert("user updated successfully")
                        // $('.update_msg').removeClass("d-none");
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // update  user end

    // datatables start

    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_user").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "email", name: "email" },
                { data: "phone_number", name: "phone_number" },
                { data: "gender", name: "gender" },
                { data: "company_name", name: "company_name" },
                { data: "action", name: "action" },
            ],
        });
    });
    // datatables end

    // update user start
    $(document).on("click", ".user_edit_btn", function (param) {
        let update_user_id = $(this).data("update_user_id");
        location.replace(base_url + "updateUser/" + update_user_id);
    });
    // update user end

    // delete user start
    $(document).on("click", ".user_delete_btn", function (param) {
        let delete_user_id = $(this).data("delete_user_id");
        $(".confirm_delete_user").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "deleteUser",
                data: { delete_user_id: delete_user_id },
                dataType: "json",
                success: function (response) {
                    // alert(response)
                    $("#view_user").DataTable().ajax.reload();
                },
            });
        });
    });
    // delete user end

    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document)
            .find("#view_user_filter")
            .append(
                '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary add_user_by_owner btn-sm mb-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
            );
            // check the contstains for company owner to add user start 
             
            $('.add_user_by_owner').on('click',function(){
                $.ajax({
                    type: "post",
                     url:base_url+ "check_user_count",
                    data: "",
                    dataType: "json",
                    success: function (response) {
                        if(response.users_count==5){
                            $('#limited_user_count').modal('show');
                        }
                        else{
                                window.location.replace(base_url+'users/create')
                        }
                        
                    }
                });
            })
            // check the contstains for company owner to add user end
    }, 1);

    // adding button to the create user datatable to add user end

    // adding groups to users start
    $(document).on("click", ".users_groups_assign", function () {
        // alert($(this).data('groups_id_for_per'))
        let user_id_for_groups = $(this).data("user_id_for_groups");
        let user_name = $(this).data("user_name_for_groups");

        // send group id to index fun of user groups to show edit switch buttons start
        $.ajax({
            type: "post",
            url: base_url + "users_edit_groups",
            data: { user_id_for_groups: user_id_for_groups },
            dataType: "json",
            success: function (response) {
                // alert(response);
                console.log(response.groups);
                let group_arr = response.groups.split(",");
                console.log(group_arr);
                let groups = $(".groups");
                $(groups).each(function (key, value) {
                    // console.log(value)
                    let group_value = $(value).val();
                    if (group_arr.includes(group_value)) {
                        // console.log(permission_value);
                        $(value).prop("checked", true);
                    } else {
                        $(value).prop("checked", false);
                    }
                });
            },
        });

        $(".user_name").text(user_name);
        $("#user_id").val(user_id_for_groups);
        $("#assign_groups_form").on("submit", function (e) {
            e.preventDefault();
            function sendData(url) {
                $.ajax({
                    type: "post",
                    url: url,
                    data: $("#assign_groups_form").serialize(),
                    dataType: "json",
                    success: function (response) {
                        // $("#view_users_groups").trigger("reset");
                        $("#view_user").DataTable().ajax.reload();
                        // reset all permission swtihces start
                        let all_groups = $(".groups");
                        $(all_groups).each(function (key, value) {
                            $(value).prop("checked", false);
                        });

                        // reset all permission swtihces end
                        // alert(response);
                        // console.log(response);
                    },
                });
            }
            sendData(base_url + "assign_groups_to_user");
        });
    });

    $(document).on("click", function (e) {
        if (
            $(e.target).parents("#group_assign_main").attr("id") !=
            "group_assign_main"
        ) {
            $("#assign_groups_form").trigger("reset");
        }
    });
    // update user profile start 
    $("#user_profile_udpate_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                // remote: {
                //     url: base_url + "is_exist_user_name_for_update",
                //     type: "post",
                //     data: {
                //         username: function () {
                //             return $("#username").val();
                //         },
                //         user_id: function () {
                //             return $("#user_id").val();
                //         },
                //         _token: $('meta[name="csrf-token"]').attr("content"),
                //     },
                // },
            },
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            phone_number: {
                required: true,
                number: true,
                maxlength: 15,
            },
       

       
        },
        messages: {
            username: {
                required: "Please Enter Your name",
                // remote: "an account with this user name already exist",
            },
            first_name: {
                required: "Enter First Name",
            },
            last_name: {
                required: "Enter Last Name",
            },
            phone_number: {
                required: "Contact required",
                number: "Only numbers are allowed",
                maxlength: "Length should be less than 15 charactor",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_user_profile",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                        $(".user_updated_msg").removeClass("d-none");
                },
            });
        },
    });
    // update user profile end 


    // update job candidate start 
    $("#job_candidate_profile_udpate_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                // remote: {
                //     url: base_url + "is_exist_user_name_for_update",
                //     type: "post",
                //     data: {
                //         username: function () {
                //             return $("#username").val();
                //         },
                //         user_id: function () {
                //             return $("#user_id").val();
                //         },
                //         _token: $('meta[name="csrf-token"]').attr("content"),
                //     },
                // },
            },
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            phone_number: {
                required: true,
                maxlength: 15,
            },
            employee_cv:{
                required: true,
            }
        },
        messages: {
            username: {
                required: "Please Enter Your name",
                // remote: "an account with this user name already exist",
            },
            first_name: {
                required: "Enter First Name",
            },
            last_name: {
                required: "Enter Last Name",
            },
            phone_number: {
                required: "Contact required",
                maxlength: "Length should be less than 15 charactor",
            },
            employee_cv:{
                required: 'please upload your cv  ',

            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_job_candidate_profile",
                data: new FormData(form),
            processData:false,
            contentType:false,
                success: function (response) {
                        $(".resume_sent_msg").removeClass("d-none");
                },
            });
        },
    });
    // update job candidate end 

    // employee start 
      // datatables start

      $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_employee").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_employee",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "email", name: "email" },
                { data: "phone_number", name: "phone_number" },
                { data: "gender", name: "gender" },
                { data: "action", name: "action" },
            ],
        });
    });
    // datatables end
    // employee end 
    
});
