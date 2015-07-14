<?php $this->load->view('staff/header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Yeni Otel Ekle</h2>
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
      </ul>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
           
           <form id="save_hotel_details2" method="POST" action="<?php echo site_url('staff_actions/add_new_hotel'); ?>">
            <div class="tab-content mb30">
            
            <div class="tab-pane active" id="general">

            <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Adı</label>
                <div class="col-sm-6">
                  <input type="text" name="user[name]"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Soyadı</label>
                <div class="col-sm-6">
                  <input type="text" name="user[surname]"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Email</label>
                <div class="col-sm-6">
                  <input type="text" name="user[email]"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Şifre</label>
                <div class="col-sm-6">
                  <input type="text" name="user[password]"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Komisyon (%)</label>
                <div class="col-sm-6">
                  <input type="text" name="commision"  class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Otel Adı</label>
                <div class="col-sm-6">
                  <input type="text" name="name" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Adress</label>
                <div class="col-sm-6">
                  <input type="text" name="adress"  class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon</label>
                <div class="col-sm-6">
                <input type="text" name="phone" id="phone" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Telefon 2</label>
                <div class="col-sm-6">
                <input type="text" name="phone2" id="phone2" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Fax</label>
                <div class="col-sm-6">
                  <input type="text" name="fax" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                  <input type="text" name="email" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Website</label>
                <div class="col-sm-6">
                  <input type="text" name="website"  class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Şehir</label>
                <div class="col-sm-6">
                  <input type="text" name="city" class="form-control input-sm">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-3 control-label">Zip</label>
                <div class="col-sm-6">
                  <input type="text" name="postcode"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Hotel Yöneticisi</label>
                <div class="col-sm-6">
                  <input type="text" name="administrator"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Resepsiyon Tel</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_phone" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Resepsiyon Mail</label>
                <div class="col-sm-6">
                  <input type="text" name="reception_email" class="form-control input-sm">
                </div>
              </div>

            </div> <!-- general end -->
            

            </div> <!-- tab content end -->

            <input type="hidden" name="update" value="1" />

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