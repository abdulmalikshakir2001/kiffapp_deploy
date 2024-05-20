@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/subscriptions/css/subscriptions.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                      <!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="delete_confirm_subscriptions" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        Are You sure to delete this subscriptions ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary confirm_delete_subscriptions" data-bs-dismiss="modal">Confirm</button>
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
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0  hover" id="view_subscriptions" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Package Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Company Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Start date </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">end date </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Trial end date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Price</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">is active</th>
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
  @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp
    // company id
    $("#company_id").select2({
        placeholder: "Select Company",
        allowClear: true,
        width: "100%",
    });
    // package  id
    $("#package_id").select2({
        placeholder: "Select Package",
        allowClear: true,
        width: "100%",
    });
    // package  id
    $("#status").select2({
        placeholder: "Select Status",
        allowClear: true,
        width: "100%",
    });
    // add department start
    $("#subscriptions_form").validate({
        rules: {
            package_id: {
                required: true,
                number: true,

            },
            company_id: {
                required: true,
                number: true,
            },
            start_date:{
                required:true
            },
            end_date:{
                required:true
            },
            trial_ends_date:{
                required:true
            },
            price:{
                required:true,
                number:true

            },
            status:{
                required:true
            },
            
        },
        messages: {
            package_id: {
                required: "This field is required",
                number: "only numbers are allowed",

            },
            company_id: {
                required: "This field is required",
                number: "only numbers are allowed",
            },
            start_date:{
                required:"This field is required"
            },
            end_date:{
                required:"This field is required"
            },
            trial_ends_date:{
                required:"This field is required"
            },
            price:{
                required:"This field is required",
                number:"only integers are allowed"

            },
            status:{
                required:"Status required"
            },
 
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "subscriptions",
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

    // add department end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_subscriptions").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_subscriptions",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "package_name", name: "package_name" },
                { data: "company_name", name: "company_name" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "trial_ends_date", name: "trial_ends_date" },
                { data: "price", name: "price" },
                { data: "status", name: "status" },
                { data: "is_active", name: "is_active" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".subscriptions_delete_btn", function (param) {
        let delete_subscriptions_id = $(this).data("delete_subscriptions_id");
        $(".confirm_delete_subscriptions").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_subscriptions",
                data: { delete_subscriptions_id: delete_subscriptions_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_subscriptions")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".subscriptions_edit_btn", function (param) {
        let update_subscriptions_id = $(this).data("update_subscriptions_id");
        location.replace(base_url + "updateSubscriptions/" + update_subscriptions_id);
    });
    $("#subscriptions_updated_form").validate({
        rules: {
            package_id: {
                required: true,
                number: true,

            },
            company_id: {
                required: true,
                number: true,
            },
            start_date:{
                required:true
            },
            end_date:{
                required:true
            },
            trial_ends_date:{
                required:true
            },
            price:{
                required:true,
                number:true

            },
            status:{
                required:true
            },
            
        },
        messages: {
            package_id: {
                required: "This field is required",
                number: "only numbers are allowed",

            },
            company_id: {
                required: "This field is required",
                number: "only numbers are allowed",
            },
            start_date:{
                required:"This field is required"
            },
            end_date:{
                required:"This field is required"
            },
            trial_ends_date:{
                required:"This field is required"
            },
            price:{
                required:"This field is required",
                number:"only integers are allowed"

            },
            status:{
                required:"Status required"
            },
 
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_subscriptions",
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
    setTimeout(() => {
        $(document).find('#view_subscriptions_filter').append('<span class="add_user_div" ">\
        <a href="'+base_url+"subscriptions/create"+'"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              subscriptions\
            </span></button>\
        </a>\
      </span>\
   ')
       }, 1);
});
</script>


@endSection