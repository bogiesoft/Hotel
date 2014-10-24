<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-home"></i> <?php echo lang('dashboard'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="index.html"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('homepage'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <!-- content goes here... -->
    </div>

<?php $this->load->view('footer'); ?>