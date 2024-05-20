@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/companies_positions/css/companies_positions.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="companies_positions_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                    Companies Postion added 
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when companies positions  added  start  -->
                                <!-- user name -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Position Name" aria-label="Position Name" name="position_name" id="position_name">
                                </div>
                                <!-- user position id -->
                                <div class="mb-3 col-md-6 position-relative">
                                    <select name="company_id" id="company_id" class="form-select company_id">
                                        <option></option>
                                        <option value="1">company_id</option>
                                    </select>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="added_com_pos_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Add Position</button>
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
    // martial status
    $('#company_id').select2({
        placeholder:"Select Company",
        allowClear: true,
        width:'100%',
    });
    // add position start 
    $('#companies_positions_form').validate({
        rules:{
            position_name:{
                required:true,
            
        },
        company_id:{
            required:true,
            number:true,
        },
    },
    messages:{
        position_name:{
            required:"Position Required",
        },
        company_id:{
            required:"Country Required",
            number:"only numbers are allowed",
        },
    },
    submitHandler:function(form)
    {
        $.ajax({
            type: "post",
            url: base_url+"companies_position",
            data: $(form).serialize(),
            dataType: "json",
            success: function (response) {
                if(response){
    $('.user_updated_msg').removeClass('d-none')

                }
            }
        });
    }
})


// add position end 
// dattables 
$(function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })


    $('#view_companies_positions').DataTable({
        processing:true,
        serverSide:true,
        ajax:base_url+'get_data_com_pos',
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'position_name',name:'position_name'},
            {data:'action',name:'action'},
        ]
        
    });

})
// dattables end

// delete user start 
$(document).on('click','.com_pos_delete_btn',function (param) {  
    let delete_com_pos_id= $(this).data('delete_com_pos_id');
    $('.confirm_delete_com_pos').on('click',function(){
        $.ajax({
            type: "post",
            url: base_url+"delete_com_pos",
            data: {delete_com_pos_id:delete_com_pos_id},
            dataType: "json",
        success: function (response) {
            if(response){
            $('#view_companies_positions').DataTable().ajax.reload();
            }
        }
    });

        })
})
// delete user end 
// update start 
$(document).on('click','.com_pos_edit_btn',function (param) {  
    let update_com_pos_id= $(this).data('update_com_pos_id')
    location.replace(base_url+"updatePosition/"+update_com_pos_id)
})
$('#companies_positions_updated_form').validate({
    rules:{
        position_name:{
            required:true,
        
    },
    company_id:{
        required:true,
        number:true,
    },
},
messages:{
    position_name:{
        required:"Position Required",
    },
    company_id:{
        required:"Country Required",
        number:"only numbers are allowed",
    },
},
submitHandler:function(form)
{
    $.ajax({
        type: "post",
        url: base_url+"update_com_pos",
        data: $(form).serialize(),
        dataType: "json",
        success: function (response) {
            if(response){
$('.user_updated_msg').removeClass('d-none')

            }
        }
    });
}
})
// update end 

 
});
</script>
@endSection