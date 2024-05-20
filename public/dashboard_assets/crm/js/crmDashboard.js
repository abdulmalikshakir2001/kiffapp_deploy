$(document).on('click',function(e){
     if( $(e.target).next().hasClass('show')){


        // $(this).css({"border-radius": "50%"})
        $(e.target).removeClass('borderRadius10')


        // $(this).css({'border-radius':'none !important'})

     }
     else{
        $('.lang_drop_down_butt').addClass('borderRadius10')



     }
})