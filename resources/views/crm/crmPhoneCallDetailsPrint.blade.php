<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmPhoneCall.css') }}">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmPhoneCallDetailsPrint.css') }}">
    <title>Document</title>
</head>
<body>
    <header></header>
    <section>
        <form action="" id="crmPhoneCallUpdateForm">
            <input disabled type="hidden" name="phone_call_id" id="phone_call_id"
                value="{{ $crmPhoneCall->phone_call_id }}">
            @csrf
            <div class="container-fluid parent_wrapper">
                <div class="row gy-4 parent_row">
                    <!--  lable div end  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent position-relative">
                            <div class="row nested_first_row">
                                <div class="col-md-4 nested_first_row_col">
                                    <h5 class=""> Phone Call Details</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->
                    <!-- user information start  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <h5 class="">Phone Call Information</h5>
                            <div class="row gy-3 nested_first_row">

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="contact_id">Contact Name </label>
                                    <select disabled name="contact_id" id="contact_id" class="form-select contact_id">
                                        <option></option>
                                        @foreach ($contacts as $contact)
                                            <option value="{{ $contact->user_id }}"
                                                {{ $crmPhoneCall->contact_id == $contact->user_id ? 'selected' : '' }}>
                                                {{ $contact->username }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-md-6 nested_first_row_col">
                                    <label for="lead_id">Lead Name </label>
                                    <select disabled name="lead_id" id="lead_id"
                                        class="form-select lead_id input_diabled">
                                        <option></option>
                                        @foreach ($leads as $lead)
                                            <option value="{{ $lead->lead_id }}"
                                                {{ $crmPhoneCall->lead_id == $lead->lead_id ? 'selected' : '' }}>
                                                {{ $lead->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="date"> Date</label>
                                    <input disabled type="date" name="date" id="date"
                                        class="form-control input_diabled" value="{{ $crmPhoneCall->date }}">
                                </div>
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="duration"> Duration</label>
                                    <input disabled type="text" name="duration" id="duration"
                                        class="form-control input_diabled" placeholder="Duration"
                                        value="{{ $crmPhoneCall->duration }}">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- user information end  -->

                    <!--  Descriptions  start  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <h5 class="">Descriptions</h5>
                            <div class="row gy-3 nested_first_row">

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="call_summary">Call Summary</label>
                                    <textarea disabled disabled name="call_summary" cols="" rows="1" id="call_summary"
                                        placeholder="Call Summary" class="form-control input_diabled">{{ $crmPhoneCall->call_summary }}</textarea>
                                </div>
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="remarks">Remarks</label>
                                    <textarea disabled name="remarks" cols="" rows="1" id="remarks" placeholder="Remarks"
                                        class="form-control input_diabled">{{ $crmPhoneCall->remarks }}</textarea>
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- Descriptions end  -->



                </div>
            </div>
        </form>

    </section>
    <footer></footer>
    
</body>
</html>