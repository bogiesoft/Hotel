<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('price_plans'); ?> </h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('price_plans'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
        <a href="<?php echo site_url('reservation/price_plans/add_new'); ?>" class="btn btn-info pull-right"> <?php echo lang('add_new'); ?> </a>
      </div>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <div id="plans"></div>
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
              editRecord: '<?php echo lang('edit_promotion'); ?>',
              areYouSure: '<?php echo lang('are_you_sure'); ?>',
              deleteConfirmation: '<?php echo lang('delete_confirm'); ?>',
              save: '<?php echo lang('jtable_save'); ?>',
              saving: '<?php echo lang('jtable_saving'); ?>',
              cancel: '<?php echo lang('jtable_cancel'); ?>',
              deleteText: '<?php echo lang('jtable_delete'); ?>',
              deleting: '<?php echo lang('jtable_deleting'); ?>',
              error: '<?php echo lang('jtable_error'); ?>',
              close: '<?php echo lang('jtable_close'); ?>',
              gotoPageLabel: '<?php echo lang('jtable_gopage'); ?>',
              pageSizeChangeLabel: '<?php echo lang('jtable_rowcount'); ?>',
              cannotLoadOptionsFor: '<?php echo lang('jtable_page_cannot_load'); ?>',
              pagingInfo: '<?php echo lang('jtable_page_info'); ?>',
              canNotDeletedRecords: '<?php echo lang('jtable_cannot_delete'); ?>',
              deleteProggress: '<?php echo lang('jtable_cannot_deleting'); ?>'
          };

        $('#plans').jtable({
            messages: messages, //Lozalize
            title: '<?php echo lang('promotions'); ?>',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: false, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '<?php echo site_url("reservation_actions/list_price_plans"); ?>',
                deleteAction: '<?php echo site_url("reservation_actions/delete_price_plan"); ?>'
            },
            fields: {
                id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: true,
                    width : '5%'
                },
                promotion_name: {
                    title: '<?php echo lang('name'); ?>',
                    width: '23%'
                },

                type : {
                    title :'<?php echo lang('type'); ?>',
                    width : '12%',
                    display: function(data){
                      //return data.record.promotion_type;
                    
                        if (data.record.promotion_type == '1') {
                          return '<?php echo lang('basic_deal'); ?>';
                        }else if(data.record.promotion_type == '2'){
                          return '<?php echo lang('minimum_stay'); ?>';
                        }else if(data.record.promotion_type == '3'){
                          return '<?php echo lang('early_booker'); ?>';
                        }else if(data.record.promotion_type == 4){
                          return '<?php echo lang('last_minute'); ?>';
                        }else if(data.record.promotion_type == 5){
                          return '<?php echo lang('twentyfourhour'); ?>';
                        }
                        
                    }
                },
                promotion_discount : {
                    title : '<?php echo lang('discount'); ?>',
                },
                start_date : {
                    title : '<?php echo lang('start_date'); ?>',
                    width : '8%',
                },
                end_date : {
                    title : '<?php echo lang('end_date'); ?>',
                    width : '8%',
                },
                detail:{
                  title: '',
                  sorting: false,
                  width : '2%',
                  display: function (data) {
                      return $('<a href="'+base_url+'reservation/price_plans/edit/' + data.record.id + '"><img  style="opacity:0.4; width:16px; height:16px; margin-bottom:3px; padding:0;" src="<?php echo site_url("assets/jtable/themes/metro/edit.png"); ?>" /></a>');
                  }
                }


            }
        });
        
        $('#plans').jtable('load');
    });
 
</script>

<?php $this->load->view('footer'); ?>