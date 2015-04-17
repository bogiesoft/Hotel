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
    /*$(".accordion > .stay").hover(
    function(){
      var $this = $(this);
      $this.stop().animate({"width": "700px"},500);
      $this.addClass('expanded');
    },
    function(){
      var $this = $(this);
      $this.removeClass('expanded');
      $this.stop().animate({"width": "115px"},1000);
    }
    );*/
    /*$(".accordion > .stay").click(function(){
        if($(this).hasClass('expanded')){
            $(this).removeClass('expanded');
        }else{
            $(this).addClass('expanded');
        }
    });*/
    $(".accordion > .stay .stay-show").click(function(){
        $(this).parent().toggleClass('expanded');
    });
    $("#close-img,#close-link").click(function(){
        $(this).parents("div.stay").removeClass('expanded');
    });
// ---------------------------------- end accordion
	$('#carousel').carouFredSel({
		responsive: true,
		circular: true,
		auto: false,
		items: {
			visible: 1,
			width: 500,
			height: '80%'
		},
		scroll: {
			fx: 'fade'
		}
	});
	$('#thumbs').carouFredSel({
		responsive: true,
		circular: false,
		infinite: false,
		auto: false,
		prev: '#prev',
		next: '#next',
		items: {
			visible: {
				min: 2,
				max: 6
			},
			width: 150,
			height: '66%'
		}
	});

	$('#thumbs a').click(function() {
		$('#carousel').trigger('slideTo', '#' + this.href.split('#').pop() );
		$('#thumbs a').removeClass('selected');
		$(this).addClass('selected');
		return false;
	});
    
	$('#carousel2').carouFredSel({
		responsive: true,
		circular: true,
		auto: false,
		items: {
			visible: 1,
			width: 500,
			height: '80%'
		},
		scroll: {
			fx: 'fade'
		}
	});
	$('#thumbs2').carouFredSel({
		responsive: true,
		circular: false,
		infinite: false,
		auto: false,
		prev: '#prev1',
		next: '#next2',
		items: {
			visible: {
				min: 2,
				max: 6
			},
			width: 150,
			height: '66%'
		}
	});

	$('#thumbs2 a').click(function() {
		$('#carousel2').trigger('slideTo', '#' + this.href.split('#').pop() );
		$('#thumbs2 a').removeClass('selected');
		$(this).addClass('selected');
		return false;
	});
});