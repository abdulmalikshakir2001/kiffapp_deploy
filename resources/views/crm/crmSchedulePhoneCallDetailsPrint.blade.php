<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmSchedulePhoneCall.css') }}">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/crm/css/crmSchedulePhoneCallDetailsPrint.css') }}">

    <title>Document</title>
</head>

<body>
    <header></header>
    <section>
        <form action="" id="crmSchedulePhoneCallUpdateForm">
            <input disabled type="hidden" name="schedule_phone_call_id" id="schedule_phone_call_id"
                value="{{ $schedulePhoneCalls->schedule_phone_call_id }}">
            @csrf
            <div class="container-fluid parent_wrapper">
                <div class="row gy-4 parent_row">
                    <!--  lable div end  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <div class="row position-relative">
                                <div class="col-md-4">
                                    <h5 class=""> Schedule Phone Call Details</h5>
                                </div>
                                


                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->



                    <!-- user information start  -->
                    <div class="col-md-8 parent_row_col">
                        <div class="parent">
                            <h5 class="">Schedule Phone Call Information</h5>
                            <div class="row gy-3 nested_first_row">


                                {{-- contact id --}}

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="contact_id">Contact Name </label>
                                    <select disabled name="contact_id" id="contact_id" class="form-select contact_id">
                                        <option></option>
                                        @foreach ($contacts as $contact)
                                            <option value="{{ $contact->user_id }}"
                                                {{ $contact->user_id == $schedulePhoneCalls->contact_id ? 'selected' : '' }}>
                                                {{ $contact->username }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                {{-- category id --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="category_id">Category </label>
                                    <select disabled name="category_id" id="category_id"
                                        class="form-select category_id">
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                {{ $category->category_id == $schedulePhoneCalls->category_id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- priority --}}

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="priority">Priority </label>
                                    <select disabled name="priority" id="priority" class="form-select priority">
                                        <option></option>
                                        <option value="lowest"
                                            {{ $schedulePhoneCalls->priority == 'lowest' ? 'selected' : '' }}>Lowest
                                        </option>
                                        <option value="low"
                                            {{ $schedulePhoneCalls->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="normal"
                                            {{ $schedulePhoneCalls->priority == 'normal' ? 'selected' : '' }}>Normal
                                        </option>
                                        <option value="high"
                                            {{ $schedulePhoneCalls->priority == 'high' ? 'selected' : '' }}>High</option>
                                        <option value="highest"
                                            {{ $schedulePhoneCalls->priority == 'highest' ? 'selected' : '' }}>Highest
                                        </option>
                                    </select>
                                </div>
                                {{-- lead id --}}

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="lead_id">Lead Name </label>
                                    <select disabled name="lead_id" id="lead_id" class="form-select lead_id">
                                        <option></option>
                                        @foreach ($leads as $lead)
                                            <option value="{{ $lead->lead_id }}"
                                                {{ $lead->lead_id == $schedulePhoneCalls->lead_id ? 'selected' : '' }}>
                                                
                                                {{ $lead->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- lead id --}}

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="oppertunity_id">Oppertunity </label>
                                    <select disabled name="oppertunity_id" id="oppertunity_id"
                                        class="form-select oppertunity_id">
                                        <option></option>
                                        @foreach ($oppertunities as $oppertunity)
                                            <option value="{{ $oppertunity->oppertunity_id }}"
                                                {{ $oppertunity->oppertunity_id == $schedulePhoneCalls->oppertunity_id ? 'selected' : '' }}>
                                                
                                                {{ $oppertunity->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- date --}}

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="date"> Date</label>
                                    <input disabled type="date" name="date" id="date"
                                        class="form-control input_diabled" value="{{ $schedulePhoneCalls->date }}">
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
                                    <label for="duration">Duration</label>
                                    <input disabled type="text" class="form-control input_diabled"
                                        placeholder="Duration" aria-label="Schedule Phone Call reffered By"
                                        name="duration" id="duration" value="{{ $schedulePhoneCalls->duration }}">

                                </div>

                                <div class="col-md-12 nested_first_row_col">
                                    <label for="responsible">Responsible</label>
                                    <input disabled type="text" class="form-control input_diabled"
                                        placeholder="Responsible" aria-label="Expected Revenue" name="responsible"
                                        id="responsible" value="{{ $schedulePhoneCalls->responsible }}">
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

                                <div class="col-md-6 nested_first_row_col">
                                    <label for="remarks">Remarks</label>
                                    <input disabled type="text" class="form-control input_diabled"
                                        placeholder="Remarks" aria-label="Schedule Phone Call reffered By"
                                        name="remarks" id="remarks" value="{{ $schedulePhoneCalls->remarks }}">
                                </div>
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="call_summary">Call Summary</label>
                                    <input disabled name="call_summary" id="" cols="" rows="1" id="call_summary"
                                        placeholder="Call Summary" class="form-control input_diabled" value="{{ $schedulePhoneCalls->call_summary }}">
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
