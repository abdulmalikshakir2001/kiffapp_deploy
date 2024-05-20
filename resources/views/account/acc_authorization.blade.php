@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_cost_center.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="accCostCenterDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="accCostCenterId" id="acc_cost_center_delete_id">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Cost Center ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary accCostCenterDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add accCostCenter start  -->
            <div class="modal fade" id="accCostCenterAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Cost Center</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accCostCenterForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Cost Center name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Cost Center Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cost Center Name " aria-label="Cost Center Name"
                                                            name="name" id="name">
                                                    </div>
                                                    <!-- Description -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Description</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Description" aria-label="Description"
                                                            name="description" id="description">
                                                    </div>
                                                    
                                                    


                                                    
                                                    


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accCostCenterAddBtn"
                                                            class="btn bg-primary w-100 my-4 mb-2 text-white">Add</button>
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
            <div class="modal fade" id="accCostCenterUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Cost Center</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accCostCenterUpdateForm">
                                            <input type="hidden" name="acc_cost_center_id" id="acc_cost_center_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Cost Center name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Cost Center Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cost Center Name " aria-label="Cost Center Name"
                                                            name="name" id="name">
                                                    </div>
                                                           <!-- Description -->
                                                           <div class="mb-3 col-md-6">
                                                            <label for="name">Description</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Description" aria-label="Description"
                                                                name="description" id="description">
                                                        </div>
                                                        
                                                        
    
    
                                                    
                                             
                                                    

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accCostCenterUpdateBtn"
                                                            class="btn bg-primary w-100 my-4 mb-2 text-white">Update</button>
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
                        <table class="table align-items-center mb-0  hover" id="acc_authorization_table" style="width: 100%;">

                            
                            
                            
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Fiscal Period
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Cost Center
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Control Code
                                    </th>
                             
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Currency id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">date
                                    </th>
                                    
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Exchange Rate
                                    </th>
                                    
                                    
                                    
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                        Actions</th>
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
                echo "var base_url = '" . $baseUrl . "';";
            @endphp

            
            // dattables
            $(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $("#acc_authorization_table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "acc_authorization_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "fiscal_period_id",
                            name: "fiscal_period_id"
                        },
                        {
                            data: "cost_center_id",
                            name: "cost_center_id"
                        },
                        {
                            data: "control_code_id",
                            name: "control_code_id"
                        },
                        {
                            data: "currency_id",
                            name: "currency_id"
                        },
                        {
                            data: "date",
                            name: "date"
                        },
                        {
                            data: "exchange_rate",
                            name: "exchange_rate"
                        },
                        

                        
                        {
                            data: "status",
                            name: "status"
                        },
                    ],
                });
            });
            // dattables end

            
            
        });
    </script>
@endSection
