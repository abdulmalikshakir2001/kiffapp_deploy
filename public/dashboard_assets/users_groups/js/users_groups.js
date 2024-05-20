"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
    // martial status
    $("#company_id").select2({
        placeholder: "Select Company",
        allowClear: true,
        width: "100%",
    });
    // add department start
    $("#users_groups_form").validate({
        rules: {
            group_name: {
                required: true,
            },
            permissions: {
                required: true,
            },
            company_id: {
                required: true,
                number: true,
            },
        },
        messages: {
            group_name: {
                required: "Group name required",
            },
            permissions: {
                required: "Permissions required",
            },
            company_id: {
                required: "Country Required",
                number: "only numbers are allowed",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "users_groups",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $('#users_groups_form').trigger('reset');

                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // add department end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_users_groups").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_users_groups",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "group_name", name: "group_name" },
                { data: "permissions", name: "permissions" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".users_groups_delete_btn", function (param) {
        let delete_users_groups_id = $(this).data("delete_users_groups_id");
        $(".confirm_delete_users_groups").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_users_groups",
                data: { delete_users_groups_id: delete_users_groups_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_users_groups").DataTable().ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".users_groups_edit_btn", function (param) {
        let update_users_groups_id = $(this).data("update_users_groups_id");
        location.replace(
            base_url + "updateUsersGroups/" + update_users_groups_id
        );
    });
    $("#users_groups_updated_form").validate({
        rules: {
            group_name: {
                required: true,
            },
            // permissions: {
            //     required: true,
            // },
            company_id: {
                required: true,
                number: true,
            },
        },
        messages: {
            group_name: {
                required: "Group name required",
            },
            // permissions: {
            //     required: "Permissions required",
            // },
            company_id: {
                required: "Country Required",
                number: "only numbers are allowed",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_users_groups",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
    // update end
    // adding permissions to groups start
    $(document).on("click", ".users_groups_permissions", function () {
        // alert($(this).data('groups_id_for_per'))
        let group_id = $(this).data("groups_id_for_per");
        let group_name = $(this).data("group_name_for_permission");
        // send group id to index fun of user groups to show edit switch buttons start 
        $.ajax({
            type: "post",
            url: base_url+"users_groups_edit_per",
            data: {group_id:group_id},
            dataType: "json",
            success: function (response) {
                console.log(response)
                // alert(response);
                // console.log(response.permissions);
                // console.log( response.permissions.split(','));
                 let permission_arr= response.permissions.split(',')
                 console.log(permission_arr);
                 let permissions= $('.permissions');
                 $(permissions).each(function (key,value) {
                    // console.log(value)
                      let permission_value= $(value).val();
                      if(permission_arr.includes(permission_value)){
                        // console.log(permission_value);
                        $(value).prop('checked',true)
                      }
                      else{
                        $(value).prop('checked',false)

                      }
                   });
            }
        });
        // send group id to index fun of user groups to show edit switch buttons end
        

        $('.group_name').text(group_name);
        $("#group_id").val(group_id);
        $("#assign_permissions_form").on("submit", function (e) {
            e.preventDefault();
            function sendData(url){

            $.ajax({
                type: "post",
                url: url,
                data: $("#assign_permissions_form").serialize(),
                dataType: "json",
                success: function (response) {
                    $("#view_users_groups").trigger("reset");
                    $("#view_users_groups").DataTable().ajax.reload();
                    // reset all permission swtihces start
                    let all_permissions = $(".permissions");
                    $(all_permissions).each(function (key, value) {
                        $(value).prop('checked',false)
                    });

                    // reset all permission swtihces end
                    // alert(response);
                    // console.log(response);
                },
            });

            }
            sendData(base_url+"assign_per_to_group");

        });
    });

    setTimeout(() => {
     $(document).find('#view_users_groups_filter').append('<span class="add_user_div" ">\
     <a href="'+base_url+"users_groups/create"+'"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
           group_add\
         </span></button>\
     </a>\
   </span>\
')
    }, 1);

    // adding permissions to groups end
    $(document).on('click',function(e){
        if($(e.target).parents('#permission_modal_main').attr('id')!="permission_modal_main"){
            $('#assign_permissions_form').trigger('reset');
        }

    })
});
