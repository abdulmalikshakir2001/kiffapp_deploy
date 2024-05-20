$(document).ready(function () {
    const base_url= 'http://127.0.0.1:8000/';

    $(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $('#company_subscription').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: base_url+"add_company_subs",
                data: $('#company_subscription').serialize(),
                success: function (response) {
                    // alert(response);
                    console.log(response);
                }
            });
        })
    })

    

    
    
});