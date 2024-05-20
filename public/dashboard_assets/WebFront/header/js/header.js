"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
    tinymce.init({
        selector: "#header",
        plugins:
            "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
        toolbar:
            "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
        tinycomments_mode: "embedded",
        tinycomments_author: "Author name",
        mergetags_list: [
            { value: "First.Name", title: "First Name" },
            { value: "Email", title: "Email" },
        ],
    });

    //   update header start
    $("#webfront_header_updated_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url + "database_update_head",
            data: $("#webfront_header_updated_form").serialize(),
            success: function (response) {
                $('.user_updated_msg').removeClass('d-none')
            },
        });
    });
    //   update header end
    //   update body start
    $("#webfront_body_updated_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url + "database_update_body",
            data: $("#webfront_body_updated_form").serialize(),
            success: function (response) {
                $('.user_updated_msg').removeClass('d-none')
            },
        });
    });
    //   update body end
    //   update footer start
    $("#webfront_footer_updated_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url + "database_update_footer",
            data: $("#webfront_footer_updated_form").serialize(),
            success: function (response) {
                $('.user_updated_msg').removeClass('d-none')
            },
        });
    });
    //   update footer start
});
