<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('extras'); ?> </h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('extras'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
        <a href="<?php echo site_url('reservation/extras/add_new'); ?>" class="btn btn-info pull-right"> <?php echo lang('add_new'); ?> </a>
      </div>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <div id="extras"></div>
            </div>
          </div>
        </div>
      </div><!-- row -->

    </div><!-- contentpanel -->

<script src="<?php echo site_url('assets'); ?>/jtable/jquery.jtable.min.js"></script>
<link href="<?php echo site_url('assets'); ?>/jtable/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url('assets'); ?>/jtable/themes/metro/blue/jtable.css" rel="stylesheet">


<script type="text/javascript">
 
    $(document).ready(function () {
    //Localization texts

          var messages = {
              serverCommunicationError: '<?php echo lang('server_communication_error'); ?>',
              loadingMessage: '<?php echo lang('loading_message'); ?>',
              noDataAvailable: '<?php echo lang('no_data'); ?>',
              addNewRecord: '<?php echo lang('add_room'); ?>',
              editRecord: '<?php echo lang('edit_room'); ?>',
              areYouSure: '<?php echo lang('are_you_sure'); ?>',
              deleteConfirmation: '<?php echo lang('delete_confirm'); ?>',
              save: '<?php echo lang('jtable_save'); ?>',
              saving: '<?php echo lang('jtable_saving'); ?>',
              cancel: '<?php echo lang('jtable_cancel'); ?>',
              deleteText: '<?php echo lang('jtable_delete'); ?>',
              deleting: '<?php echo lang('jtable_deleting'); ?>',
              error: '<?php echo lang('jtable_error'); ?>',
              close: '<?php echo lang('jtable_close'); ?>',
              gotoPageLabel: 'Sayfaya Git',
              pageSizeChangeLabel: 'Satır Sayısı',
              cannotLoadOptionsFor: '{0} alanı için seçenekler yüklenemedi!',
              pagingInfo: 'Toplam {2}, {0} ile {1} arası gösteriliyor',
              canNotDeletedRecords: '{1} kayıttan {0} adedi silinemedi!',
              deleteProggress: '{1} kayıttan {0} adedi silindi, devam ediliyor...'
          };

        $('#extras').jtable({
            messages: messages, //Lozalize
            
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: false, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '<?php echo site_url("reservation_actions/list_extras"); ?>',
                deleteAction : '<?php echo site_url("reservation_actions/delete_extras"); ?>'
            },
            fields: {
                id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: true,
                    width: '4%'
                },
                name: {
                    title: '<?php echo lang('name'); ?>',
                    width: '23%'
                },
                price:{
                    title: '<?php echo lang('price'); ?>',
                    width: '10%'
                },
                per:{
                    title: '<?php echo lang('per'); ?>',
                    width: '12%',
                    display: function (data) {
                      if(data.record.id =='1'){
                        return $('<font color="black">Person</font>');
                      }else if(data.record.id =='2'){
                        return $('<font color="black">Unit</font>');
                      }else if(data.record.id =='3'){
                        return $('<font color="black">Day</font>');
                      }else if(data.record.id =='3'){
                        return $('<font color="black">Child</font>');
                      }
                      
                  }
                },
                status:{
                    title: '<?php echo lang('status'); ?>',
                    width: '12%',
                    display: function (data) {
                      if(data.record.status ==0){
                        return $('<font color="red">Passive</font>');
                      }else{
                        return $('<font color="green">Active</font>');
                      }
                      
                  }
                },
                detail:{
                  title: '',
                  width: '2%',
                  sorting: false,
                  display: function (data) {
                      return $('<a href="'+base_url+'reservation/extras/edit/' + data.record.id + '"><img  style="opacity:0.4; width:16px; height:16px; margin-bottom:3px; padding:0;" src="<?php echo site_url("assets/jtable/themes/metro/edit.png"); ?>" /></a>');
                  }
                }


            }
        });
        
        $('#extras').jtable('load');
    });
 
</script>

<?php $this->load->view('footer'); ?>