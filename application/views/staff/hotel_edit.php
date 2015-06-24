<?php $this->load->view('staff/header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> > <?php echo $hotel->name; ?></h2>
    </div>
    
    <div class="contentpanel">
    <?php if($this->session->flashdata('success')): ?>
      <div id="result" class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
      <div id="result" class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php echo $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

      <ul class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab"><strong>Otel Bilgileri</strong></a></li>
          <li class=""><a href="#reservations" data-toggle="tab"><strong>Rezervasyon</strong></a></li>
          
          <!--
          <li class=""><a href="#info" data-toggle="tab"><strong><?php echo lang('hotel_specs'); ?></strong></a></li>
          <li class=""><a href="#description" data-toggle="tab"><strong><?php echo lang('translations'); ?></strong></a></li>
          <li class=""><a href="#accounts" data-toggle="tab"><strong><?php echo lang('bank_accounts'); ?></strong></a></li>
          <li class=""><a href="#photos" data-toggle="tab"><strong><?php echo lang('hotel_photos'); ?></strong></a></li>
          <li class=""><a href="#logo" data-toggle="tab"><strong><?php echo lang('logo'); ?></strong></a></li>
          <li class=""><a href="#settings" data-toggle="tab"><strong><?php echo lang('settings'); ?></strong></a></li>
          -->
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('staff_actions/save_hotel'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">

            <div class="form-group">
                <label class="col-sm-3 control-label">Komisyon (%)</label>
                <div class="col-sm-6">
                  <input type="text" name="commision" value="<?php echo $hotel->commision; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Otel Adı</label>
                <div class="col-sm-6">
                  <input type="text" name="name" value="<?php echo $hotel->name; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Adress</label>
                <div class="col-sm-6">
                  <input type="text" name="adress" value="<?php echo $hotel->adress; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon</label>
                <div class="col-sm-6">
                <input type="text" name="phone" id="phone" value="<?php echo $hotel->phone; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon 2</label>
                <div class="col-sm-6">
                <input type="text" name="phone2" id="phone2" value="<?php echo $hotel->phone2; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Fax</label>
                <div class="col-sm-6">
                  <input type="text" name="fax" value="<?php echo $hotel->fax; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                  <input type="text" name="email" value="<?php echo $hotel->email; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Website</label>
                <div class="col-sm-6">
                  <input type="text" name="website" value="<?php echo $hotel->website; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Şehir</label>
                <div class="col-sm-6">
                  <input type="text" name="city" value="<?php echo $hotel->city; ?>" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Zip</label>
                <div class="col-sm-6">
                  <input type="text" name="postcode" value="<?php echo $hotel->postcode; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Hotel Yöneticisi</label>
                <div class="col-sm-6">
                  <input type="text" name="administrator" value="<?php echo $hotel->administrator; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Resepsiyon Tel</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_phone" value="<?php echo $hotel->reception_phone; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Resepsiyon Mail</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_email" value="<?php echo $hotel->reception_email; ?>" class="form-control input-sm">
                </div>
              </div>

            </div> <!-- general end -->
            
            <div class="tab-pane" id="reservations">

            <div class="col-md-12">
            <?php foreach ($reservations as $year => $reservation) : ?>
            <div class="table-responsive">
                <table class="table table-success mb30">
                    <thead>
                      <tr>
                        <th colspan="2"><?php echo $year; ?></th>
                        <th>Toplam Rezervasyon</th>
                        <th>Iptal</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($reservation as $month => $res) : ?>
                      <tr>
                        <td colspan="2"><?php echo $month; ?></td>
                        <td><?php echo isset($res['total_res']) ? $res['total_res'] : 0 ; ?></td>
                        <td><?php echo isset($res['canceled']) ? $res['canceled'] : 0 ; ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
          <?php endforeach; ?>
        </div>
            </div> <!-- reservations -->

           
          
            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="1" />
            <input type="hidden" name="hotel_id" value="<?php echo $this->uri->segment('3'); ?>" />

            <div class="row">
              <div class="col-sm-2">
              <input type="submit" class="btn btn-primary" value="Kaydet">
              </div>
                
             <div class="col-sm-6">
              <div id="result" class="alert" style="display:none"></div>
              </div>
            </div>

            </form>
            </div>
          </div>
      </div>
  </div><!-- row -->

</div><!-- contentpanel -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('jtable_close'); ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('upload_photos'); ?></h4>
      </div>
      <div class="modal-body">

          <div id="dropzone">
          <form id="photoDrop" action="<?php echo site_url('photos/hotel_photos'); ?>" class="dropzone" id="demo-upload">
            <div class="dropzone-previews"></div> 
            <div class="fallback"> <!-- this is the fallback if JS isn't working -->
            <input name="file" type="file" multiple />
            </div>

            <input type="hidden" name="hotel_id" value="<?php echo $this->uri->segment('4'); ?>" />
          </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal"><?php echo lang('save_photos'); ?></button>
      </div>
    </div>
  </div>
</div>


<link rel="stylesheet" href="<?php echo site_url('assets/back'); ?>/css/dropzone.css" />
<script src="<?php echo site_url('assets/back'); ?>/js/dropzone.min.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo site_url('assets/back'); ?>/js/jquery.maskedinput.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function(){
  // Chosen Select
  jQuery("#country").chosen({'width':'100%','white-space':'nowrap'});

  // Tooltip
  jQuery('.tooltips').tooltip({ container: 'body'});

  // Input Masks
  jQuery("#date").mask("99/99/9999");
  jQuery("#phone").mask("(999) 999-9999");
  jQuery("#phone2").mask("(999) 999-9999");
  jQuery("#ssn").mask("999-99-9999");

  
  //Replaces data-rel attribute to rel.
  //We use data-rel because of w3c validation issue
  jQuery('a[data-rel]').each(function() {
    jQuery(this).attr('rel', jQuery(this).data('rel'));
  });

});

</script>
<script src="<?php echo site_url('assets/back'); ?>/js/jupload.js"></script>
<script type="text/javascript">
  $(function() {
      $('#uploadedfile').change(function() {
          $(this).upload(base_url + 'reservation_actions/upload_hotel_logo', function(res) {
            var obj = jQuery.parseJSON( res );
            html = '<img src="'+obj.image+'" />';
            $('#logo_image').html(html);
            $('#logo_image_value').val(obj.image);
          }, 'html');
      });

      $('#uploadcover').change(function() {
          $(this).upload(base_url + 'reservation_actions/upload_hotel_cover_image', function(res) {
            var obj = jQuery.parseJSON( res );
            html = '<img src="'+obj.image+'" />';
            $('#cover_image').html(html);
            $('#cover_image_value').val(obj.image);
          }, 'html');
      });
  });

</script>
<?php $this->load->view('footer'); ?>