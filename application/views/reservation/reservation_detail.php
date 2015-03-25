<?php $this->load->view('header'); ?>
<link href="<?php echo site_url('assets/back'); ?>/css/fullcalendar.css" rel="stylesheet">
<script src="<?php echo site_url('assets/back'); ?>/js/fullcalendar.min.js"></script>

<!-- chart -->
<link href="<?php echo site_url('assets/back'); ?>/css/morris.css" rel="stylesheet">
<script src="<?php echo site_url('assets/back'); ?>/js/morris.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/raphael-2.1.0.min.js"></script>


    <div class="pageheader">
      <h2><i class="fa fa-credit-card"></i> <?php echo lang('reservations'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="index.html"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('reservations'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">

    <?php if (@$reservation->code != $this->session->userdata('code')) : ?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo lang('warning_wrong_reservation'); ?>
      </div>
    <?php else: ?>


      <!-- guest details start -->
      <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-default ">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="minimize">&minus;</a>
                </div><!-- panel-btns -->
                <h4 class="panel-title"><?php echo lang('guest_detail'); ?></h4>
              </div><!-- panel-heading -->
              <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                    <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th></th>
                          <th><?php echo lang('first_name'); ?></th>
                          <th><?php echo lang('last_name'); ?></th>
                          <th><?php echo lang('checkin'); ?></th>
                          <th><?php echo lang('checkout'); ?></th>
                          <th><?php echo lang('nights'); ?></th>
                          <th><?php echo lang('reservation_date'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><?php echo $reservation->name_title; ?></th>
                          <td><?php echo $reservation->first_name; ?></td>
                          <td><?php echo $reservation->last_name; ?></td>
                          <td><?php echo $reservation->checkin; ?></td>
                          <td><?php echo $reservation->checkout; ?></td>
                          <td><?php echo $reservation->nights; ?></td>
                          <td><?php echo $reservation->reservation_date; ?></td>
                        </tr>
                      </tbody>
                    </table>


                    <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th><?php echo lang('phone'); ?></th>
                          <th><?php echo lang('email'); ?></th>
                          <th><?php echo lang('street_1'); ?></th>
                          <th></th>
                          <th><?php echo lang('zipcode'); ?></th>
                          <th><?php echo lang('city'); ?></th>
                          <th><?php echo lang('country'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><?php echo $reservation->phone; ?></th>
                          <td><?php echo $reservation->email; ?></td>
                          <td><?php echo $reservation->street_1; ?></td>
                          <td><?php echo $reservation->street_2; ?></td>
                          <td><?php echo $reservation->zipcode; ?></td>
                          <td><?php echo $reservation->city; ?></td>
                          <td><?php echo $reservation->country_name; ?></td>
                        </tr>
                      </tbody>
                    </table>

                    </div>

                    <div class="col-md-6 col-sm-6">
                      
                    </div>

                  </div>

              </div>
            </div>
        </div>
      </div>
      <!-- guest details end -->

      <!--reservation details start -->
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default ">
            <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="minimize">&minus;</a>
                </div><!-- panel-btns -->
                <h4 class="panel-title"><?php echo lang('reservation_detail'); ?></h4>
              </div><!-- panel-heading -->
              <div class="panel-body">
              <div class="row">
                  <div class="well">
                  <?php echo $reservation->nights; ?> <?php echo lang('nights'); ?>
                  <?php echo $reservation->adults; ?> <?php echo lang('adults'); ?>
                  <?php echo $reservation->children; ?> <?php echo lang('children'); ?>
                  </div>
              </div>
              <?php $rooms = json_decode($reservation->rooms); ?>
               <table class="table table-condensed">
                <thead>
                  <tr>
                    <th><?php echo lang('room_name'); ?></th>
                    <th><?php echo lang('room_desc'); ?></th>
                    <th><?php echo lang('room_qty'); ?></th>
                    <th><?php echo lang('room_price'); ?></th>
                    <th><?php echo lang('room_total_price'); ?></th>
                    <th><?php echo lang('currency'); ?></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($rooms as $key => $room) : ?>
                  <tr>
                    <th scope="row"><?php echo $room->name; ?></th>
                    <?php if($room->promotion != '0') : ?>
                    <td><a href="<?php echo site_url('reservation/price_plans/edit/'.$room->promotion); ?>"><?php echo $room->desc; ?></a></td>
                    <?php else: ?>
                    <td><?php echo $room->desc; ?></td>
                    <?php endif;  ?>
                    <td><?php echo $room->qty; ?></td>
                    <td><?php echo $room->price; ?></td>
                    <td><?php echo show_price($room->qty*$room->price); ?></td>
                    <td><?php echo $reservation->currency; ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>

              <pre class="pull-right"><?php echo lang('total_room_price'); ?><?php echo $reservation->rooms_price; ?> <?php echo $reservation->currency; ?></pre>
            
              <?php $extras = json_decode($reservation->extras); ?>
              <?php if ($extras and count($extras)>0) : ?>
               
               <table class="table table-condensed">
                <thead>
                  <tr>
                    <th><?php echo lang('extra_name'); ?></th>
                    <th><?php echo lang('extra_price'); ?></th>
                    <th><?php echo lang('currency'); ?></th>
                    <th><?php echo lang('extra_details'); ?></th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($extras as $key => $extra) : ?>
                  <tr>
                    <th scope="row"><?php echo $extra->name; ?></th>
                    <td><?php echo $extra->price; ?></td>
                    <td><?php echo $reservation->currency; ?></td>
                    <td><?php echo lang('show'); ?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
              <pre class="pull-right"><?php echo lang('total_extra_price'); ?><?php echo $reservation->extras_price; ?> <?php echo $reservation->currency; ?></pre>
            
              <?php endif; //extras end ?>
              
              </div>
          </div>
      </div>
    </div>
  <!-- reservation details end -->

<?php endif; //reservation control end ?>
<?php $this->load->view('footer'); ?>