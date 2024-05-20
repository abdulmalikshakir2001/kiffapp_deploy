<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmOppertunity.css') }}">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmOppertunityDetailsPrint.css') }}">

    <title>Document</title>
</head>

<body>
    <header></header>
    <section>
        <form action="" id="crmOppertunityUpdateForm">
            <input disabled type="hidden" name="oppertunity_id" id="oppertunity_id"
                value="{{ $crmOppertunity->oppertunity_id }}">
            @csrf
            <div class="container-fluid parent_wrapper">
                <div class="row gy-4 parent_row">
                    <!--  lable div end  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <div class="row position-relative nested_first_row">
                                <div class="col-md-4 nested_first_row_col">
                                    <h5 class=""> Oppertunity Details</h5>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->




                    <!-- user information start  -->
                    <div class="col-md-8 parent_row_col">
                        <div class="parent">
                            <h5 class="">Oppertunity Information</h5>
                            <div class="row nested_first_row">

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="subject">Subject</label>
                                    <textarea disabled name="subject" id="subject" cols="" rows="1" placeholder="Subject"
                                        class="form-control input_diabled">{{ $crmOppertunity->subject }}</textarea>
                                </div>

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="contact_id">Contact Name </label>
                                    <select disabled name="contact_id" id="contact_id" class="form-select contact_id">
                                        <option></option>
                                        @foreach ($contacts as $contact)
                                            <option value="{{ $contact->user_id }}"
                                                {{ $contact->user_id == $crmOppertunity->contact_id ? 'selected' : '' }}>
                                                {{ $contact->username }}</option>
                                        @endforeach
                                    </select>
                                </div>



                                <div class="col-md-6 nested_first_row_col">
                                    <label for="category_id">Category </label>
                                    <select disabled name="category_id" id="category_id"
                                        class="form-select category_id">
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                {{ $category->category_id == $crmOppertunity->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="priority">Priority </label>
                                    <select disabled name="priority" id="priority" class="form-select priority">
                                        <option></option>
                                        <option value="lowest"
                                            {{ $crmOppertunity->priority == 'lowest' ? 'selected' : '' }}>
                                            Lowest</option>
                                        <option value="low"
                                            {{ $crmOppertunity->priority == 'low' ? 'selected' : '' }}>Low
                                        </option>
                                        <option value="normal"
                                            {{ $crmOppertunity->priority == 'normal' ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="high"
                                            {{ $crmOppertunity->priority == 'high' ? 'selected' : '' }}>
                                            High</option>
                                        <option value="highest"
                                            {{ $crmOppertunity->priority == 'highest' ? 'selected' : '' }}>Highest
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="lead_id">Lead Name </label>
                                    <select disabled name="lead_id" id="lead_id" class="form-select lead_id">
                                        <option></option>
                                        @foreach ($leads as $lead)
                                            <option value="{{ $lead->lead_id }}"
                                                {{ $crmOppertunity->lead_id == $lead->lead_id ? 'selected' : '' }}>
                                                {{ $lead->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- user information end  -->

                    <!-- related information end  -->
                    <div class="col-md-4 parent_row_col">
                        <div class="parent h-100">
                            <h5 class="">Related Information</h5>
                            <div class="row nested_first_row">
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="employee_id">Sales Person Name </label>
                                    <select disabled name="employee_id" id="employee_id"
                                        class="form-select employee_id">
                                        <option></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->user_id }}"
                                                {{ $employee->user_id == $crmOppertunity->employee_id ? 'selected' : '' }}>
                                                {{ $employee->username }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="lead_reffered_by">Oppertunity Reffered By</label>
                                    <input disabled type="text" class="form-control input_diabled"
                                        placeholder="Oppertunity reffered By" aria-label="Oppertunity reffered By"
                                        name="lead_reffered_by" id="lead_reffered_by"
                                        value="{{ $crmOppertunity->lead_reffered_by }}">

                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- related information end  -->


                    <!--  Descriptions  start  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <h5 class="">Descriptions</h5>
                            <div class="row nested_first_row">



                                <div class="col-md-4 nested_first_row_col">
                                    <label for="internal_notes">Internal Notes</label>
                                    <textarea disabled name="internal_notes" id="" cols="" rows="1" id="internal_notes"
                                        placeholder="Internal Notes" class="form-control input_diabled">{{ $crmOppertunity->internal_notes }}</textarea>
                                </div>

                                <div class="col-md-4 nested_first_row_col">
                                    <label for="next_action_remarks">Next Action Remarks</label>
                                    <textarea disabled name="next_action_remarks" id="" cols="" rows="1" id="next_action_remarks"
                                        placeholder="Next Action remarks" class="form-control input_diabled">{{ $crmOppertunity->next_action_remarks }}</textarea>
                                </div>
                                <div class="col-md-4 nested_first_row_col">
                                    <label for="next_action_date">Next Action Date</label>
                                    <input disabled type="date" name="next_action_date" id="next_action_date"
                                        class="form-control input_diabled"
                                        value="{{ $crmOppertunity->next_action_date }}">
                                </div>
                                <div class="col-md-4 nested_first_row_col">
                                    <label for="next_action_closing_date">Next Action closing Date</label>
                                    <input disabled type="date" name="next_action_closing_date"
                                        id="next_action_closing_date" class="form-control input_diabled"
                                        value="{{ $crmOppertunity->next_action_closing_date }}">
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
