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
/*
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
    */


    function form_builder(room_id){
     
     $.ajax({
            url: base_url + "actions/get_room_preferences",
            data : {"room_id":room_id},
            method: "POST",
            dataType: "json",
            success: function (response) {

            var options = {"room_id":room_id,"data":response};
            $.post(base_url + "actions/room_preferences_builder",options )
                .done(function( data ) {
                $('#room_preferences').after(data);        
            });


            }
        });

    }



   	$('.sl-menu').change(function(){
        var default_currency    = $(this).data('currency');
		var room_id 	= $(this).find(':selected').data('room');
		var promotion	= $(this).find(':selected').data('promotion');
		var qty 	 	= $(this).find(':selected').data('qty');
		var price 		= $(this).find(':selected').data('price');
        var type        = $(this).find(':selected').data('type');
        var name        = $(this).find(':selected').data('room-name');
        var desc        = $(this).find(':selected').data('desc');
        var rate        = $(this).find(':selected').data('rate');
		var currency 	= $(this).find(':selected').data('currency');
        
		var data = {"default_currency":default_currency, "room":room_id, "promotion":promotion, "qty":qty, "price":price, "type":type, "name":name, "desc": desc,"rate":rate,"currency":currency};
		
        //generate preferences form builder
        if (qty != 0) {
           form_builder(room_id);
        }else{
            //delete room preference
            $('.preferences_'+room_id).remove();
        }
        

        $.ajax({
	        url: base_url + "hotel/user_cart",
	        type: "POST",
	        data: data,
	        dataType: 'text json',
	        success: function(data){
                $("#rom").val(data.total_qty);
                $("#total_room").html(data.total_qty);
                $("#tot").val(data.user_price);
                if (promotion != 0 && qty!=0) {
                    $('#best_price').hide().html('<p class="c-f00">You got the best price</p>').fadeIn('slow');
                }else{
                     $('#best_price').fadeOut();
                };
                $('.room').remove();
                $('.avrg').show();
                //insert roo details
                $.each(data.details, function(i,val){

                html = '<div class="room">'+
                    '<div class="park-view">'+val.name+' x '+val.qty+'</div>'+
                    '<div class="avrg">'+
                        '<div>'+val.desc+'/night</div>'+
                        '<div>'+val.user_price+' '+currency+'</div>'+
                    '</div>'+
                '</div>';

                $('.items_in_cart').after(html);

                });

                var extras_price = $('#extras_total').val();
                var extras_user_price = $('#extras_total_user').val();
                var total_price = parseInt(extras_price)+data.total_price;
                var total_user_price = parseInt(extras_user_price)+data.user_price;


                $('.avrgtotal').html(total_user_price+' '+currency);

                $('#rooms_total').val(data.total_price);
                $('#rooms_total_user').val(data.user_price);
                //if user currency is different
                if(data.currency != data.default_currency){

                    $('.avrgdefault').html(total_price +' '+data.default_currency);
                    html ='<div>*'+data.currency+' rates are for information. The hotel accepts payment in '+default_currency+'</div>';
                    $('.price_information').html(html);
                }
	        	//console.log(data);
	        },
	        error:function(){
                alert('Server error occured. Thats all we know.');
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
    $("#reserve_button").click(function(e){
         e.preventDefault();
        //activaTab('tab_c');
        $("#ddd").click();

    });

    function activaTab(tab){
        $('.nav-pills a[href="#' + tab + '"]').tab('show');
    };

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


    //enhance your stay slider
    $("#splash").zAccordion({
        timeout: 4500,
        speed: 500,
        slideClass: 'slide',
        pause : true,
        trigger : 'click',
        animationStart: function () {
            $('#splash').find('li.slide-previous div').fadeOut();
        },
        animationComplete: function () {
            $('#splash').find('li.slide-open div').fadeIn();
        },
        buildComplete: function () {
            $('#splash').find('li.slide-closed div').css('display', 'none');
            $('#splash').find('li.slide-open div').fadeIn();
        },
        startingSlide: 1,
        slideWidth: 600,
        width: 840,
        height: 240
    });

 $('.ui-datepicker-div').css('zIndex', 50);
});

function form_to_arr(div){

   var data =  $(div+' :input').serialize();

   $.ajax({
            url: base_url + "hotel/user_extras",
            type: "POST",
            data: data,
            dataType: 'json',
            success: function(ret){

            //change button value
            if (ret.action == 'add') {
                $('#button'+ret.extra_id).val('Remove');
                $('#extra_type'+ret.extra_id).val('delete');
            }else{
                $('#button'+ret.extra_id).val('Add');
                $('#extra_type'+ret.extra_id).val('add');
            };
            
            //show extra info in cart

            var cnt = Object.keys(ret.details).length;
            if (cnt > 0) {
                $('.extras').fadeIn();
            }else{
                $('.extras').fadeOut();
            }
            
            $('.extra_info').remove();

            //list user extras in cart
            $.each(ret.details, function(i,val){
            html = '<div class="extra_info">'+
                    '<div>'+val.name+'</div>'+
                    '<div>'+ret.user_price+' '+ret.user_currency+'</div>'+
                    '</div>';

            $('.extras_in_cart').after(html);

            });

            $('#extras_total').val(ret.total_price);
            $('#extras_total_user').val(ret.user_price);

            var room_price = $('#rooms_total').val();
            var room_user_price = $('#rooms_total_user').val();
            var total_price = parseInt(room_price)+ret.total_price;
            var total_user_price = parseInt(room_user_price)+ret.user_price;
            
            //$('.avrgdefault').html(total_price +' '+ret.user_currency);
            $('.avrgtotal').html(total_user_price+' '+ret.user_currency);

            if(ret.currency != ret.user_currency){
                $('.avrgdefault').html(total_price +' '+ret.currency);
                html ='<div>*'+ret.user_currency+' rates are for information. The hotel accepts payment in '+ret.currency+'</div>';
                $('.price_information').html(html);
            }
             
               // console.log(ret);
            },
            error:function(){

            }   
        }); 

}
