@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/users_groups/css/users_groups.css')}}">
@endSection
@section('body_content')














@if(session()->get('company_id')==1)
<div class="row">
  <div class="col-md-12">
      <form action="" id="users_groups_updated_form">
        <input type="hidden" name="group_id" id="group_id" value="{{$single_users_groups->group_id}}">
          @csrf
          <div class="container-fluid profile">
              <div class="row gy-4 profile_row">
                  <!--  lable div end  -->
                  <div class="col-md-12">
                      <div class="parent">
                          <div class="row">
                              <div class="col-md-4">
                                  <h5 class="">Update Groups</h5>
                              </div>
                              <div class="col-md-8">
                                  <div class="alert alert-success  d-none text-white crmLeadAddedMessage user_updated_msg"
                                      role="alert" id="crmLeadaddedMessage">
                                      Group Update successfully
                                      <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- lable div end  -->




                  <!-- user information start  -->
                  <div class="col-md-12">
                      <div class="parent">
                          <h5 class="">Group Information</h5>
                          <div class="row gy-3">
                              <div class="col-md-6">
                                <label for="">Group Name</label>
                                <input type="text" class="form-control" placeholder="Users  Groups" aria-label="Users Groups" name="group_name" id="group_name"
                                value="{{$single_users_groups->group_name}}"
                                >
                              </div>


                              <div class="col-md-6">
                                <label for="company_id">Company Name </label>
                                <select name="company_id" id="company_id" class="form-select company_id">
                                    <option></option>
                                    @foreach ($all_companies as $company)
                                        <option value="{{ $company->company_id }}" {{$single_users_groups->company_id==$company->company_id?'selected':''}}>{{ $company->company_name}}</option>
                                    @endforeach
                                </select>

                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- user information end  -->

                  <!-- button start  -->
                  <div class="col-md-12"></div>
                    <div class="parent">
                        <div class="row justify-content-end">
                            <div class="col-md-2">

                                <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Update
                                    </button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- button end  -->


                  
              </div>
          </div>
      </form>

  </div>
</div>
@else

<div class="row">
  <div class="col-md-12">
      <form action="" id="users_groups_updated_form">
        <input type="hidden" name="group_id" id="group_id" value="{{$single_users_groups->group_id}}">
        <input type="hidden" id="company_id" name="company_id" value="{{session()->get('company_id')}}">
          @csrf
          <div class="container-fluid profile">
              <div class="row gy-4 profile_row">
                  <!--  lable div end  -->
                  <div class="col-md-12">
                      <div class="parent">
                          <div class="row">
                              <div class="col-md-4">
                                  <h5 class="">Update Groups</h5>
                              </div>
                              <div class="col-md-8">
                                  <div class="alert alert-success  d-none text-white crmLeadAddedMessage user_updated_msg"
                                      role="alert" id="crmLeadaddedMessage">
                                      Group Updated successfully
                                      <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- lable div end  -->




                  <!-- user information start  -->
                  <div class="col-md-12">
                      <div class="parent">
                          <h5 class="">Group Information</h5>
                          <div class="row gy-3">
                              <div class="col-md-6">
                                <label for="">Group Name</label>
                                <input type="text" class="form-control" placeholder="Users  Groups" aria-label="Users Groups" name="group_name" id="group_name"
                                value="{{$single_users_groups->group_name}}"
                                >
                              </div>

                              <div class="col-md-2">
                                <label for=""></label>
                                <button type="submit" class="btn btn-primary  w-100" id="added_users_groups_btn">Update
                                </button>
                              </div>
                              

                              
                          </div>
                      </div>
                  </div>
                  <!-- user information end  -->


                  
              </div>
          </div>
      </form>

  </div>
</div>

@endif

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
   
    // add department start
   


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


      },
      messages: {
        group_name: {
          required: "Group name required",
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
              window.scrollTo(0,0)
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