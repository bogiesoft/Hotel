<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('reservations'); ?></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('reservations'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">    
      <div class="row">
        <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-12 col-sm-3">
          <div class="row">
            <form class="form-inline">
                <div class="form-group">
                  <label class="sr-only" for="start_date"></label>
                  <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Name">
                </div>
                <div class="form-group">
                  <label class="sr-only" for="end_date"></label>
                  <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Surname">
                </div>
                <button type="submit" id="LoadRecordsButton" class="btn btn-primary">Send</button>
              </form>
          </div>
          </div>
        </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <div id="reservations"></div>
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
              gotoPageLabel: '<?php echo lang('jtable_gopage'); ?>',
              pageSizeChangeLabel: '<?php echo lang('jtable_rowcount'); ?>',
              cannotLoadOptionsFor: '<?php echo lang('jtable_page_cannot_load'); ?>',
              pagingInfo: '<?php echo lang('jtable_page_info'); ?>',
              canNotDeletedRecords: '<?php echo lang('jtable_cannot_delete'); ?>',
              deleteProggress: '<?php echo lang('jtable_cannot_deleting'); ?>'
          };

        $('#reservations').jtable({
            messages: messages, //Lozalize
            title  :'<?php echo lang('reservations'); ?>',
            paging: true, //Enable paging
            pageSize: 5, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'id DESC', //Set default sorting
            actions: {
                listAction: '<?php echo site_url("reservation_actions/list_reservations"); ?>'
            },
            fields: {
                id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: true,
                    width: '4%'
                },
                name_title: {
                    title: '',
                    sorting: false,
                    width: '4%'
                },
                first_name:{
                    title: '<?php echo lang('first_name'); ?>',
                    width: '10%'
                },
                last_name:{
                    title: '<?php echo lang('last_name'); ?>',
                    width: '12%'
                },
                checkin:{
                    title: '<?php echo lang('checkin'); ?>',
                    width: '12%'
                },
                checkout:{
                    title: '<?php echo lang('checkout'); ?>',
                    width: '12%'
                },
                detail:{
                  title: '',
                  width: '2%',
                  sorting: false,
                  display: function (data) {
                      return $('<a href="'+base_url+'reservation/reservations/edit/' + data.record.id + '"><img  style="opacity:0.4; width:16px; height:16px; margin-bottom:3px; padding:0;" src="<?php echo site_url("assets/jtable/themes/metro/edit.png"); ?>" /></a>');
                  }
                }
            }
        });
        
         //Re-load records when user click 'load records' button.
        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#reservations').jtable('load', {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val()
            });
        });
 
        //Load all records when page is first shown
        $('#LoadRecordsButton').click();
    });
 
</script>

<?php $this->load->view('footer'); ?>