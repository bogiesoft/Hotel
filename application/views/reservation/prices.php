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

            <th <?php echo ($day == 'Sat' or $day == 'Sun') ? 'style="background-color:#FFCC33"' : ''; ?>>
            <?php echo $day; ?><br />
            <?php echo date('m',strtotime($date)); ?>/
            <?php echo date('d',strtotime($date)); ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>

        <tbody>
        <?php //print_r($data); exit;?>
            <?php foreach ($data['rooms'] as $k => $room): ?>
              <tr>
                <th colspan="2" class="tdRoomName" data-name="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></th>
                <?php foreach ($room['prices'] as $day => $price) {
                  //print_r($price); exit;
                  if ($price) {
                    $stoped = @$price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                    echo '<th '.$stoped.'>'.@$price->reserved.'/'.@$price->available.'</th>';
                  }else{
                    echo '<th>N/A</th>';
                  }

                }?>
              </tr>
              <tr>
                <th colspan="2">Best Available Rate</th>
                <?php foreach ($room['prices'] as $day => $price) {
                  if ($price) {
                    $stoped = @$price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                    echo '<td '.$stoped.' data-id="'.@$price->room_id.'" data-day="'.$day.'">'.@$price->base_price.'</td>';
                  }else{
                    echo '<td>N/A</td>';
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
        ...
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
  var days = [];
  $("#selectable").bind("mousedown", function(e) {
      e.metaKey = true;
  }).selectable({
    filter:'td',
    selected: function() {
      
         $( ".ui-selected", this ).each(function() {
            var day     = $(this).data('day');
            days.push(day);
         });
         var room_id   = $('.ui-selected').data('id');
         var room_name = $('.ui-selected').closest('.tdRoomName').data('name');

         var start_date = days['0'];
         var end_date   = days[days.length-1];
         console.log(room_name),
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

