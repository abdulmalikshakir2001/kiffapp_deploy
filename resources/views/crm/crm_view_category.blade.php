@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crm_category.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_crm_category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_crm_category_id" id="delete_crm_category_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Category ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_crm_category" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- add crm_category start  -->
    <div class="modal fade" id="add_crm_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="crm_category_form">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- holiday name -->
                        <div class="mb-3 col-md-6">
                          <label for="category_name">Category Name</label>
                          <input type="text" class="form-control" placeholder="Category Name " aria-label="Start Date" name="category_name" id="category_name">
                        </div>
                        
                        
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_crm_category_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Category</button>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <!-- content end  -->

          </div>

        </div>
      </div>
    </div>
    <!-- add job vacncies end  -->
    <!-- update job vacncies start  -->
    <div class="modal fade" id="update_crm_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="crm_category_update_form">
                        <input type="hidden"  name="category_id" id="category_id" value="">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                         <!-- Category name -->
                         <div class="mb-3 col-md-6">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" placeholder="Category Name " aria-label="Start Date" name="category_name" id="category_name">
                          </div>
                        
                        
                        
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_crm_category_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Update Category</button>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <!-- content end  -->

          </div>

        </div>
      </div>
    </div>
    <!-- update job vacncies end  -->



    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_crm_category" style="width: 100%;">
            
            <!-- show message when crm_category   added  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white crm_category_added_msg user_updated_msg" role="alert">
                Category added
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when crm_category   added  start  -->
            <!-- show message when crm_category    updated  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white crm_category_updated_msg user_updated_msg" role="alert">
              Category updated
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when crm_category    updated  start  -->
            <!-- show message when crm_category    deleted start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white crm_category_deleted_msg user_updated_msg" role="alert">
              Category deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   deleted  start  -->
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Category Name</th>
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
$(document).ready(function () {
    // parse html entities start
    function html_decode(input) {
        let parser = new DOMParser().parseFromString(input, "text/html");
        return parser.documentElement.textContent;
    }
    // parse html entities end

    // tiny mce start
        @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp

    // add job vacancies  start
    $("#crm_category_form").validate({
        rules: {
            category_name: {
                required: true,
            },

            
        },
        messages: {
            category_name: {
                required: "Lead Category required",
            },
            
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "category",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#crm_category_form").trigger("reset");
                        $("#view_crm_category").DataTable().ajax.reload();
                        $("#add_crm_category").modal("toggle");
                        $(".crm_category_added_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // add job vaccanices end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_crm_category").DataTable({
          'columnDefs':[
            {'className':'text-center',targets:[2]}

          ],
          dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_crm_category",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "category_name", name: "holiday_name" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".crm_category_delete_btn", function (param) {
         $('#delete_crm_category_id').val($(this).data("delete_crm_category_id"))  ;
        $(".confirm_delete_crm_category").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_crm_category",
                data:$('#delete_form').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_crm_category").DataTable().ajax.reload();
                        $(".crm_category_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".crm_category_edit_btn", function (param) {
        let update_crm_category_id = $(this).data("update_crm_category_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_crm_category",
            data: { update_crm_category_id: update_crm_category_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#crm_category_update_form")
                        .find("#category_id")
                        .val(response.category_id);
                    $("#crm_category_update_form")
                        .find("#category_name")
                        .val(response.category_name);
                    
                }
            },
        });
    });

    $("#crm_category_update_form").validate({
        rules: {
            category_name: {
                required: true,
            },

            
        },
        messages: {
            category_name: {
                required: "Category required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_crm_category",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_crm_category").DataTable().ajax.reload();
                        $(".crm_category_updated_msg").removeClass("d-none");
                        $("#crm_category_update_form").trigger("reset");
                        $('#update_crm_category').modal("toggle")
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_crm_category_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_crm_category_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_crm_category" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end
});

</script>

@endSection