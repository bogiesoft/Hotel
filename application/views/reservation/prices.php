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
      <table class="table mb30 table-condensed">
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
                <td colspan="2" class="tdRoomName"><?php echo $room['name']; ?></td>
                <?php foreach ($room['prices'] as $day => $price) {
                  //print_r($price); exit;
                  if ($price) {
                    $stoped = @$price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                    echo '<td '.$stoped.'>'.@$price->reserved.'/'.@$price->available.'</td>';
                  }else{
                    echo '<td>N/A</td>';
                  }
                  

                }?>
              </tr>
              <tr>
                <td></td>
                <td colspan="1">Best Available Rate</td>
                <?php foreach ($room['prices'] as $day => $price) {
                  if ($price) {
                    $stoped = @$price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                    echo '<td '.$stoped.'>'.@$price->base_price.'</td>';
                  }else{
                    echo '<td>N/A</td>';
                  }
                  
                }?>
              </tr>
          <?php endforeach; ?>


        </tbody>
      </table>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
  //datepicker
  jQuery('#start_date').datepicker({ dateFormat: 'yy-mm-dd' });
  jQuery('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
});

//disable left panel to view table wide
/*
$(function(){
  $('.leftpanelinner>ul>li').removeClass('nav-active');
  $('.leftpanelinner>ul>li>ul').removeAttr('style');
  $('body').addClass('leftpanel-collapsed');
});
*/
</script>
<?php $this->load->view('footer'); ?>

