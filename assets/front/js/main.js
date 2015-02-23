$(function() {
// ---------------------------------- on page loade
    $("#tc2").addClass('tc');
// ---------------------------------- end on page loade
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
    /*$('.ac a').each(function() {
            if ($(this).attr('href') == location.href.split("/").slice(-1)){
		 $(this).parent().addClass('tc');
	    }
        });*/
     $("#tc2 a").click(function(){
        $(this).parent().addClass('tc');
        $("#tc3").removeClass('tc');
     });
     $("#tc3 a").click(function(){
        $(this).parent().addClass('tc');
        $("#tc2").removeClass('tc');
     });
     $("#check-in,#check-out").change(function(){
        var date1_val = $("#check-in").val().split('-');
        date1_val = date1_val[2]+'-'+date1_val[1]+'-'+date1_val[0];

        var date2_val = $("#check-out").val().split('-');
        date2_val = date2_val[2]+'-'+date2_val[1]+'-'+date2_val[0];

        var date1 = new Date(date1_val);
        var date2 = new Date(date2_val);
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        console.log(diffDays);
        if (isNaN(diffDays)) {diffDays='0'};
        $("#nights").val(diffDays);
     });
        
// ---------------------------------- end header menus
// ---------------------------------- Modify Date
    $("#m-date").click(function(){
        $("#mdate").slideToggle();
    });
// ---------------------------------- end Modify Date
// ---------------------------------- show room information
     $('.dtl-show').click(function(){
        var room_id = $(this).data('room-id');
        $('.dtl-'+room_id).slideToggle("slow");
     });

// ---------------------------------- end show room information
     $('.white-tooltip').tooltip();
// ---------------------------------- fixed-parts
     $(window).scroll(function(){
        var x = $('#fixed-part'),
            y = $('#fixed-row'),
            z = $('#fixed-rez'),
            a = ($('#tab_b').height()-150),
            s = $(window).scrollTop();
            if (s > 200) x.addClass('fixed-part');
            else x.removeClass('fixed-part');
            if (s > 200) y.addClass('fixed-row');
            else y.removeClass('fixed-row');
            if (s > 200) z.addClass('fixed-rez');
            else z.removeClass('fixed-rez');
            if (s > a) z.css({"top":"-100px"});
            else z.css({"top":"30px"});
    });
    $("#lc-a,#lc-b").click(function(){
        $(this).next().slideToggle();
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
    $(".magni").hover(function(){
        $(".magnify").show();
    },function(){
        $(".magnify").hide();
    });
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd-mm-yy'
    });
// ---------------------------------- select menus
    $("#dtls-sh1").click(function(){
        $("#dtl-dtl1").slideDown();
        $("#dtls-sh1").hide();
        $("#dtls-h1").show();
    });
    $("#dtls-h1").click(function(){
        $("#dtl-dtl1").slideUp();
        $(this).hide();
        $("#dtls-sh1").show();
    });
    $("#dtls-sh1in").click(function(){
        $("#dtl-dtl1in").slideDown();
        $("#dtls-sh1in").hide();
        $("#dtls-h1in").show();
    });
    $("#dtls-h1in").click(function(){
        $("#dtl-dtl1in").slideUp();
        $(this).hide();
        $("#dtls-sh1in").show();
    });
    $("#dtls-sh2").click(function(){
        $("#dtl-dtl2").slideDown();
        $(this).hide();
        $("#dtls-h2").show();
    });
    $("#dtls-h2").click(function(){
        $("#dtl-dtl2").slideUp();
        $(this).hide();
        $("#dtls-sh2").show();
    });
    $("#dtls-sh3").click(function(){
        $("#dtl-dtl3").slideDown();
        $(this).hide();
        $("#dtls-h3").show();
    });
    $("#dtls-h3").click(function(){
        $("#dtl-dtl3").slideUp();
        $(this).hide();
        $("#dtls-sh3").show();
    });
// ---------------------------------- select menus
    $(".sl-menu").change(function(){
        var ro = 0, pr = 0;
        $(".sl-menu").each(function () {
            var r = $(this).val().split('-');
            ro += parseFloat(r[0]);
            $( "#rom" ).val(ro);
            pr += parseFloat(r[1]);
            $("#tot").val(pr);
        });
    });
   	$('.sl-menu').change(function(){
		var room_id 	= $(this).find(':selected').data('room');
		var promotion	= $(this).find(':selected').data('promotion');
		var qty 	 	= $(this).find(':selected').data('qty');
		var price 		= $(this).find(':selected').data('price');
		var type 		= $(this).find(':selected').data('type');
		var data = {"room":room_id, "promotion":promotion, "qty":qty, "price":price};
		$.ajax({
	        url: "test.php",
	        type: "POST",
	        data: data,
	        dataType: 'text json',
	        success: function(data){
	        	console.log(data);
	        },
	        error:function(){

	        }   
	    }); 

	   	//console.log(data);
	});
    /*$(".sl-menu").change(function(){
        var ro = 0, pr = 0;
            var r = $(this).val().split('-');
            console.log(r);
            ro = parseFloat(r[0]);
            pr = parseFloat(r[1]);
            var val = serialize(r);
            $.ajax({
                type: 'POST',
                url: 'get-data.php',
                data: val, // or JSON.stringify ({name: 'jonas'}),
                success: function(data) { 
                    alert('data: ' + data); 
                },
                //contentType: "application/json",
                dataType: 'json'
            });
    });*/
// ---------------------------------- end select menus
    $("#reserve").click(function(){
        $("#ddd").click();
    });

    $('#persons').change(function(e){
        e.preventDefault();
        var max_person = $(this).val();
        if (max_person ==0) {
            $('.max-person').slideDown();
        }else{
            //burası daha mantıklı
            $('.max-person').slideDown();
            $('.max-person:not(.max-'+max_person+')').slideUp();
            /* çok saçma oldu bu
            $('.max-person').each(function(){
                //console.log(this);
                if (true == $(this).hasClass('max-'+max_person)) {
                    $('.max-'+max_person).slideDown();
                    $('.max-person:not(.max-'+max_person+')').slideUp();
                    //console.log('.max-'+max_person+'-shown');
                }else{
                    $('.max-'+max_person).slideUp();
                    $('.max-person:not(.max-'+max_person+')').slideDown();
                    //console.log('.max-'+max_person+'-hidden');
                };
            });
            */
            
        }
        
    });

});