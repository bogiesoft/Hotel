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
          <li class="active"><a href="#general" data-toggle="tab"><strong>Kullanıcı Bilgileri</strong></a></li>
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
                  <input type="text" name="user[name]" value="<?php echo $user->name; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Soyadı</label>
                <div class="col-sm-6">
                  <input type="text" name="user[surname]" value="<?php echo $user->surname; ?>" class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Email</label>
                <div class="col-sm-6">
                  <input type="text" name="user[email]" value="<?php echo $user->email; ?>"  class="form-control input-sm">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Kullanıcı Şifre</label>
                <div class="col-sm-6">
                  <input type="text" name="user[password]"  class="form-control input-sm">
                </div>
              </div>


            </div> <!-- general end -->
            
          
            </div> <!-- tab content end -->

            <input type="hidden" name="user_id" value="<?php echo $this->uri->segment('4'); ?>" />

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
<?php $this->load->view('footer'); ?>