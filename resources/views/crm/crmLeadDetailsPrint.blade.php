<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmLead.css') }}">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmLeadDetailsPrint.css') }}">
    <title>Document</title>
</head>

<body>
    <header></header>
    <section>
        <form action="" id="crmLeadUpdateForm">
            <input disabled type="hidden" name="lead_id" id="lead_id" value="{{ $lead->lead_id }}">
            @csrf
            <div class="container-fluid parent_wrapper">
                <div class="row gy-4 parent_row">
                    <!--  lable div end  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <div class="row position-relative nested_first_row">
                                <div class="col-md-4 nested_first_row_col">
                                    <h5 class="">Lead Details</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->




                    <!-- user information start  -->
                    <div class="col-md-8 parent_row_col">
                        <div class="parent h-100">
                            <h5 class="">Lead Information</h5>
                            <div class="row gy-3 nested_first_row">

                                <div class="col-md-12 nested_first_row_col">
                                    <label for="subject">Subject</label>
                                    <textarea disabled name="subject" id="subject" cols="" rows="1" placeholder="Subject"
                                        class="form-control input_diabled">{{ $lead->subject }}</textarea>
                                </div>

                                <div class="col-md-12 nested_first_row_col">
                                    <label for="contact_id">Contact Name </label>
                                    <select disabled name="contact_id" id="contact_id"
                                        class="form-select contact_id input_diabled">
                                        <option></option>
                                        @foreach ($contacts as $contact)
                                            <option value="{{ $contact->user_id }}"
                                                {{ $contact->user_id == $lead->contact_id ? 'selected' : '' }}>
                                                {{ $contact->username }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-md-12 nested_first_row_col">
                                    <label for="category_id">Category </label>
                                    <select disabled name="category_id" id="category_id"
                                        class="form-select category_id input_diabled">
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                {{ $category->category_id == $lead->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 nested_first_row_col">
                                    <label for="priority">Priority </label>
                                    <select disabled name="priority" id="priority"
                                        class="form-select priority input_diabled">
                                        <option></option>
                                        <option value="lowest" {{ $lead->priority == 'lowest' ? 'selected' : '' }}>Lowest
                                        </option>
                                        <option value="low" {{ $lead->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="normal" {{ $lead->priority == 'normal' ? 'selected' : '' }}>Normal
                                        </option>
                                        <option value="high" {{ $lead->priority == 'high' ? 'selected' : '' }}>High
                                        </option>
                                        <option value="highest" {{ $lead->priority == 'highest' ? 'selected' : '' }}>Highest
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="">Creation Date</label>
                                    <input disabled type="date" name="creation_date" id="creation_date"
                                        class="form-control input_diabled" value="{{ $lead->creation_date }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- user information end  -->

                    <!-- related information end  -->
                    <div class="col-md-4 parent_row_col">
                        <div class="parent h-100">
                            <h5 class="">Related Information</h5>
                            <div class="row gy-3 nested_first_row">
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="employee_id">Sales Person Name </label>
                                    <select disabled name="employee_id" id="employee_id"
                                        class="form-select employee_id input_diabled">
                                        <option></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->user_id }}"
                                                {{ $employee->user_id == $lead->employee_id ? 'selected' : '' }}>
                                                {{ $employee->username }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="lead_reffered_by">Lead Reffered By</label>
                                    <input disabled type="text" class="form-control input_diabled"
                                        placeholder="Lead reffered By" aria-label="Lead reffered By"
                                        name="lead_reffered_by" id="lead_reffered_by"
                                        value="{{ $lead->lead_reffered_by }}">

                                </div>
                                


                            </div>
                        </div>
                    </div>
                    <!-- related information end  -->


                    <!--  Descriptions  start  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <h5 class="">Descriptions</h5>
                            <div class="row gy-3 nested_first_row">

                                <div class="col-md-4 nested_first_row_col">
                                    <label for="remarks">Remarks</label>
                                    <input disabled type="text" class="form-control input_diabled"
                                        placeholder="Remarks" aria-label="Zip code" name="remarks" id="remarks"
                                        value="{{ $lead->remarks }}">
                                </div>

                                <div class="col-md-4 nested_first_row_col">
                                    <label for="internal_notes">Internal Notes</label>
                                    <textarea disabled name="internal_notes" id="" cols="" rows="1" id="internal_notes"
                                        placeholder="Internal Notes" class="form-control input_diabled">{{ $lead->internal_notes }}</textarea>
                                </div>


                                <div class="col-md-4 nested_first_row_col">
                                    <label for="external_info">External Information</label>
                                    <textarea disabled name="external_info" id="" cols="" rows="1" id="external_info"
                                        placeholder="External Information" class="form-control input_diabled">{{ $lead->external_info }}</textarea>
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





    <script></script>
</body>

</html>
