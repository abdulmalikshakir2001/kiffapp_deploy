@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/create_user.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- show modals to see users all details start -->
    <div class="modal fade" id="user_view_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal_full_width">
        <div class="modal-content" id="group_assign_main">
          <div class="modal-header">
            <h5 class="modal-title font_roboto" id="exampleModalLabel">Users Information<span class="user_name"></span> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="container-fluid " id="user_details"> 
              <div class="row gy-4">



                <!-- personal information start  -->
                <div class="col-md-8">
                  <div class="">
                    <h5 class="font_roboto">Profile Information</h5>
                    <div class="row">

                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">User Name:</h6> <span class="font_roboto view_username">Malik</span>

                      </div>
                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">First Name:</h6> <span class="font_roboto view_first_name">Malik</span>

                      </div>
                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">Last Name:</h6> <span class="font_roboto view_last_name">Malik</span>

                      </div>
                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">Middle Name:</h6> <span class="font_roboto view_middle_name">Malik</span>

                      </div>

                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">Email:</h6> <span class="font_roboto view_email">Malik</span>

                      </div>

                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">Mobile Number:</h6> <span class="font_roboto view_mobile_number">Malik</span>
                      </div>
                      <div class="col-md-4">
                        <h6 class="font_roboto d-inline-block">Phone Number:</h6> <span class="font_roboto view_phone_number">Malik</span>
                      </div>

                    </div>

                  </div>
                </div>
                <!-- personal information start   -->

                <!-- logo start  -->
                <div class="col-md-4">
                  <div class="h-100">
                    <h5 class="font_roboto text-center">User Photo</h5>
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{asset('storage/app_logo/Screenshot (2).png')}}" class=" view_profile_logo" alt="No image" style="width:100px;height:100px;border-radius:10px">

                      </div>

                    </div>
                  </div>
                </div>
                <!-- logo end  -->
                <hr>

                <!-- address information start  -->
                <div class="col-md-12">
                  <div class="">
                    <h5 class="font_roboto">Address Information</h5>
                    <div class="row">
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Address:</h6> <span class="font_roboto view_address">Malik</span>

                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Zip Code:</h6> <span class="font_roboto view_zip_code">Malik</span>

                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">City:</h6> <span class="font_roboto view_city">Malik</span>

                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">State:</h6> <span class="font_roboto view_state">Malik</span>

                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Landmark:</h6> <span class="font_roboto view_landmark">Malik</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- address information end  -->

                <hr>



                <div class="col-md-12">
                  <div class="">
                    <h5 class="font_roboto">More Information</h5>
                    <div class="row">
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Facebook Link:</h6> <span class="font_roboto view_facebook_link">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Twitter Link:</h6> <span class="font_roboto view_twitter_link">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Language:</h6> <span class="font_roboto view_language">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Blood Group:</h6> <span class="font_roboto view_blood_group">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Marital Status:</h6> <span class="font_roboto view_marital_status">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Social Media 1:</h6> <span class="font_roboto view_social_media_1">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Social Media 2:</h6> <span class="font_roboto view_social_media_2">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Social Media 3:</h6> <span class="font_roboto view_social_media_3">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Social Media 4:</h6> <span class="font_roboto view_social_media_4">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 1:</h6> <span class="font_roboto view_custom_field_1">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 2:</h6> <span class="font_roboto view_custom_field_2">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 3:</h6> <span class="font_roboto view_custom_field_3">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 4:</h6> <span class="font_roboto view_custom_field_4">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 5:</h6> <span class="font_roboto view_custom_field_5">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 6:</h6> <span class="font_roboto view_custom_field_6">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 7:</h6> <span class="font_roboto view_custom_field_7">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 8:</h6> <span class="font_roboto view_custom_field_8">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 9:</h6> <span class="font_roboto view_custom_field_9">Malik</span>
                      </div>
                      <div class="col-md-3">
                        <h6 class="font_roboto d-inline-block">Custom Field 10:</h6> <span class="font_roboto view_custom_field_10">Malik</span>
                      </div>

                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="">
                    <h5 class="font_roboto "></h5>
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-end">
                      
                      <button type="button" name="" id="" class="btn btn-primary btn-sm font_roboto letter-spacing print_user_detail"><i class="fas fa-print"></i> Print</button>

                      </div>

                    </div>
                  </div>
                </div>















              </div>
            </div>










          </div>
        </div>
      </div>
    </div>

    <!-- show modals to see users all details end -->



    <!-- show msg on count greater than 5 for buisness owner -->
    <div class="modal fade" id="limited_user_count" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Please Upgrade the subscription to add Users.
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ok</button>
          </div>
        </div>
      </div>
    </div>


    <!-- show msg on count greater than 5 for buisness owner end -->
    <!-- Button trigger modal -->
    <!-- Button trigger modal -->
    <!-- modal to assign groups to end start  -->
    <div class="modal fade" id="users_groups_assign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="group_assign_main">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Group Name :<span class="user_name"></span> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form role="form" action="" method="post" id="assign_groups_form">
              <input type="hidden" name="user_id" id="user_id" value>

              @csrf
              <div class="container-fluid p-0">
                <div class="row">
                  @foreach($users_groups as $user_group)
                  <div class="mb-3 col-lg-4 col-sm-6">
                    <div class="form-check form-switch">
                      <input class="form-check-input groups" type="checkbox" id="{{$user_group->group_name}}" name="groups[]" value="{{$user_group->group_name}}">
                      <label class="form-check-label" for="{{$user_group->group_name}}">{{$user_group->group_name}}</label>
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
    <!-- modal to assign groups to users end  -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_user_id" id="delete_user_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this User ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_user" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <!-- <div class="card-header pb-0">
              <h6>Authors table</h6>
            </div> -->

      <div class="card-body px-0 pt-0 pb-2">
        <!-- modal start  -->
        <!-- Button trigger modal -->







        <!-- botton to add user  -->

        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_user" style="width: 100%;">


            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">User Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Phone</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Gender</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">company Name</th>
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
<!-- <script src="{{asset('dashboard_assets/create_update_user/js/create_user.js')}}"></script> -->
<script>
  $(document).ready(function() {

    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp

    //  base_url = "http://127.0.0.1:8000/";
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
              username: function() {
                return $("#username").val();
              },
              user_id: function() {
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
              email: function() {
                return $("#email").val();
              },
              user_id: function() {
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
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "users",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
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
              username: function() {
                return $("#username").val();
              },
              user_id: function() {
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
              email: function() {
                return $("#email").val();
              },
              user_id: function() {
                return $("#user_id").val();
              },
              _token: $('meta[name="csrf-token"]').attr("content"),
            },
          },
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


        user_type: {
          required: "User Type Required",
        },
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_user",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
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

    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#view_user").DataTable({
        processing: true,
        serverSide: true,
        ajax: base_url + "get_data",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "email",
            name: "email"
          },
          {
            data: "phone_number",
            name: "phone_number"
          },
          {
            data: "gender",
            name: "gender"
          },
          {
            data: "company_name",
            name: "company_name"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end


    // update user start
    $(document).on("click", ".user_edit_btn", function(param) {
      let update_user_id = $(this).data("update_user_id");
      location.replace(base_url + "updateUser/" + update_user_id);
    });
    // update user end

    // delete user start
    $(document).on("click", ".user_delete_btn", function(param) {
     $('#delete_user_id').val($(this).data("delete_user_id"))    ;
      $(".confirm_delete_user").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "deleteUser",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
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
                     <button type="button" class="btn bg-primary add_user_by_owner btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 

      $('.add_user_by_owner').on('click', function() {
        $.ajax({
          type: "post",
          url: base_url + "check_user_count",
          data: "",
          dataType: "json",
          success: function(response) {
            if (response.users_count == 5) {
              $('#limited_user_count').modal('show');
            } else {
              window.location.replace(base_url + 'users/create')
            }

          }
        });
      })
      // check the contstains for company owner to add user end
    }, 1);

    // adding button to the create user datatable to add user end

    // adding groups to users start
    $(document).on("click", ".users_groups_assign", function() {
      // alert($(this).data('groups_id_for_per'))
      let user_id_for_groups = $(this).data("user_id_for_groups");
      let user_name = $(this).data("user_name_for_groups");

      // send group id to index fun of user groups to show edit switch buttons start
      $.ajax({
        type: "post",
        url: base_url + "users_edit_groups",
        data: {
          user_id_for_groups: user_id_for_groups
        },
        dataType: "json",
        success: function(response) {
          // alert(response);
          console.log(response.groups);
          let group_arr = response.groups.split(",");
          console.log(group_arr);
          let groups = $(".groups");
          $(groups).each(function(key, value) {
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
      $("#assign_groups_form").on("submit", function(e) {
        e.preventDefault();

        function sendData(url) {
          $.ajax({
            type: "post",
            url: url,
            data: $("#assign_groups_form").serialize(),
            dataType: "json",
            success: function(response) {
              // $("#view_users_groups").trigger("reset");
              $("#view_user").DataTable().ajax.reload();
              // reset all permission swtihces start
              let all_groups = $(".groups");
              $(all_groups).each(function(key, value) {
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

    $(document).on("click", function(e) {
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
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_user_profile",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
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
        employee_cv: {
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
        employee_cv: {
          required: 'please upload your cv  ',

        }
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_job_candidate_profile",
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(response) {
            $(".resume_sent_msg").removeClass("d-none");
          },
        });
      },
    });
    // update job candidate end 

    // employee start 
    // datatables start

    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#view_employee").DataTable({
        processing: true,
        serverSide: true,
        ajax: base_url + "get_data_employee",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "email",
            name: "email"
          },
          {
            data: "phone_number",
            name: "phone_number"
          },
          {
            data: "gender",
            name: "gender"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    // employee end 

    // view user details start 

    $(document).on('click', '.user_view_details_butt', function(param) {
      // alert('user button to fetch single user data for view clicked')
      let user_id = $(this).data('user_id');
      // alert(user_id)
      $.ajax({
        type: "post",
        url: base_url + "fetchSingleUser",
        data: {
          user_id: user_id
        },
        dataType: "json",
        success: function(response) {
          if (response) {
            $('#user_view_details_modal').modal('show')
            setTimeout(() => {
              $('.view_username').text(response.username)
              $('.view_first_name').text(response.first_name)
              $('.view_last_name').text(response.last_name)
              $('.view_middle_name').text(response.middle_names)
              $('.view_phone_number').text(response.phone_number)
              $('.view_mobile_number').text(response.mobile_number)
              if (response.profile_logo) {

                $('.view_profile_logo').attr('src', base_url + "storage/profile_logo/" + response.profile_logo)
              } else {
                $('.view_profile_logo').attr('src', base_url + "storage/profile_logo/default.png")


              }
              $('.view_email').text(response.email)
              $('.view_address').text(response.address)
              $('.view_zip_code').text(response.zip_code)
              $('.view_city').text(response.city)
              $('.view_state').text(response.state)
              $('.view_landmark').text(response.landmark)
              $('.view_facebook_link').text(response.fb_link)
              $('.view_twitter_link').text(response.twitter_link)
              $('.view_language').text(response.ui_language)
              $('.view_blood_group').text(response.blood_group)
              $('.view_marital_status').text(response.marital_status)
              $('.view_social_media_1').text(response.social_media_1)
              $('.view_social_media_2').text(response.social_media_2)
              $('.view_social_media_3').text(response.social_media_3)
              $('.view_social_media_4').text(response.social_media_4)
              $('.view_custom_field_1').text(response.custom_field_1)
              $('.view_custom_field_2').text(response.custom_field_2)
              $('.view_custom_field_3').text(response.custom_field_3)
              $('.view_custom_field_4').text(response.custom_field_4)
              $('.view_custom_field_5').text(response.custom_field_5)
              $('.view_custom_field_6').text(response.custom_field_6)
              $('.view_custom_field_7').text(response.custom_field_7)
              $('.view_custom_field_8').text(response.custom_field_8)
              $('.view_custom_field_9').text(response.custom_field_9)
              $('.view_custom_field_10').text(response.custom_field_10)

              if ($('.modal-backdrop').hasClass('show')) {
                $('.sidenav').css({
                  'z-index': 0
                })
              }

            }, 100);

          }

        }
      });
    })

    // view user details end 

    // print user detail start 
    $('.print_user_detail').on("click",function (param) { 
      let body= document.getElementById('body').innerHTML;
      let  userDetails=document.getElementById('user_details').innerHTML
      document.querySelector('body').innerHTML=userDetails
      window.print()
      document.getElementById('body').innerHTML=body
      

     })
    // print user detail end 

  });
</script>
@endSection