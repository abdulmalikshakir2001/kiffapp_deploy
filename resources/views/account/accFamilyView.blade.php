@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_family.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="accFamilyDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Family ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary accFamilyDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add accFamily start  -->
            <div class="modal fade" id="accFamilyAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Family</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        

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
            <div class="modal fade" id="accFamilyUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Family</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        

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
                        <table class="table align-items-center mb-0  hover" id="accFamilyTable" style="width: 100%;">

                            
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Family Code
                                    </th>
                                    
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
        



            
            

            // tiny mce start
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

                $("#accFamilyTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "acc_family_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "family_name",
                            name: "family_name"
                        },
                        {
                            data: "family_code",
                            name: "family_code"
                        },
                        
                    ],
                });
            });
            // dattables end


        });
    </script>
@endSection
