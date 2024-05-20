@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/users_groups/css/users_groups.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- Button trigger modal -->
    <!-- Button trigger modal -->
    <!-- modal to assign permissions to groups start  -->
    <div class="modal fade" id="users_groups_permissions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content permission_modal_main" id="permission_modal_main">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Group Name :<span class="group_name"></span> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form role="form" action="" method="post" id="assign_permissions_form">
              <input type="hidden" name="group_id" id="group_id" value>

              @csrf
              <div class="container-fluid p-0">
                <div class="row">
                  @foreach($users_permissions as $user_permission)
                  <div class="mb-3 col-lg-4 col-sm-6">
                    <div class="form-check form-switch">
                      <input class="form-check-input permissions" type="checkbox" id="{{$user_permission->permission_name}}" name="permissions[]" value="{{$user_permission->permission_name}}">
                      <label class="form-check-label" for="{{$user_permission->permission_name}}">{{$user_permission->permission_name}}</label>
                    </div>
                  </div>
                  @endforeach
                  <!-- <div class="text-center">
                    <button type="submit" id="added_users_groups_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Assign Permissions</button>
                  </div> -->
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="added_users_groups_btn" data-bs-dismiss="modal">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- modal to assign permissions to groups end  -->
    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_users_groups" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_users_groups_id" id="delete_users_groups_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Users groups ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_users_groups" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <!-- <div class="card-header pb-0">
              <h6>Authors table</h6>
            </div> -->
      <!-- <div class="add_user_div">
        <a href="{{route('users_groups.create')}}"> <button type="button" class="btn bg-primary btn-sm"> <span class="material-symbols-outlined text-white">
              person_add
            </span></button>
        </a>
      </div> -->


      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">

          <!-- practice start  -->

          <!-- practice end  -->
          <table class="table align-items-center mb-0  hover" id="view_users_groups" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Group Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Permissions</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- content end  -->
  </div>
</div>
@endSection
@section('page_script_links')
<script>
  "use strict";
  $(document).ready(function() {
    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp
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
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "users_groups",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
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
    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#view_users_groups").DataTable({
        processing: true,
        serverSide: true,
        ajax: base_url + "get_data_users_groups",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "group_name",
            name: "group_name"
          },
          {
            data: "permissions",
            name: "permissions"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".users_groups_delete_btn", function(param) {
      $('#delete_users_groups_id').val($(this).data("delete_users_groups_id"));
      $(".confirm_delete_users_groups").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "delete_users_groups",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $("#view_users_groups").DataTable().ajax.reload();
            }
          },
        });
      });
    });
    // delete user end
    // update start
    $(document).on("click", ".users_groups_edit_btn", function(param) {
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
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_users_groups",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $(".user_updated_msg").removeClass("d-none");
            }
          },
        });
      },
    });
    // update end
    // adding permissions to groups start
    $(document).on("click", ".users_groups_permissions", function() {
      // alert($(this).data('groups_id_for_per'))
      let group_id = $(this).data("groups_id_for_per");
      let group_name = $(this).data("group_name_for_permission");
      // send group id to index fun of user groups to show edit switch buttons start 
      $.ajax({
        type: "post",
        url: base_url + "users_groups_edit_per",
        data: {
          group_id: group_id
        },
        dataType: "json",
        success: function(response) {
          console.log(response)
          // alert(response);
          // console.log(response.permissions);
          // console.log( response.permissions.split(','));
          let permission_arr = response.permissions.split(',')
          console.log(permission_arr);
          let permissions = $('.permissions');
          $(permissions).each(function(key, value) {
            // console.log(value)
            let permission_value = $(value).val();
            if (permission_arr.includes(permission_value)) {
              // console.log(permission_value);
              $(value).prop('checked', true)
            } else {
              $(value).prop('checked', false)

            }
          });
        }
      });
      // send group id to index fun of user groups to show edit switch buttons end


      $('.group_name').text(group_name);
      $("#group_id").val(group_id);
      $("#assign_permissions_form").on("submit", function(e) {
        e.preventDefault();

        function sendData(url) {

          $.ajax({
            type: "post",
            url: url,
            data: $("#assign_permissions_form").serialize(),
            dataType: "json",
            success: function(response) {
              $("#view_users_groups").trigger("reset");
              $("#view_users_groups").DataTable().ajax.reload();
              // reset all permission swtihces start
              let all_permissions = $(".permissions");
              $(all_permissions).each(function(key, value) {
                $(value).prop('checked', false)
              });

              // reset all permission swtihces end
              // alert(response);
              // console.log(response);
            },
          });

        }
        sendData(base_url + "assign_per_to_group");

      });
    });

    setTimeout(() => {
      $(document).find('#view_users_groups_filter').append('<span class="add_user_div" ">\
     <a href="' + base_url + "users_groups/create" + '"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
           group_add\
         </span></button>\
     </a>\
   </span>\
')
    }, 1);

    // adding permissions to groups end
    $(document).on('click', function(e) {
      if ($(e.target).parents('#permission_modal_main').attr('id') != "permission_modal_main") {
        $('#assign_permissions_form').trigger('reset');
      }

    })
  });
</script>


@endSection