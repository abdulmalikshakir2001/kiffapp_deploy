@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_trial_balance.css') }}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 ">











        <!-- content start  -->
        <div class="card mb-4 view_user_card">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0  hover" id="acc_trial_balance_table"
                        style="width: 100%;">
                        <div class="row date_range g-3">
                            <div class="col-md-4">
                                <label for="from_date">From Date</label>
                                <input type="date" name="from_date" id="from_date" value="" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="to_date">To date</label>
                                <input type="date" name="to_date" id="to_date" value="{{ now()->format('Y-m-d') }}"
                                    class="form-control">

                            </div>
                            <div class="col-md-4 align-self-end ">

                                <button type="button" class="btn btn-sm btn-primary filter_button mb-0">Filter</button>

                            </div>




                        </div>

                        <!-- show message when accControlCode   added  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accControlCodeAddedMsg user_updated_msg"
                                role="alert">
                                Contol Code added
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when accControlCode   added  start  -->


                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Account
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Debit
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Credit
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Debit = <span class="total_debit_trial_balance">0</span> </td>
                                <td>Total Credit = <span class="total_credit_trial_balance">0</span> </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div>
                        <!-- income statement start  -->
                        <div class="table-responsive p-0 d-none" id="income_statement_table_parent">
                            <h2>Income statement</h2>
                            <table class="table align-items-center mb-0  hover" id="income_statement"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Accounts
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end"> (Total revenue - Total expense) = </td>
                                        <td class="net_income">0</td>
                                    </tr>

                                </tfoot>
                            </table>

                            <div>
                                <!-- income statement end  -->
                                <!-- Statement of owner equity start   -->
                                <div class="table-responsive p-0" id="owner_equity_table_parent">
                                    <h2>Statement of owner equity</h2>
                                    <table class="table align-items-center mb-0  hover" id="owner_equity"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    Accounts
                                                </th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    Amount
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-end"> (Equity - drawings) = </td>
                                                <td class="owner_equity_col">0</td>
                                            </tr>

                                        </tfoot>
                                    </table>

                                    <div>
                                        <!-- Statement of owner equity start  -->
                                        <!-- Balance sheet  start   -->
                                        <div class="table-responsive p-0" id="balance_sheet_table_parent">
                                            <h2>Balance sheet</h2>
                                            <table class="table align-items-center mb-0  hover" id="balance_sheet_table"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                            Accounts
                                                        </th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                            Amount
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                    <!-- <tr>
                                                <td class="text-end"> (Equity  - drawings) = </td>
                                                <td class="owner_equity_col">0</td>
                                            </tr> -->

                                                </tfoot>
                                            </table>

                                            <div>
                                                <!-- Balance sheet  end  -->
                                            </div>

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





                                // tiny mce start
                                @php
                                $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
                                @endphp


                                // dattables
                                $(function () {
                                    $.ajaxSetup({
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                        },
                                    });

                                    $("#acc_trial_balance_table").DataTable({

                                        processing: true,
                                        serverSide: true,
                                        oderable: false,
                                        dom: 'Brti',
                                        buttons: [
                                            'copy', 'csv', 'excel', 'pdf', 'print'
                                        ],
                                        ajax: {
                                            url: base_url + "acc_trial_balance_get_data",

                                            data: function (d) {
                                                d.from_date = $('#from_date').val()
                                                d.to_date = $('#to_date').val()
                                            },
                                            "dataFilter": function (data) {
                                                var json = jQuery.parseJSON(data);
                                                $('.total_debit_trial_balance').text(json.totalDebit)
                                                $('.total_credit_trial_balance').text(json.totalCredit)
                                                json.recordsTotal = json.recordsTotal;
                                                json.recordsFiltered = json.recordsTotal;
                                                json.data = json.data;
                                                sessionStorage.setItem('trialBalance', JSON.stringify(json.data))
                                                return JSON.stringify(json); // return JSON string

                                            }
                                        },
                                        columns: [{
                                            data: "DT_RowIndex",
                                            name: "DT_RowIndex"
                                        },
                                        {
                                            data: "account_name",
                                            name: "account_name"
                                        },
                                        {
                                            data: "debit",
                                            name: "debit"
                                        },
                                        {
                                            data: "credit",
                                            name: "credit"
                                        },

                                        ],
                                        "drawCallback": function (settings) {
                                            // alert('table loaded') 
                                            let trialBalanceRetrieve = JSON.parse(sessionStorage.getItem('trialBalance'))
                                            if (trialBalanceRetrieve.length != 0) {
                                                $('#income_statement_table_parent').removeClass('d-none')
                                                function removeTableBodyChild (formId){
                                                    $(`#${formId} tbody`).find('*').remove()
                                                }
                                                removeTableBodyChild('income_statement')
                                                removeTableBodyChild('owner_equity')
                                                removeTableBodyChild('balance_sheet_table')



                                                // console.log(trialBalanceRetrieve)
                                                // revenue start ------------------------------------
                                                const revenueArray = trialBalanceRetrieve.filter(item => item.account_code.startsWith("6-"));
                                                // console.log(revenueArray)
                                                let revenuePlus = revenueArray.reduce((acc, item) => {
                                                    if (item.credit == null) {
                                                        return acc + 0

                                                    }
                                                    return acc + item.credit

                                                }, 0)
                                                console.log('renvuew are ' + revenuePlus)
                                                // revenue end ------------------------------------
                                                function getitemsByStringStart(trialBalanceRetrieve, startOfString) {
                                                    let arrayAcc = trialBalanceRetrieve.filter(item => item.account_code.startsWith(startOfString));
                                                    return arrayAcc;
                                                }
                                                function getDrOrCrPlus(arrayAcc, drOrCr) {
                                                    let plus = arrayAcc.reduce((acc, item) => {
                                                        if (item[drOrCr] == null) {
                                                            return acc + 0
                                                        }
                                                        return acc + item[drOrCr]

                                                    }, 0)
                                                    return plus

                                                }



                                                // expense start ------------------------------------
                                                const expenseArray = trialBalanceRetrieve.filter(item => item.account_code.startsWith("2-"));
                                                // console.log(revenueArray)
                                                let expensePlus = expenseArray.reduce((acc, item) => {
                                                    if (item.debit == null) {
                                                        return acc + 0

                                                    }
                                                    return acc + item.debit

                                                }, 0)
                                                console.log('expenses are ' + expensePlus)
                                                // revenue end ------------------------------------
                                                let netIncome = parseFloat(revenuePlus) - parseFloat(expensePlus)
                                                console.log(netIncome)
                                                //   showing income statement data in table start 
                                                function checkRow(rowId, headingName, formId) {
                                                    $(`#${rowId}`).remove()
                                                    if ($(`#${formId}`).find(`#${rowId}`).length == 0) {
                                                        $(`#${formId} tbody`).append(`
                        <tr id=${rowId}> 
                            <td class ="font-weight-bold">${headingName} </td>
                            <td> </td>
                        </tr>
                        `)
                                                    }
                                                }
                                                function addRow(array, drOrCr, formId) {
                                                    
                                                    
                                                    array.forEach((item) => {

                                                            $(`#${formId} tbody`).append(`
                                                                    <tr class="acc_name_amount_tr"> 
                                                                        <td>${item.account_name} </td>
                                                                        <td> ${item[drOrCr]}</td>

                                                                    </tr>
                                                                    `)
                                                        })


                                                }
                                                function appendTotalAtLast(name, amount, formId, colVal, operator) { // revenue
                                                    $(`#${name}_total`).remove()

                                                    if ($(`#${formId}`).find(`#${name}_total`).length == 0) {
                                                        $(`#${formId} tbody tr:last-child`).after(`
                            <tr id="${name}_total"> 
                                <td class ="text-end"> ${colVal} ${operator} </td>
                                <td id="${name}_total_amount"> ${amount}</td>
                                </tr>

                            `)
                                                    }
                                                    $(`#${formId}`).find(`#${name}_total_amount`).text(amount)

                                                }
                                                // revenue start 
                                                checkRow('revenue_heading_row', 'Revenue', 'income_statement')
                                                addRow(revenueArray, 'credit', 'income_statement')
                                                appendTotalAtLast('revenue', revenuePlus, 'income_statement', 'Total', '=')
                                                // revenue end

                                                // expense start 
                                                checkRow('expense_heading_row', 'Expense', 'income_statement')
                                                addRow(expenseArray, 'debit', 'income_statement')
                                                appendTotalAtLast('expense', expensePlus, 'income_statement', 'Total', '=')
                                                // expense end
                                                $('.net_income').text(netIncome)
                                                //   showing income statement data in table  end

                                                // showing statement of owner equity start 
                                                // equity start 
                                                let equityArray = getitemsByStringStart(trialBalanceRetrieve, '5-')
                                                let equityPlus = getDrOrCrPlus(equityArray, 'credit')
                                                checkRow('equity_heading_row', 'Equity', 'owner_equity')
                                                addRow(equityArray, 'credit', 'owner_equity')
                                                appendTotalAtLast('net_income_col', netIncome, 'owner_equity', 'Net Income', '+')
                                                let equityPlusNetIncome = parseFloat(equityPlus) + netIncome
                                                appendTotalAtLast('equity', equityPlusNetIncome, 'owner_equity', 'Sub Total', '=')
                                                // equity end
                                                // drawing start 
                                                let drawingArray = getitemsByStringStart(trialBalanceRetrieve, '1-')
                                                let drawingPlus = getDrOrCrPlus(drawingArray, 'debit')
                                                checkRow('drawing_heading_row', 'Drawings', 'owner_equity')
                                                addRow(drawingArray, 'debit', 'owner_equity')
                                                appendTotalAtLast('drawing', drawingPlus, 'owner_equity', 'Total', '=')
                                                // drawing end 
                                                let totalOwnerEquity = parseFloat(equityPlusNetIncome) - parseFloat(drawingPlus)
                                                $('.owner_equity_col').text(totalOwnerEquity)




                                                // showing statement of owner equity end 

                                                // balance sheet start ------------------------------------------
                                                // asset
                                                let assetArray = getitemsByStringStart(trialBalanceRetrieve, '3-')
                                                let assetPlus = getDrOrCrPlus(assetArray, 'debit')
                                                checkRow('asset_heading_row', 'Asset', 'balance_sheet_table')
                                                addRow(assetArray, 'debit', 'balance_sheet_table')
                                                appendTotalAtLast('asset_col', assetPlus, 'balance_sheet_table', 'Total', '=')
                                                // liabilities
                                                let liabilitiesArray = getitemsByStringStart(trialBalanceRetrieve, '4-')
                                                let liabilitiesPlus = getDrOrCrPlus(liabilitiesArray, 'credit')
                                                checkRow('liabilities_heading_row', 'Liabilites', 'balance_sheet_table')
                                                addRow(liabilitiesArray, 'credit', 'balance_sheet_table')

                                                appendTotalAtLast('liabilities_col', liabilitiesPlus, 'balance_sheet_table', ' Sub Total', '=')
                                                appendTotalAtLast('owner_eq_col', totalOwnerEquity, 'balance_sheet_table', 'Owner Equity', '+')

                                                let totalLiabiltyEquity = liabilitiesPlus + totalOwnerEquity

                                                appendTotalAtLast('lia_owner_eq_col', totalLiabiltyEquity, 'balance_sheet_table', '(Total liability and equity )', '= ')


                                                // ------------------------------------------  balance sheet start











                                            } else {
                                                $('#income_statement_table_parent').addClass('d-none')


                                            }
                                        }
                                    });
                                });
                                // dattables end

                                $('.filter_button').on('click', function () {
                                    $('#acc_trial_balance_table').DataTable().ajax.reload()
                                })












                            });
                        </script>
                        @endSection