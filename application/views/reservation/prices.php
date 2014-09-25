<?php $this->load->view('header'); ?>
<div class="pageheader">
  <h2><i class="fa fa-table"></i> Rate Plans</h2>
  <div class="breadcrumb-wrapper">
    <span class="label">You are here:</span>
    <ol class="breadcrumb">
      <li><a href="index.html">Yönetim</a></li>
      <li class="active">Rate Plans</li>
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
              <label class="sr-only" for="start_date">Start Date</label>
              <input type="text" name="start_date" class="form-control" id="start_date" value="<?php echo $start_date; ?>">
            </div>
            <div class="form-group">
              <label class="sr-only" for="end_date">End Date</label>
              <input type="text" name="end_date" class="form-control" id="end_date" value="<?php echo $end_date; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Gönder</button>
          </form>
      </div>

      </div>
    </div>
    </div>

      <?php //print_r($prices); ?>
      <table class="table mb30 table-condensed" id="selectable">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <?php foreach ($data['dates'] as $key => $date): 
            $day = date('D',strtotime($date)); ?>

            <th <?php echo ($day == 'Sat' or $day == 'Sun') ? 'style="background-color:#FFEDB6"' : ''; ?>>
            <?php echo $day; ?><br />
            <?php echo date('m',strtotime($date)); ?>/
            <?php echo date('d',strtotime($date)); ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>

        <tbody>
            <?php foreach ($data['rooms'] as $k => $room): ?>
              <tr>
                <th colspan="2" class="tdRoomName" data-name="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></th>
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
              <tr>
                <th colspan="2">Best Available Rate</th>
                <?php foreach ($room['prices'] as $day => $price) {
                  if (@$price['base_price']) {
                    $stoped = $price['stoped_arrival'] == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                    echo '<td '.$stoped.' data-available="'.$price['available'].'" data-max-stay="'.$price['max_stay'].'" data-min-stay="'.$price['min_stay'].'" data-room-name="'.$room['name'].'" data-room-id="'.$price['room_id'].'" data-base-price="'.$price['base_price'].'" data-single-price="'.$price['single_price'].'" data-double-price="'.$price['double_price'].'" data-triple-price="'.$price['triple_price'].'" data-extra-price="'.$price['extra_adult'].'" data-child-price="'.$price['child_price'].'" data-child='.$price['room_child'].' data-capacity='.$price['room_capacity'].' data-stoped-d="'.$price['stoped_departure'].'" data-stoped-a="'.$price['stoped_arrival'].'" data-day="'.$day.'">'.@$price['base_price'].'</td>';
                  }else{
                    echo '<td data-available="'.$price['available'].'" data-max-stay="'.$price['max_stay'].'" data-min-stay="'.$price['min_stay'].'" data-room-id="'.$price['room_id'].'" data-room-name="'.$room['name'].'" data-base-price="'.$price['base_price'].'" data-single-price="'.$price['single_price'].'" data-double-price="'.$price['double_price'].'" data-triple-price="'.$price['triple_price'].'" data-extra-price="'.$price['extra_adult'].'" data-child-price="'.$price['child_price'].'" data-child='.$price['room_child'].' data-capacity='.$price['room_capacity'].' data-stoped-d="'.$price['stoped_departure'].'" data-stoped-a="'.$price['stoped_arrival'].'" data-day="'.$day.'">N/A</td>';
                  }
                  
                }?>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
</div>

<div id="modal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><div id="roomname"></div></h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
          <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label">From</label>
              <input required type="text" name="start_date" class="form-control input-sm" id="from_date">
            </div>
          </div><!-- col-sm-6 -->
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label">To</label>
              <input required type="text" name="end_date" class="form-control input-sm" id="to_date">
            </div>
          </div><!-- col-sm-6 -->
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label">Stoped Arrival</label>
              <div class="ckbox ckbox-danger">
                <input type="checkbox" name="stoped_arrival" id="stoped_a" />
                <label for="stoped_a"></label>
              </div>
              </div>
          </div><!-- col-sm-6 -->

          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label">Stoped Departure</label>
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
                <label class="control-label">Min. Stay</label>
                <input type="text" name="min_stay" class="form-control input-sm" id="stay_min">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label">Max. Stay</label>
                <input type="text" name="max_stay" class="form-control input-sm" id="stay_max">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label">Available</label>
                <input type="text" name="available" class="form-control input-sm" id="avail">
              </div>
            </div><!-- col-sm-6 -->
          </div>

          </div>
          <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label">Base</label>
                <input type="text" name="base_price" class="form-control input-sm" id="price_base">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label">SINGLE</label>
                <input type="text" name="single_price" class="form-control input-sm" id="price_single">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2">
              <div class="form-group">
                <label class="control-label">DOUBLE</label>
                <input type="text" name="double_price" class="form-control input-sm" id="price_double">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2 extra_prices1">
              <div class="form-group">
                <label class="control-label">TRIPLE</label>
                <input type="text" name="triple_price" class="form-control input-sm" id="price_triple">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2 extra_prices2">
              <div class="form-group">
                <label class="control-label">EXTRA</label>
                <input type="text" name="extra_price" class="form-control input-sm" id="price_extra">
              </div>
            </div><!-- col-sm-6 -->
            <div class="col-sm-2 child_price">
              <div class="form-group">
                <label class="control-label">CHILD</label>
                <input type="text" name="child_price" class="form-control input-sm" id="price_child">
              </div>
            </div><!-- col-sm-6 -->
          </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
  #selectable .ui-selected { background: #F39814; color: white; }
</style>
<script src="<?php echo site_url('assets/jtable'); ?>/jquery-ui.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
  //datepicker
  jQuery('#start_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
});


//selectable td
$(function() {
  $("#selectable").bind("mousedown", function(e) {
      e.metaKey = true;
  }).selectable({
    filter:'td',
    selected: function() {
       var days = [];
       $( ".ui-selected", this ).each(function() {
          var day     = $(this).data('day');
          days.push(day);
       });

       jQuery('#from_date').datepicker({ dateFormat: 'yy-mm-dd' });
       jQuery('#to_date').datepicker({ dateFormat: 'yy-mm-dd' });

       var room_id    = $('.ui-selected').data('room-id');
       var room_name  = $('.ui-selected').data('room-name');
       var min_stay   = $('.ui-selected').data('min-stay');
       var max_stay   = $('.ui-selected').data('max-stay');
       var available  = $('.ui-selected').data('available');
       var stoped_a     = $('.ui-selected').data('stoped-a');
       var stoped_d     = $('.ui-selected').data('stoped-d');

       var start_date = days['0'];
       var end_date   = days[days.length-1];

       var room_capacity  = $('.ui-selected').data('capacity');
       var child_capacity = $('.ui-selected').data('child');

       //prices
       var  base_price    = $('.ui-selected').data('base-price');
       var  single_price  = $('.ui-selected').data('single-price');
       var  double_price  = $('.ui-selected').data('double-price');
       var  triple_price  = $('.ui-selected').data('triple-price');
       var  extra_price   = $('.ui-selected').data('extra-price');
       var  child_price   = $('.ui-selected').data('child-price');
       
       //console.log(days);

       if (child_capacity < 1) { $('.child_price').hide(); }else{ $('.child_price').show();};
       if (room_capacity < 3){ 
          $('.extra_prices1').hide(); $('.extra_prices2').hide(); 
        }else{
          $('.extra_prices1').show(); $('.extra_prices2').show(); 
       };

       if (stoped_a == '1') { $('#stoped_a').prop('checked',true)}else{$('#stoped_a').prop('checkd',false)};
       if (stoped_d == '1') { $('#stoped_d').prop('checked',true)}else{$('#stoped_d').prop('checkd',false)};

       //fill the form
       $('#roomname').html(room_name);
       $('#from_date').val(start_date);
       $('#to_date').val(end_date);
       $('#stay_min').val(min_stay);
       $('#stay_max').val(max_stay);
       $('#avail').val(available);

       $('#price_base').val(base_price);
       $('#price_single').val(single_price);
       $('#price_double').val(double_price);
       $('#price_triple').val(triple_price);
       $('#price_extra').val(extra_price);
       $('#price_child').val(child_price);


       $('#modal').modal();
     }
  });


  $('#modal').on('hidden.bs.modal', function() {
    $('#selectable .ui-selectee').removeClass('ui-selected');
  });


});


//disable left panel to view table wide
$(function(){
  $('.leftpanelinner>ul>li').removeClass('nav-active');
  $('.leftpanelinner>ul>li>ul').removeAttr('style');
  $('body').addClass('leftpanel-collapsed');
});
</script>
<?php $this->load->view('footer'); ?>

