<?php $this->load->view('header'); ?>
<div class="pageheader">
  <h2><i class="fa fa-table"></i> <?php echo lang('rate_plans'); ?></h2>
  <div class="breadcrumb-wrapper">
    <span class="label"><?php echo lang('you_are_here'); ?></span>
    <ol class="breadcrumb">
      <li><a href="index.html"><?php echo lang('manage'); ?></a></li>
      <li class="active"><?php echo lang('rate_plans'); ?></li>
    </ol>
  </div>
</div>

<div class="contentpanel">
    <div class="panel panel-default">
    <div class="panel-body">
      <div class="col-md-12 col-sm-3">
      <div class="row">
        <form class="form-inline" method="GET">
            <div class="form-group">
              <label class="sr-only" for="start_date"><?php echo lang('start_date'); ?></label>
              <input type="text" name="start_date" class="form-control" id="start_date" value="<?php echo $start_date; ?>">
            </div>
            <div class="form-group">
              <label class="sr-only" for="end_date"><?php echo lang('end_date'); ?></label>
              <input type="text" name="end_date" class="form-control" id="end_date" value="<?php echo $end_date; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><?php echo lang('send'); ?></button>
          </form>
      </div>
      </div>
    </div>
    </div>


      <?php if($error) : ?>
        <div class="col-md-12 col-sm-3">
        <div class="row">
          <div class="alert alert-danger">
          <?php echo $error; ?>
          </div>
        </div>
        </div>
      <?php else: ?>


      <?php //print_r($prices); ?>
      <table class="table mb30 table-condensed" id="selectable">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <?php foreach ($data['dates'] as $key => $date): 
            $day = date('D',strtotime($date)); ?>

            <th <?php echo ($day == 'Sat' or $day == 'Sun') ? 'style="background-color:#FFEDB6; font-size: 12px; text-align: center;"' : 'style="font-size: 12px; text-align: center;"'; ?>>
            <?php echo date('M',strtotime($date)); ?><br />
            <?php echo date('d',strtotime($date)); ?><br />
            <?php echo $day; ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>

        <tbody>
            <?php foreach ($data['rooms'] as $k => $room):?>
              <tr>
                <th colspan="2" class="tdRoomName fixed-" data-name="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></th>
                <?php foreach ($room['prices'] as $day => $price) {
                  //print_r($price); exit;
                  if (@$price['base_price']) {
                    $stoped = $price['stoped_arrival'] == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                    echo '<th '.$stoped.'>'.@$price['reserved'].'/'.$price['available'].'</th>';
                  }else{
                    echo '<th>N/A</th>';
                  }

                }?>
              </tr>
              <?php //print_r($room['prices']); exit; ?>
              <tr>
                <th colspan="2"><?php echo lang('best_available_rate'); ?></th>
                <?php foreach ($room['prices'] as $day => $price) {
                  if (@$price['price_type']) {
                    $stoped = $price['stoped_arrival'] == '1' ? 'class="base_price tdRed"' : 'class="base_price tdGreen"';

                    if (@$price['price_type'] == '1') {
                      $roomPrice = substr(@$price['base_price'],'0', '-3');
                    }else{
                      $roomPrice = substr(@$price['double_price'],'0', '-3');
                    }
                    
                    echo '<td '.$stoped.' data-price-type="'.$price['price_type'].'" data-available="'.$price['available'].'" data-max-stay="'.$price['max_stay'].'" data-min-stay="'.$price['min_stay'].'" data-room-name="'.$room['name'].'" data-room-id="'.$price['room_id'].'" data-base-price="'.$price['base_price'].'" data-single-price="'.$price['single_price'].'" data-double-price="'.$price['double_price'].'" data-triple-price="'.$price['triple_price'].'" data-extra-price="'.$price['extra_adult'].'" data-child-price=\''.$price['child_price'].'\' data-child='.$price['room_child'].' data-capacity='.$price['room_capacity'].' data-stoped-d='.$price['stoped_departure'].' data-stoped-a='.$price['stoped_arrival'].' data-day="'.$day.'">
                    '.$roomPrice.'
                    </td>';
                  }else{
                    echo '<td class="base_price" data-price-type="0" data-room-id="'.$price['room_id'].'" data-room-name="'.$room['name'].'" data-child='.$price['room_child'].' data-capacity='.$price['room_capacity'].'  data-day="'.$day.'">N/A</td>';
                  }
                  
                }?>
              </tr>

              <!-- promotions by room -->
              <?php  if (isset($data['promotions'][$k])) : ?>
                <?php foreach ($data['promotions'][$k] as $p) :?>
                <tr>
                <th colspan="2"><?php echo $p['promotion_name']; ?></th>
                  <?php foreach ($room['prices'] as $day => $price) {

                  $available = promotion_available($day,$p['id'],$price['room_id']);                  
                  if ($available) {
                    $stoped = (@$price['stoped_arrival'] == '1' or $available['stoped'] == '1') ? 'class="promotion tdRed"' : 'class="promotion tdGreen"';

                    //set discount price
                    if (@$price['price_type'] == '1') {
                      $roomPrice = $price['base_price'];
                    }else{
                      $roomPrice = @$price['double_price'];
                    }

                    $roomPrice = $roomPrice - (($roomPrice / 100) * $p['promotion_discount']);
                    
                    echo '<td '.$stoped.' data-room-name="'.$room['name'].'" data-room-id="'.$price['room_id'].'" data-promo-id="'.$p['id'].'" data-promo-name="'.$p['promotion_name'].'" data-available="'.$available['available'].'" data-stoped='.$available['stoped'].' data-day="'.$day.'">
                    '.$roomPrice.'
                    </td>';
                  }else{
                    echo '<td class="promotion" data-room-name="'.$room['name'].'" data-room-id="'.$price['room_id'].'" data-promo-id="'.$p['id'].'" data-promo-name="'.$p['promotion_name'].'"  data-day="'.$day.'">N/A</td>';
                  }
                  
                  
                }?>

                </tr>
                <?php endforeach; // promotion foreach end ?>
              <?php endif; // promotions end ?>
          <?php endforeach; //rooms foreach end ?>


        </tbody>

        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <?php foreach ($data['dates'] as $key => $date): 
            $day = date('D',strtotime($date)); ?>

            <th <?php echo ($day == 'Sat' or $day == 'Sun') ? 'style="background-color:#FFEDB6; font-size: 12px; text-align: center;"' : 'style="font-size: 12px; text-align: center;"'; ?>>
            <?php echo date('M',strtotime($date)); ?><br />
            <?php echo date('d',strtotime($date)); ?><br />
            <?php echo $day; ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </tfoot>
      </table>

    <?php endif; //date error ?>
</div>

<div id="modal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="save_by_room">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="roomname"></span></h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('from'); ?></label>
              <input required type="text" name="start_date" class="form-control input-sm from_date">
            </div>
          </div><!-- col-sm-6 -->
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('to'); ?></label>
              <input required type="text" name="end_date" class="form-control input-sm to_date">
            </div>
          </div><!-- col-sm-6 -->
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('stoped_a'); ?></label>
              <div class="ckbox ckbox-danger">
                <input type="checkbox" name="stoped_arrival" id="stoped_a" />
                <label for="stoped_a"></label>
              </div>
              </div>
          </div><!-- col-sm-6 -->

          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('stoped_d'); ?></label>
              <div class="ckbox ckbox-danger">
                <input type="checkbox" name="stoped_departure" id="stoped_d" />
                <label for="stoped_d"></label>
              </div>
              </div>
          </div><!-- col-sm-6 -->

          </div>
          </div>

          <div class="form-group">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('min_stay'); ?></label>
                <input type="text" name="min_stay" class="form-control input-sm" id="stay_min">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('max_stay'); ?></label>
                <input type="text" name="max_stay" class="form-control input-sm" id="stay_max">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('available'); ?></label>
                <input type="text" name="available" class="form-control input-sm" id="avail">
              </div>
            </div><!-- col-sm-6 -->

            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label"><?php echo lang('price_type'); ?></label>
                <select class="form-control" name="price_type" id="price_type_val">
                  <option value="1"><?php echo lang('unit'); ?></option>
                  <option value="2"><?php echo lang('person'); ?></option>
                </select>
              </div>
            </div><!-- col-sm-6 -->

          </div>

          </div>
          <div class="form-group">
          <div class="row">
          <div class="unit-price">
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('base'); ?></label>
                <input type="text" name="base_price" class="form-control input-sm" id="price_base">
              </div>
            </div><!-- col-sm-6 -->
            </div><!-- unit price end -->
            <div class="person-price">
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('single'); ?></label>
                <input type="text" name="single_price" class="form-control input-sm" id="price_single">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('double'); ?></label>
                <input type="text" name="double_price" class="form-control input-sm" id="price_double">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2 extra_prices1">
              <div class="form-group">
                <label class="control-label"><?php echo lang('triple'); ?></label>
                <input type="text" name="triple_price" class="form-control input-sm" id="price_triple">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2 extra_prices2">
              <div class="form-group">
                <label class="control-label"><?php echo lang('extra'); ?></label>
                <input type="text" name="extra_price" class="form-control input-sm" id="price_extra">
              </div>
            </div><!-- col-sm-6 -->
            </div> <!-- person prices end-->
            <!--
            <div class="col-sm-2 child_price">
              <div class="form-group">
                <label class="control-label"><?php echo lang('child'); ?></label>
                <input type="text" name="child_price" class="form-control input-sm" id="price_child">
              </div>
            </div>
            --><!-- col-sm-6 -->
          </div>
          <div id="child-prices"></div>
          </div>
          <div class="row">
            <div id="loading" class="alert" style="display:none">
              <img src="<?php echo site_url('assets/back/images/loaders'); ?>/loader6.gif" />
            </div>
            <div id="result" class="alert" style="display:none"></div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="room_id" id="roomid">
        <input type="hidden" name="changed" id="formchanged" value="0">
        <button type="button" class="btn btn-default" id="closeModal"><?php echo lang('close'); ?></button>
        <button id="savebutton" type="submit" class="btn btn-primary"><?php echo lang('save'); ?></button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- promotion modal -->
<div id="promo_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="save_by_promo">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('close'); ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="roomname"></span> > <span class="promotion_name"></span></h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('from'); ?></label>
              <input required type="text" name="start_date" class="form-control input-sm from_date">
            </div>
          </div><!-- col-sm-6 -->
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('to'); ?></label>
              <input required type="text" name="end_date" class="form-control input-sm to_date">
            </div>
          </div><!-- col-sm-6 -->
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('available'); ?></label>
                <input type="text" name="promo_available" class="form-control input-sm promo_available" />
                <label for="promo_available"></label>
              </div>
          </div><!-- col-sm-6 -->

          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label"><?php echo lang('stoped_a'); ?></label>
              <div class="ckbox ckbox-danger">
                <input type="checkbox" name="promo_stoped" id="promo_stoped" />
                <label for="promo_stoped"></label>
              </div>
              </div>
          </div><!-- col-sm-6 -->

          </div>
          </div>

          <div class="row">
            <div id="loading" class="alert" style="display:none">
              <img src="<?php echo site_url('assets/back/images/loaders'); ?>/loader6.gif" />
            </div>
            <div id="promo_result" class="alert" style="display:none"></div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="promotion_id" class="promo_id">
        <input type="hidden" name="promotion_room_id" class="promo_room_id">
        <input type="hidden" name="promo_changed" id="promoFromChanged" value="0">
        <button type="button" class="btn btn-default" id="closePromoModal"><?php echo lang('close'); ?></button>
        <button id="savebutton" type="submit" class="btn btn-primary"><?php echo lang('save'); ?></button>
      </div>
      </form>
    </div>
  </div>
</div>


<style type="text/css">
  #selectable .ui-selected { background: #F39814; color: white; }
</style>
<script type="text/javascript">
  var current_url = '<?php echo current_url(); ?>'; 
</script>
<script src="<?php echo site_url('assets/jtable'); ?>/jquery-ui.min.js"></script>
<script src="<?php echo site_url('assets/back/js'); ?>/table-scroll.min.js"></script>

<script type="text/javascript">

/*
$('.table').table_scroll({
    fixedColumnsLeft: 2,
    columnsInScrollableArea: <?php echo $rowlimit; ?>,
    rowsInScrollableArea :100
});
*/


jQuery(document).ready(function(){
  //datepicker
  jQuery('#start_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
});

var from_date ='';
//selectable td
$(function() {
  $("tbody>tr").bind("mousedown", function(e) {
      e.metaKey = true;
  }).selectable({
    filter:'td:not(.sg-v-scroll-cell)',
    tolerance :'touch',
    selected: function() {
       var days = [];
       $( ".ui-selected", this ).each(function() {
          var day     = $(this).data('day');
          days.push(day);
       });

       jQuery('.from_date').datepicker({ dateFormat: 'yy-mm-dd' });
       jQuery('.to_date').datepicker({ dateFormat: 'yy-mm-dd' });
       
       var start_date = days['0'];
       var end_date   = days[days.length-1];
       from_date = start_date;

       var available  = $('.ui-selected').data('available');
       var room_name  = $('.ui-selected').data('room-name');
       var room_id    = $('.ui-selected:first').data('room-id');

       //if cell is base price
       if ($('.ui-selected').hasClass('base_price')) {
       var min_stay   = $('.ui-selected').data('min-stay');
       var max_stay   = $('.ui-selected').data('max-stay');
       var stoped_a   = $('.ui-selected').data('stoped-a');
       var stoped_d   = $('.ui-selected').data('stoped-d');
       
       var price_type  = $('.ui-selected').data('price-type');
       var room_capacity  = $('.ui-selected').data('capacity');
       var child_capacity = $('.ui-selected').data('child');

       //prices
       var  base_price    = $('.ui-selected').data('base-price');
       var  single_price  = $('.ui-selected').data('single-price');
       var  double_price  = $('.ui-selected').data('double-price');
       var  triple_price  = $('.ui-selected').data('triple-price');
       var  extra_price   = $('.ui-selected').data('extra-price');
       var  child_price   = $('.ui-selected:first').data('child-price');


      //obj to array children prices from database
      function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
      }

      myObj= child_price;
      var child_prices =[];
      for( var i in myObj ) {
          if (myObj.hasOwnProperty(i)){
              if (isNumber(i)){
                  child_prices[i] = myObj[i];
              }else{
                child_prices.push(myObj[i]);
              }
          }
      }

      //
      if (child_capacity>0 && price_type!=0){
        //get room children options
        $.getJSON( base_url + "reservation_actions/room_children?id="+room_id).done(function(child_options){

       //create html
        html = '<div class="row child_price" style="margin-top:20px">';

        $.each(child_options,function(i,item){
            html += '<div class="col-sm-2">'+
              '<div class="form-group">'+
                '<label class="control-label">'+item.child_min+'-'+item.child_max+'</label>'+
                '<input type="hidden" name="child_price['+i+'][min]" value="'+item.child_min+'">'+
                '<input type="hidden" name="child_price['+i+'][max]" value="'+item.child_max+'">'+
                '<input type="text" name="child_price['+i+'][price]" value="'+child_prices[i].price+'" class="form-control input-sm">'+
              '</div>'+
            '</div><!-- col-sm-6 -->';
            //console.log(item.min);
          });
        html += '</div>';

        //insert html to form
        $('.child_price').remove();
        $('#child-prices').after(html);
        }); 
      }else{
        $('.child_price').hide();
        
      };

       if (child_capacity < 1) { $('.child_price').hide(); }else{ $('.child_price').show();};

       if (room_capacity < 3){ 
          $('.extra_prices1').hide(); $('.extra_prices2').hide(); 
        }else if(room_capacity == 3){
          $('.extra_prices1').show(); $('.extra_prices2').hide();
        }else if(room_capacity > 3){
          $('.extra_prices1').show(); $('.extra_prices2').show();
        }else{
        $('.extra_prices1').show(); $('.extra_prices2').show(); 
       }

       if (parseInt(stoped_a) > 0) { $('#stoped_a').prop('checked',true)}else{$('#stoped_a').prop('checked',false)};
       if (parseInt(stoped_d) > 0) { $('#stoped_d').prop('checked',true)}else{$('#stoped_d').prop('checked',false)};

       //fill the form
       $('.roomname').html(room_name);
       $('.from_date').val(start_date);
       $('.to_date').val(end_date);
       $('#stay_min').val(min_stay);
       $('#stay_max').val(max_stay);
       $('#avail').val(available);

       $('#price_base').val(base_price);
       $('#price_single').val(single_price);
       $('#price_double').val(double_price);
       $('#price_triple').val(triple_price);
       $('#price_extra').val(extra_price);
       $('#price_child').val(child_price);
       $('#roomid').val(room_id);
       $('#price_type_val').val(parseInt(price_type));
       //$('#price_type_val').filter('[value="'+price_type+'"]');


       $('#modal').modal();
      }//if base price modify modal end
      else if ($('.ui-selected').hasClass('promotion')){
       var stoped           = $('.ui-selected').data('stoped');
       var promotion_name   = $('.ui-selected').data('promo-name');
       var promotion_id     = $('.ui-selected').data('promo-id');
       //fill the form
       $('.roomname').html(room_name);
       $('.promotion_name').html(promotion_name);
       $('.promo_available').val(available);
       $('.promo_id').val(promotion_id);
       $('.promo_room_id').val(room_id);
       
       if (parseInt(stoped) > 0) { $('#promo_stoped').prop('checked',true)}else{$('#promo_stoped').prop('checked',false)};

       $('.from_date').val(start_date);
       $('.to_date').val(end_date);

       //show promotion modal
       $('#promo_modal').modal();
      }//if promotion price modify modal end
      else{
        $('td').removeClass('ui-selectee ui-selected');
      }

     }
  });

  //save form inside modal by room
  $("#save_by_room").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /*clear result div*/
    $("#result").html('');
    $('#loading').show();
    $('#savebutton').addClass('disabled');

    /* get some values from elements on the page: */
    var val = $(this).serialize();
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: base_url + "reservation_actions/price_grid_update_by_room",
        type: "POST",
        data: val,
        dataType: 'json',
        success: function(data){
          $('#loading').hide();
          $('#savebutton').removeClass('disabled');
          $('#result').html(data.message);
          $("#result").removeClass('alert-danger'); 
          $("#result").removeClass('alert-success'); 
          $("#result").addClass('alert-'+data.status);
          $("#result").fadeIn(1000);
          $('#formchanged').val('1');
          setTimeout(function(){ 
               $("#result").fadeOut(500); }, 2500);

        },
        error:function(){
          $('#loading').hide();
          $('#savebutton').removeClass('disabled');
          $('#result').html('Something went wrong!');
          $("#result").removeClass('alert-danger'); 
          $("#result").removeClass('alert-success');      
          $("#result").addClass('alert-danger');
          $("#result").fadeIn(1000);
          setTimeout(function(){ 
               $("#result").fadeOut(500); }, 3000); 
        }   
      }); 
  }); /* ajax end */

  //if form changed reload page else close modal
  $('#closeModal').on('click',function(){
    var changed = $('#formchanged').val();
    if (changed=='0') {
      $('#selectable .ui-selectee').removeClass('ui-selected');
      $('#modal').modal('hide');
    }else{
      $("#modal").modal('hide');
      setTimeout(function(){ 
        location.reload(); }, 200);
    };
  });

 //save form inside modal by room
  $("#save_by_promo").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /*clear result div*/
    $("#promo_result").html('');
    $('#loading').show();
    $('#savebutton').addClass('disabled');

    /* get some values from elements on the page: */
    var val = $(this).serialize();
    /* Send the data using post and put the results in a div */
    $.ajax({
        url: base_url + "reservation_actions/price_grid_update_promo",
        type: "POST",
        data: val,
        dataType: 'json',
        success: function(data){
          $('#loading').hide();
          $('#savebutton').removeClass('disabled');
          $('#promo_result').html(data.message);
          $("#promo_result").removeClass('alert-danger'); 
          $("#promo_result").removeClass('alert-success'); 
          $("#promo_result").addClass('alert-'+data.status);
          $("#promo_result").fadeIn(1000);
          $('#promoFromChanged').val('1');
          setTimeout(function(){ 
               $("#promo_result").fadeOut(500); }, 2500);

        },
        error:function(){
          $('#loading').hide();
          $('#savebutton').removeClass('disabled');
          $('#promo_result').html('Something went wrong!');
          $("#promo_result").removeClass('alert-danger'); 
          $("#promo_result").removeClass('alert-success');      
          $("#promo_result").addClass('alert-danger');
          $("#promo_result").fadeIn(1000);
          setTimeout(function(){ 
               $("#promo_result").fadeOut(500); }, 3000); 
        }   
      }); 
  }); /* ajax end */

  //if form changed reload page else close modal
  $('#closePromoModal').on('click',function(){
    var changed = $('#promoFromChanged').val();
    if (changed=='0') {
      $('#selectable .ui-selectee').removeClass('ui-selected');
      $('#promo_modal').modal('hide');
    }else{
      $("#promo_modal").modal('hide');
      setTimeout(function(){ 
        location.reload(); }, 200);
    };
  });

});


/*
//disable left panel to view table wide
$(function(){
  $('.leftpanelinner>ul>li').removeClass('nav-active');
  $('.leftpanelinner>ul>li>ul').removeAttr('style');
  $('body').addClass('leftpanel-collapsed');
});
*/
</script>
<?php $this->load->view('footer'); ?>

