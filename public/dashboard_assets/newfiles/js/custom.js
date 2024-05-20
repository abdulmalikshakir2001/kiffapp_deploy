"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
    // main-content = overflow hidden

    // applying class to side nav after refreshing page end
    // left dropdown start
    let lef_nav_link_arr=[]

    $(".left-nav-link").on("click", function (param) {
        $(this).next().toggleClass("trasn_height");
        let left_menu_drop_angle=$(this).children('.angle')
        if($(left_menu_drop_angle).hasClass('toggle_angle')){
        $(left_menu_drop_angle).removeClass('toggle_angle')
        }
        else{
        $(left_menu_drop_angle).addClass('toggle_angle')

        }
            // .toggleClass('toggle_angle')

        // $.toggleClass(".toggle_angle");
        let lef_nav_link_id = $(this).attr("id");
        // drop down to stroe value in session storage start 
         let storage_drop_arr= JSON.parse(sessionStorage.getItem('dropdown_arr'))
         if(!Array.isArray(storage_drop_arr)){
            storage_drop_arr=[]
            sessionStorage.setItem('dropdown_arr',JSON.stringify(storage_drop_arr))

         }
        let sess_storage_arr= JSON.parse( sessionStorage.getItem('dropdown_arr'))
            if(sess_storage_arr.includes(lef_nav_link_id) ){
                let lef_nav_link_index= sess_storage_arr.indexOf(lef_nav_link_id)
                sess_storage_arr.splice(lef_nav_link_index,1)
                // lef_nav_link_arr.splice(lef_nav_link_id,1)
            sessionStorage.setItem('dropdown_arr',JSON.stringify(sess_storage_arr))
            }
            else{
                sess_storage_arr.push(lef_nav_link_id)
                sessionStorage.setItem('dropdown_arr',JSON.stringify(sess_storage_arr))
            }
        // drop down to stroe value in session storage end

    });
    // left dropdown end
    // styling date field start
    let dob = $("#dob")[0];
    $(dob).addClass("empty");
    $(dob).on("change", function () {
        console.log(dob);
        let dob_val = $(dob).val();
        if (dob_val == "") {
            $(dob).addClass("empty");
        } else {
            $(dob).removeClass("empty");
        }
    });
    // styling date field end
    // testing start
    // pages in histroy
    // we can get forward or backword histroy pages lenght  // same window /tab how  manay opeend
    // testing end
    $(".fa_xmark_user").on("click", function () {
        $(".user_updated_msg").addClass("d-none");
    });
    $('#logout_btn').on('click',function(){
        sessionStorage.removeItem('dropdown_arr')
    })



    if (performance.navigation.type == performance.navigation.TYPE_NAVIGATE || performance.navigation.type == performance.navigation.TYPE_RELOAD ) {
        let dropdown_arr= JSON.parse(sessionStorage.getItem('dropdown_arr'))
        $(dropdown_arr).each(function (key,value) { 
             $('#'+value).next().addClass('trasn_height')
             $('#'+value).children('.angle').addClass('toggle_angle')
         })

      } else {
        console.info( "This page is not reloaded");
      }
    
    //   
    
});

