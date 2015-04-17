$(function() {
// ---------------------------------- header menus
     $("#money-link").click(function(){
        $(".m2").toggle();
        if($(this).parent().hasClass("bg-000")) {
            $(this).parent().removeClass("bg-000");
        } else {
            $(this).parent().addClass("bg-000");
        }
    });
    $("#lang-link").click(function(){
        $(".m3").toggle();
        if($(this).parent().hasClass("bg-000")) {
            $(this).parent().removeClass("bg-000");
        } else {
            $(this).parent().addClass("bg-000");
        }
    });
// ---------------------------------- end header menus
// ---------------------------------- Modify Date
    $("#m-date").click(function(){
        $("#mdate").slideToggle();
    });
// ---------------------------------- end Modify Date
// ---------------------------------- show room information
     $('#dtl-show1').click(function(){
         $('.dtl1').slideToggle("slow");
     });
     $('#dtl-show2').click(function(){
         $('.dtl2').slideToggle("slow");
     });
// ---------------------------------- end show room information
     $('#non-refundable,#free-cancellation').tooltip();
// ---------------------------------- fixed-part
     $(window).scroll(function(){
        var x = $('#fixed-part'),
        scroll = $(window).scrollTop();
            if (scroll > 200) x.addClass('fexed-part');
            else x.removeClass('fexed-part');
    });
// ---------------------------------- end fixed-part
// ---------------------------------- accordion
    $(".accordion > .stay .stay-show").click(function(){
        $(this).parent().toggleClass('expanded');
    });
    $("#close-img,#close-link").click(function(){
        $(this).parents("div.stay").removeClass('expanded');
    });
// ---------------------------------- end accordion
$(".fancybox").fancybox({
	       	openEffect: 'elastic',
    		closeEffect: 'elastic'
	       	});
});