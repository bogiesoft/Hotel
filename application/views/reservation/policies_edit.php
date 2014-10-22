<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Policies > Add New</h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Add New Policy</li>
        </ol>
      </div>
    </div>
    <div class="contentpanel">

      <div class="row">

      <?php if ($this->session->flashdata('status_succes')): ?>
        <div class="alert alert-danger">
        <?php echo $this->session->flashdata('status_succes'); ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo site_url('reservation_actions/update_policy'); ?>">
      
      <?php $data['p'] = json_decode($policy->policy_details);?>
      <?php $this->load->view('templates/policy_form_edit',$data); ?>
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
          var html = '<div id="item"><div class="form-group"><label class="col-sm-3 control-label">Dil</label><div class="col-sm-2"><select name="policy[description]['+x+'][lang]" size="1" class="form-control input-sm"><?php foreach (languages() as $key => $value) { ?><option value="<?php echo $value["code"]; ?>"><?php echo $value["name"]; ?></option><?php } ?></select></div><div class="col-sm-4"><a class="btn btn-xs btn-danger remove_field" href="#">Remove</a></div></div><div class="form-group"><label class="col-sm-3 control-label">Açıklama</label><div class="col-sm-6"><textarea name="policy[description]['+x+'][desc]"  class="form-control"></textarea></div></div><hr></div>';
          $(wrapper).append(html); //add input box
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('#item').remove(); x--;
  })
});
</script>
<?php $this->load->view('footer'); ?>