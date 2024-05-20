$(document).ready(function () {
    const base_url="http://127.0.0.1:8000/";
    $(document).on('click','.apply_job_btn',function (e) {
        e.preventDefault();



        let job_form= $(this).parents('#applied_job_candidate_form')[0]
            $.ajax({
                type: "post",
                url: base_url + "applied_job",
                data: new FormData(job_form),
            processData:false,
            contentType:false,
                success: function (response) {
                    if(response=='application_created'){
                        $(job_form).find('.resume_sent_msg').removeClass('d-none')
                    }
                    else if(response=='apply_exist') {
                        $(job_form).find('.apply_exist').removeClass('d-none')

                     }
                },
            });
})
});