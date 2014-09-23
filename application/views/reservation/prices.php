<?php $this->load->view('header'); ?>
<div class="pageheader">
  <h2><i class="fa fa-home"></i> Rate Plans</h2>
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

            <?php foreach (date_range($start_date,$end_date) as $key => $date): ?>
            <th>
            <?php echo date('D',strtotime($date)); ?><br />
            <?php echo date('d',strtotime($date)); ?>/
            <?php echo date('m',strtotime($date)); ?>
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>


        <tbody>
        <?php //print_r($prices); exit;?>

            <?php foreach ($prices as $k => $room): ?>

              <tr>
                <td colspan="4"><?php echo $room['name']; ?></td>
                <td></td>
              </tr>
              <tr>
              <?php //if ($k==0) {echo '<td>BAR</td>'; }else{echo '<td></td>';} ?>
                <td width="100px">BAR</td>
                <?php foreach ($room['prices'] as $p => $price) {
                  $stoped = $price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                  echo '<td '.$stoped.'>'.$price->base_price.'</td>';
                }?>
              </tr>

              <!-- price plans -->
              <tr>
              <?php //if ($k==0) {echo '<td>BAR</td>'; }else{echo '<td></td>';} ?>
                <td width="100px">Plan 1</td>
                <?php foreach ($room['prices'] as $p => $price) {
                  $stoped = $price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                  echo '<td '.$stoped.'>'.$price->base_price.'</td>';
                }?>
              </tr>


              <tr>
              <?php //if ($k==0) {echo '<td>BAR</td>'; }else{echo '<td></td>';} ?>
                <td width="100px">Plan 2</td>
                <?php foreach ($room['prices'] as $p => $price) {
                  $stoped = $price->stoped == '1' ? 'class="tdRed"' : 'class="tdGreen"';
                  echo '<td '.$stoped.'>'.$price->base_price.'</td>';
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
$(function(){
  $('.leftpanelinner>ul>li').removeClass('nav-active');
  $('.leftpanelinner>ul>li>ul').removeAttr('style');
  $('body').addClass('leftpanel-collapsed');
});
</script>
<?php $this->load->view('footer'); ?>

