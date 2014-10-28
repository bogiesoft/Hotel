<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> <?php echo lang('hotels'); ?> </h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo lang('you_are_here'); ?></span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>"><?php echo lang('manage'); ?></a></li>
          <li class="active"><?php echo lang('hotels'); ?></li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
        <a href="<?php echo site_url('reservation/hotels/add_new'); ?>" class="btn btn-info pull-right"> <?php echo lang('add_new_button'); ?> </a>
      </div>
    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <div id="hotels"></div>
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
              serverCommunicationError: 'Sunucu ile iletişim kurulurken bir hata oluştu.',
              loadingMessage: 'Kayıtlar yükleniyor...',
              noDataAvailable: 'Hiç kayıt bulunmamaktadır!',
              addNewRecord: '+ Yeni kayıt ekle',
              editRecord: 'Kayıt düzenle',
              areYouSure: 'Emin misiniz?',
              deleteConfirmation: 'Bu kayıt silinecektir. Emin misiniz?',
              save: 'Kaydet',
              saving: 'Kaydediyor',
              cancel: 'İptal',
              deleteText: 'Sil',
              deleting: 'Siliyor',
              error: 'Hata',
              close: 'Kapat',
              gotoPageLabel: '<?php echo lang('jtable_gopage'); ?>',
              pageSizeChangeLabel: '<?php echo lang('jtable_rowcount'); ?>',
              cannotLoadOptionsFor: '<?php echo lang('jtable_page_cannot_load'); ?>',
              pagingInfo: '<?php echo lang('jtable_page_info'); ?>',
              canNotDeletedRecords: '<?php echo lang('jtable_cannot_delete'); ?>',
              deleteProggress: '<?php echo lang('jtable_cannot_deleting'); ?>'
          };

        $('#hotels').jtable({
            messages: messages, //Lozalize
            title: '<?php echo lang('hotels'); ?>',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: false, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '<?php echo site_url("reservation_actions/list_hotels"); ?>'
            },
            fields: {
                id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: true
                },
                name: {
                    title: '<?php echo lang('hotel_name'); ?>',
                    width: '23%'
                },
                detail:{
                  title: '',
                  sorting: false,
                  display: function (data) {
                      return $('<a href="'+base_url+'reservation/hotels/edit/' + data.record.id + '"><img  style="opacity:0.4; width:16px; height:16px; margin-bottom:3px; padding:0;" src="<?php echo site_url("assets/jtable/themes/metro/edit.png"); ?>" /></a>');
                  }
                }


            }
        });
        
        $('#hotels').jtable('load');
    });
 
</script>

<?php $this->load->view('footer'); ?>