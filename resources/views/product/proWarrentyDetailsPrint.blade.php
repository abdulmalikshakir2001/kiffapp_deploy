<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/product/css/proWarrenty.css') }}">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/product/css/proWarrentyDetailsPrint.css') }}">
    <title>Document</title>
</head>
<body>
    <header></header>
    <section>
        <form action="" id="proWarrentyUpdateForm">
            <input disabled type="hidden" name="warrenty_id" id="warrenty_id" value="{{ $warrenty->warrenty_id }}">
            @csrf
            <div class="container-fluid parent_wrapper">
                <div class="row gy-4 parent_row">
                    <!--  lable div end  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class=""> Warrenty Details</h5>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->


                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <h5 class="">Warrenty Information</h5>
                            <div class="row gy-3 nested_first_row">




                                <div class="col-md-6 nested_first_row_col">
                                    <label for="warrenty_name"> Name </label>
                                    <select disabled name="warrenty_name" id="warrenty_name" class="form-select warrenty_name">
                                        <option></option>
                                        <option value="limited" {{ $warrenty->warrenty_name =='limited'?'selected':''}}>Limited</option>
                                        <option value="lifetime" {{$warrenty->warrenty_name =='lifetime'?'selected':'' }}>Life Time</option>
                                    </select>
                                </div>


                                <div class="col-md-6 nested_first_row_col">
                                    <label for="duration">Duration</label>
                                    <input disabled type="text" name="duration" id="duration" class="form-control input_disabled" value="{{$warrenty->duration}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="duration_time"> Duration Time </label>
                                    <select name="duration_time" id="duration_time" class="form-select duration_time">
                                        <option></option>
                                            <option value="day" {{$warrenty->duration_time =='day'?'selected':'' }}>Day</option>
                                            <option value="month" {{$warrenty->duration_time =='month'?'selected':'' }}>Month</option>
                                            <option value="year" {{$warrenty->duration_time =='year'?'selected':'' }}>Year</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="description">Description</label>
                                    <textarea disabled name="description" id="description" cols="" rows="1" placeholder="Description"
                                        class="form-control input_disabled">{{$warrenty->description}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>


                    
                </div>
            </div>
        </form>


    </section>
    <footer></footer>
    
</body>
</html>