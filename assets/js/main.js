
$(document).ready(function(){

    $(".go-to").click(function(event){
        event.preventDefault();
        var offset = $($(this).attr('href')).offset().top;
        $('html, body').animate({scrollTop:offset-120}, 500);
       });
   
});
