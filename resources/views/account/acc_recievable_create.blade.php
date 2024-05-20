@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/account/css/acc_journal_entry.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12">
    <!-- if debit and credit are not equal  modal start  -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="debitCreditNotEqualModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Account Entries</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Debit and Credit Entries are not equal
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>
    <!-- if debit and credit are not equal  modal end  -->
    <!-- fetcing currency exchange rate for the transaction start  -->
    <form id="fetch_transaction_currency_form">
      @csrf
      <input type="hidden" name="transaction_currency" id="transaction_currency">

    </form>
    <!-- fetcing currency exchange rate for the transaction end  -->




    <form action="" id="journal_entry_form">
      @csrf
      <input type="hidden" name="remember_token" id="remember_token">
      <input type="hidden" name="total_debit_hidden" id="total_debit_hidden" value="">
      <input type="hidden" name="total_credit_hidden" id="total_credit_hidden" value="">
      <input type="hidden" name="total_exchange_rate_hidden" id="total_exchange_rate_hidden" value="">
      <input type="hidden" name="currency_exchange_rate_hidden" id="currency_exchange_rate_hidden" value="">

      <div class="container-fluid profile">
        <div class="row gy-4 profile_row">
          <!--  lable div end  -->
          <div class="col-md-12">
            <div class="parent">

              <div class="row">
                <div class="col-md-4">
                  <h5 class="">Acc Payables</h5>
                </div>
                <div class="col-md-8">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert"
                    id="user_update_msg">
                    Entries added successfully
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
              <h5 class="">Transaction</h5>
              <div class="row gy-3">
                <div class="col-md-4">
                  <label for="date">Date</label>
                  <input type="date" class="form-control" placeholder="Date" aria-label="Date" name="date" id="date">
                </div>

                <div class="col-md-4">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" cols="" rows="1" placeholder="Address"
                    class="form-control"></textarea>
                </div>
                <!-- Fiscal Period  -->
                <div class="col-md-4">
                  <label for="acc_fiscal_period_id">Fiscal Period </label>
                  <select name="acc_fiscal_period_id" id="acc_fiscal_period_id"
                    class="form-select acc_fiscal_period_id">
                    <option></option>
                    @foreach($fiscalPeriods as $fiscalPeriod)
                    <option value="{{$fiscalPeriod->acc_fiscal_period_id}}">{{$fiscalPeriod->name}}
                    </option>
                    @endforeach
                  </select>
                </div>
                <!-- Cost Center  -->
                <div class="col-md-4">
                  <label for="acc_cost_center_id">Cost Center </label>
                  <select name="acc_cost_center_id" id="acc_cost_center_id" class="form-select acc_cost_center_id">
                    <option></option>
                    @foreach($costCenters as $costCenter)
                    <option value="{{$costCenter->acc_cost_center_id}}">{{$costCenter->name}}</option>
                    @endforeach
                  </select>
                </div>
                <!-- Control code -->
                <div class="col-md-4">
                  <label for="acc_control_code_id">Control Code </label>
                  <select name="acc_control_code_id" id="acc_control_code_id" class="form-select acc_control_code_id">
                    <option></option>
                    @foreach($controlCodes as $controlCode)
                    <option value="{{$controlCode->acc_control_code_id}}">{{$controlCode->control_code}}</option>
                    @endforeach
                  </select>
                </div>
                <!-- Currency-->
                <div class="col-md-4">
                  <label for="acc_currency_id">Currency</label>
                  <select name="acc_currency_id" id="acc_currency_id" class="form-select acc_currency_id">
                    <option></option>
                    @foreach($currencies as $currency)
                    <option value="{{$currency->name}}" {{$currency->name ==$defaultCurrency->name ?'selected':"" }}


                      >{{$currency->currency_code}}</option>
                    @endforeach
                  </select>
                </div>


                <div class="col-md-4">
                  <label for="acc_payable_name">Account Recievable</label>
                  <input type="text" class="form-control" name="acc_payable_name" id="acc_payable_name" placeholder="Enter account recievable name">
                
                </div>


                <div class="col-md-4 acc_payable_div d-none">
                  <label for="acc_code">Account Code</label>
                  <input  class="form-control" name="acc_code" id="acc_code" placeholder="Account Code">
                
                </div>

                
                <div class="col-md-4 acc_payable_div d-none">
                  <label for="acc_amount">Account Amount</label>
                  <input type="text" class="form-control" name="acc_amount" id="acc_amount" placeholder="Account Amount">
                
                </div>





















              </div>
            </div>
          </div>
          <!-- user information end  -->


          <div class="col-md-12">
            <div class="parent">
              <h5 class="">Accounts</h5>
              <div class="row gy-3">
                <div class="col-md-12">
                  <!-- table start  -->
                  <div class="table-responsive">
                    <table class="table" id="dr_cr_table">
                      <thead>
                        <tr class="acc_dr_cr_row">
                          <th scope="col">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="select_all"
                                style="margin-left:-40px;">
                            </div>
                          </th>

                          <th scope="col">Account</th>
                          <th scope="col">Debit</th>
                          <th scope="col" class="show_when_other_currency d-none">Debit in default currency
                            </th>
                          <th scope="col">Credit</th>
                          <th scope="col" class="show_when_other_currency d-none">credit in default currency for
                            </th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr class="">
                          <td>
                            <div class="form-check">
                              <input class="form-check-input checkbox" type="checkbox" value="" id="flexCheckDefault">
                            </div>

                          </td>

                          <td>
                            <div class="col-md-12">

                              <select name="account_id" id="account_id" class="form-select account_id">
                                <option></option>
                                @foreach($accounts as $account)
                                <option value="{{$account->acc_account_id}}"
                                  data-account_type="{{$account->type}}"
                                  >{{$account->name}}</option>
                                @endforeach
                              </select>

                            </div>


                          </td>
                          <td>

                            <div class="col-md-12">
                              <!-- debit class should be first for click event -->
                              <input type="text" name="debit" id="debit" class="debit foreign_currency form-control "
                                value="0.00">
                            </div>
                          </td>

                          <td class="show_when_other_currency d-none">
                            <div class="col-md-12">

                              <input type="text" name="exchange_rate" id="exchange_rate"
                                class="exchange_rate  exchange_rate_debit form-control " value="0.00" disabled>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <input type="text" name="credit" id="credit" class="credit foreign_currency form-control"
                                value="0.00">
                            </div>
                          </td>

                          <td class="show_when_other_currency d-none">
                            <div class="col-md-12">

                              <input type="text" name="exchange_rate_credit" id="exchange_rate_credit"
                                class="exchange_rate exchange_rate_credit form-control " value="0.00" disabled>
                            </div>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>

                  <!-- table end  -->
                </div>

                <div class="col-md-12">
                  <!-- buttons -->
                  <span class="badge bg-danger d-none" id="delete_row_button">Delete</span>
                  <span class="badge bg-dark add_dr_cr_row">Add Row</span>
                  <!-- buttons -->
                </div>

                <div class="col-md-12">
                  <!-- <h2>total credit and debit</h2> -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-md-12">
                        <label for="currency_exchange_rate"> Exchange Rate </label>
                        <input type="text" name="currency_exchange_rate" id="currency_exchange_rate"
                          class="form-control" value="0.00" disabled>
                      </div>


                      <div class="col-md-12">
                        <label for="total_debit">Total Debit</label>
                        <input type="text" name="total_debit" id="total_debit" class="form-control" value="0.00"
                          disabled>
                      </div>
                      <div class="col-md-12">
                        <label for="total_credit">Total Credit</label>
                        <input type="text" name="total_credit" id="total_credit" class="form-control" value="0.00"
                          disabled>
                      </div>

                      <div class="col-md-12">
                        <label for="difference">Difference (Dr - Cr) </label>
                        <input type="text" name="difference" id="difference" class="form-control" value="0.00" disabled>
                      </div>
                      <div class="col-md-12 d-none" >
                        <label for="total_exchange_rate">Total Exchange Rate </label>
                        <input type="text" name="total_exchange_rate" id="total_exchange_rate" class="form-control"
                          value="0.00" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              </div>




















            </div>
          </div>
        </div>







        <!-- button start  -->
        <div class="col-md-12">
          <div class="parent">
            <div class="row justify-content-end">
              <div class="col-md-2">

                <button type="submit" class="btn btn-primary  w-100" id="add_btn">Add</button>

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

@endSection
@section('page_script_links')
<script>
  $(document).ready(function () {
    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp
    // alert("journal")
    function showExchangeRateForOtherCurrecy(currencyName) {

if (currencyName == "{{$defaultCurrency->name}}") {
  $('td.show_when_other_currency').addClass('d-none')

  
  $('th.show_when_other_currency').addClass('d-none')

}
else {
  $('td.show_when_other_currency').removeClass('d-none')
  $('th.show_when_other_currency').removeClass('d-none')

}
}
    function showSingleExchangeRate(str) {
      $('.' + str).each((key, value) => {
        $(value).on('input', function () {

          let value = parseFloat($(this).val())
          let transactionCurrencyValue = parseFloat(sessionStorage.getItem('exchangeRate'))
          $(this).closest('td').next().find('.exchange_rate').val(value * transactionCurrencyValue)

        })
      })

    }
    function fetchTransactionCurrencyFun(accCurrencyId) {
      // alert( $('#'+ accCurrencyId).val())
      $('#transaction_currency').val($('#' + accCurrencyId).val())
      fetch(base_url + 'fetch_transaction_currency', {
        method: "POST",
        body: new FormData(document.getElementById('fetch_transaction_currency_form'))
      }).then((res) => {
        return res.json()
      }).then((data) => {
        $('#currency_exchange_rate').val(data.exchange_rate)

        sessionStorage.setItem('exchangeRate', data.exchange_rate)


        //     $('.debit').each((key,value)=>{
        //       $(value).on('input',function(){

        //         let debitValue =  parseFloat( $(this).val())
        //     let transactionCurrencyValue = parseFloat( sessionStorage.getItem('exchangeRate'))
        //     $(this).closest('td').next().find('#exchange_rate').val(debitValue * transactionCurrencyValue)

        //   })
        // })


        showSingleExchangeRate('debit')
        showSingleExchangeRate('credit')





      })
    }
    fetchTransactionCurrencyFun('acc_currency_id')




    $('#acc_currency_id').on('change', function () {
      // alert($(this).val())
      // current
      let currencyValue = $(this).val()
      showExchangeRateForOtherCurrecy(currencyValue)





      $('.exchange_rate').each((key, value) => {
        $(value).val('0.00')
      })
      fetchTransactionCurrencyFun('acc_currency_id')
    })





    function emptyFieldOnClick(debitField) {
      if ($(debitField).val() == 0.00) {
        $(debitField).val("")

      }
    }
    function showDeleteButtonByChecked() {
      $('.checkbox').each((key, value) => {
        $(value).on('change', function () {
          if ($(value).prop('checked')) {
            $('#delete_row_button').removeClass('d-none')


          }

        })



      })


    }

    function deleteChecked() {
      const checkboxes = document.querySelectorAll('.checkbox:checked');
      checkboxes.forEach(checkbox => {

        $(checkbox).closest('tr').remove()
      });
    }

    function makeArrayOfInputElement(inputClassName, formId) { // pass classname + form id  and it will append input element to form and this input value  will be array 


      let array = [] // contain all the account ids


      if ($('.' + inputClassName + '_array').length == 0) {
        $('#' + formId).prepend(
          `<input type="hidden" name=${inputClassName + '_array'}   id=${inputClassName + '_array'}   class=${inputClassName + '_array'} value=${array}>`
        )
      }
      let fieldArray = $('.' + inputClassName);
      $(fieldArray).each(function (key, value) {
        // console.log($(value).val());
        array.push($(value).val())
      })
      $('#' + inputClassName + '_array').val(array)

    }

    $("#acc_fiscal_period_id").select2({

      placeholder: "Select Fiscal Period",
      allowClear: true,
      width: "100%",
    });
    $("#acc_cost_center_id").select2({
      placeholder: "Select Cost Center",
      allowClear: true,
      width: "100%",
    });
    $("#acc_control_code_id").select2({
      placeholder: "Select Control Code",
      allowClear: true,
      width: "100%",
    });
    // country id
    $("#acc_currency_id").select2({
      placeholder: "Select Currency",
      allowClear: true,
      width: "100%",
    });
    $("#account_id").select2({
      placeholder: "Select Account",
      allowClear: true,
      width: "100%",
    });



    //
    // add users start
    $.validator.addClassRules({
      account_id: {
        required: true
      },


    })
    $("#journal_entry_form").validate({
      rules: {
        date: {
          required: true,

        },
        acc_fiscal_period_id: {
          required: true,

        },
        acc_cost_center_id: {
          required: true,

        },
        acc_control_code_id: {
          required: true,

        },
        acc_currency_id: {
          required: true,

        },
        debit: {
          required: true,
          number: true,

        },
        credit: {
          required: true,
          number: true,
        },
      },
      messages: {
        date: {
          required: "Date is required",

        },
        acc_fiscal_period_id: {
          required: "Fiscal Period is required",

        },
        acc_cost_center_id: {
          required: "cost center is required",

        },
        acc_control_code_id: {
          required: "cost center is required",

        },
        acc_currency_id: {
          required: "Currency required",

        },
        debit: {
          required: "This field is required",
          number: "Ony integers allowed",
        },
        credit: {
          required: "This field is required",
          number: "Ony integers allowed",
        },

      },
      submitHandler: function (form) {
        // if currency default then make debit and credit 1.00 start 
        if($('#acc_currency_id').val() == "{{$defaultCurrency->name}}"){
          $('.debit').each((key,value)=>{
            $(value).val(1.00)
          })
          $('.credit').each((key,value)=>{
            $(value).val(1.00)
          })


        }
        // if currency default then make debit and credit 1.00 end 
        if ($('#total_debit').val() != $('#total_credit').val()) {
          $('#debitCreditNotEqualModal').modal('show')
          return false
        }
        $('#total_debit_hidden').val($('#total_debit').val())
        $('#total_credit_hidden').val($('#total_credit').val())
        $('#total_exchange_rate_hidden').val($('#total_exchange_rate').val())
        $('#currency_exchange_rate_hidden').val($('#currency_exchange_rate').val())
        makeArrayOfInputElement('account_id', 'journal_entry_form')

        makeArrayOfInputElement('exchange_rate_credit', 'journal_entry_form')
        makeArrayOfInputElement('exchange_rate_debit', 'journal_entry_form')
        // account type start 
        let accountTypeArray = [] ;

        $('.account_id').each((key,value)=>{
           let accountType =  parseInt( $(value).find('option:selected').data('account_type'));
           accountTypeArray.push(accountType)
        })
        if( $('#journal_entry_form').find('#account_type_array_hidden').length == 0){
          $('#journal_entry_form').prepend(`
          <input type="hidden" name="account_type_array_hidden" id="account_type_array_hidden" > 
          `)

        }
        $('#account_type_array_hidden').val(accountTypeArray)
        

        // account type start 

        let foreignCurrencyRateArray = [];
        $('.foreign_currency').each((key, value) => {
          if ($(value).val() != '0.00') {

            foreignCurrencyRateArray.push($(value).val())


          }

        })
        // console.log(foreignCurrencyRateArray)

        if ($('#foreignCurrencyRateArrayInput').length == 0) {
          $('#journal_entry_form').prepend(`
                      <input type="hidden" name="foreignCurrencyRateArrayInput" id="foreignCurrencyRateArrayInput" value="">

                      `)
        }
        $('#foreignCurrencyRateArrayInput').val(foreignCurrencyRateArray)





        $.ajax({
          type: "post",
          url: base_url + "acc_transaction",
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function (response) {
            // alert(response);
            // console.log( response);
            if (response == 1) {
              // alert("user updated successfully")
              // $('.update_msg').removeClass("d-none");
              $("#journal_entry_form").trigger("reset");
              $('#acc_fiscal_period_id').val("").change()
              $('#acc_cost_center_id').val("").change()
              $('#acc_control_code_id').val("").change()
              $('#acc_currency_id').val("").change()
              $(".user_updated_msg").removeClass("d-none");
              $('.account_id').each((key, value) => {
                $(value).val("").change()
              })
              window.scrollTo(0, 0)
            }
          },
        });
      },
    });
    // add users end




    // hide select error when the field is selected start 

    $('#acc_fiscal_period_id').on('change', function (param) {
      let acc_fiscal_period_id_value = $(this).val();
      if (acc_fiscal_period_id_value == "") {

        $('#acc_fiscal_period_id-error').removeClass('d-none') // label
      } else {
        $('#acc_fiscal_period_id-error').addClass('d-none') // label

      }
    })

    $('#acc_cost_center_id').on('change', function (param) {
      let acc_cost_center_id_value = $(this).val();
      if (acc_cost_center_id_value == "") {

        $('#acc_cost_center_id-error').removeClass('d-none') // label
      } else {
        $('#acc_cost_center_id-error').addClass('d-none') // label

      }
    })

    $('#acc_control_code_id').on('change', function (param) {
      let acc_control_code_id_value = $(this).val();
      if (acc_control_code_id_value == "") {

        $('#acc_control_code_id-error').removeClass('d-none') // label
      } else {
        $('#acc_control_code_id-error').addClass('d-none') // label

      }
    })


    $('#acc_currency_id').on('change', function (param) {
      let acc_currency_idValue = $(this).val();
      if (acc_currency_idValue == "") {

        $('#acc_currency_id-error').removeClass('d-none') // label
      } else {
        $('#acc_currency_id-error').addClass('d-none') // label

      }
    })



    // hide select error when the field is selected end 

    // calculate debit and credit start 
    // current
    let drCrRowInc = 1; // it will be decrement on delete 
    $('.add_dr_cr_row').on('click', function () {
      // emptyDebitOnClick()
      // alert('ok')
      let newRow = `<tr class="">
                                     <td> 
                                        <div class="form-check">
                                          <input class="form-check-input checkbox" type="checkbox" value="" id="flexCheckDefault">
                                        </div>
                                      </td>
                                    
                                    <td>
                                      <div class="col-md-12">
                                        
                                        <select name="account_id_${drCrRowInc}" id="account_id_${drCrRowInc}" class="form-select account_id">
                                          <option></option>
                                          @foreach($accounts as $account)
                                          <option value="{{$account->acc_account_id}}"  data-account_type="{{$account->type}}">{{$account->name}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                    

                                    </td>
                                    <td>
                                      
                                      <div class="col-md-12">
                                        <input type="text" name="debit_${drCrRowInc}" id="debit_${drCrRowInc}" class="debit foreign_currency form-control" value="0.00">
                                      </div>
                                    </td>
                                    <td class="show_when_other_currency d-none">
                                      
                                      <div class="col-md-12">
                                        <input type="text" name="exchange_rate_${drCrRowInc}" id="exchange_rate_${drCrRowInc}" class="exchange_rate exchange_rate_debit form-control" value="0.00" disabled>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="col-md-12">
                                        <input type="text" name="credit_${drCrRowInc}" id="credit_${drCrRowInc}" class="credit foreign_currency form-control" value="0.00">
                                      </div>
                                    </td>

                                    <td class="show_when_other_currency d-none">
                                      
                                      <div class="col-md-12">
                                        <input type="text" name="exchange_rate_credit_${drCrRowInc}" id="exchange_rate_credit_${drCrRowInc}" class="exchange_rate exchange_rate_credit form-control" value="0.00" disabled>
                                      </div>
                                    </td>
                                  </tr>`
      // console.log($('#dr_cr_table tbody')) 
      $('#dr_cr_table tbody').append(newRow);
      showDeleteButtonByChecked()
      showSingleExchangeRate('debit')
      showSingleExchangeRate('credit')
      showExchangeRateForOtherCurrecy($('#acc_currency_id').val())
      // make fields as select 2 
      $("#account_id_" + drCrRowInc).select2({
        placeholder: "Select Account",
        allowClear: true,
        width: "100%",
      });
      // make fields as select 2 
      drCrRowInc++;
      // empty the debit and credit field on  click for user 
      // empty debit value if 0.00  for user
      $('.debit').each((key, value) => {
        // $(value).prop('disabled',true)
        // $('#debit').prop('disabled',false)
        $(value).on('click', function () {
          // if(){}
          $('.credit').each((key, value) => {
            if ($(value).val() == "") {
              $(value).val('0.00')
            }
          })
          emptyFieldOnClick($(this))
        })

      })
      // empty credit value if 0.00  for user
      $('.credit').each((key, value) => {
        $(value).prop('disabled',true)
        $('#credit').prop('disabled',false)


        $(value).on('click', function () {
          // if(){}
          $('.debit').each((key, value) => {
            if ($(value).val() == "") {
              $(value).val('0.00')

            }
          })

          emptyFieldOnClick($(this))
        })

      })


    })


    // $(document).find('.debit').on('click',function(){
    //     alert('okkk')
    //   })



    // empty debit value if 0.00  for user



    $('.debit').on('click', function () {
      emptyFieldOnClick($(this))

    })
    $('.credit').on('click', function () {
      emptyFieldOnClick($(this))
    })


    // calculate debit and credit end 
    function totalDebitOrCredit(string, e) {  // string= debit / credit  & e is obj
      if (e.target.classList[0] != string) {
        // console.log($('.debit')) 
        let array = $('.' + string).toArray() //  pass debit jquery array to function 
        const valueArray = array.map((element) => {
          let elementValue = $(element).val();
          if (elementValue) {
            return parseFloat(elementValue);
          }
          else {
            return 0;
          }
        });
        //now sum all the debit input
        const total = valueArray.reduce((accumulator, currentValue) => {
          return accumulator + currentValue;
        }, 0);
        $('#total_' + string).val(total)

        // console.log(totalDebit)
        // 
      }
    }
    $('body').on('click', function (e) {
      e.stopImmediatePropagation();
      totalDebitOrCredit('debit', e)
      totalDebitOrCredit('credit', e)
      totalDebitOrCredit('exchange_rate', e)
      setTimeout(() => {
        let totalDebitValue = parseFloat($('#total_debit').val())
        let totalCreditValue = parseFloat($('#total_credit').val())
        // alert(totalDebitValue)
        let debitCreditDifference = totalDebitValue - totalCreditValue
        // alert(debitCreditDifference)
        $('#difference').val(debitCreditDifference)
      }, 1);
    })


    // $('.debit').on('keyup', function (e) {
    //   if (event.key === 'Escape' || event.key === 'Esc') {
    //     // alert('escape button press')


    //   }

    // })

    // select and un select all checkboxes start
    function selectAllCheckboxes() {

      const selectAllCheckbox = document.getElementById('select_all');
      const checkboxes = document.querySelectorAll('.checkbox');

      checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
      });
    }
    $('#select_all').on('change', function () {
      if ($(this).prop('checked')) {
        $('#delete_row_button').removeClass('d-none')
      }
      selectAllCheckboxes()

    })
    // delete checked rows

    $('#delete_row_button').on('click', function () {
      deleteChecked()
    })
    // showing delete button if one or more checkbox checked
    showDeleteButtonByChecked()


    // sending acc payable name to fetch account start 
    $('#acc_payable_name').on('input',function(){
      let accPayableName =  $(this).val() ;
      // Make a GET request
// Make a POST request with JSON data
fetch(base_url+'acc_recievable_fetch', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
  },
  body: JSON.stringify({
    accPayableName: accPayableName,
    
  }),
})
  .then(response => response.json())
  .then(data => {
    // console.log(data);
    if(data.length == 1){
      const [name,code,balance,acc_code] =  data[0]
      $('div.acc_payable_div').removeClass('d-none');
      $('#acc_code').val(code)
      $('#acc_amount').val(balance)

      $('#account_id').val(acc_code).change()
      $('#account_id').closest('td').next().find('.debit').prop('disabled',true)
      $('#account_id').closest('td').next().next().next().find('.credit').val(balance)

    }
    else{
      $('div.acc_payable_div').addClass('d-none');
      $('#acc_code').val("") ;
      $('#acc_balance').val("");
    }
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

      

    })
    // sending acc payable name to fetch account end 

  });
</script>

@endSection