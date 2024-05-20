"use strict";
$(document).ready(function () {
    const base_url="http://127.0.0.1:8000/";
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