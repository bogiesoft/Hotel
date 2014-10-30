<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('add_new_policy'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('add_new_policy'); ?></li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">
      <div class="row">

      <?php if ($this->session->flashdata('status_error')): ?>
        <div class="alert alert-danger">
        <?php echo $this->session->flashdata('status_error'); ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo site_url('reservation_actions/add_policy'); ?>">
      <?php $this->load->view('templates/policy_form_add'); ?>
      </form>
      
      </div><!-- row -->

    </div><!-- contentpanel -->
<script type="text/javascript">
jQuery(document).ready(function(){
  var max_fields      = 30; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 20; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          var html = '<div id="item"><div class="form-group"><label class="col-sm-3 control-label"><?php echo lang('language'); ?></label><div class="col-sm-2"><select name="policy[description]['+x+'][lang]" size="1" class="form-control input-sm"><?php foreach (languages() as $key => $value) { ?><option value="<?php echo $value["code"]; ?>"><?php echo $value["name"]; ?></option><?php } ?></select></div><div class="col-sm-4"><a class="btn btn-xs btn-danger remove_field" href="#"><?php echo lang('remove'); ?></a></div></div><div class="form-group"><label class="col-sm-3 control-label"><?php echo lang('description'); ?></label><div class="col-sm-6"><textarea name="policy[description]['+x+'][desc]"  class="form-control"></textarea></div></div><hr></div>';
          $(wrapper).append(html); //add input box
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('#item').remove(); x--;
  })
});
</script>
<?php $this->load->view('footer'); ?>