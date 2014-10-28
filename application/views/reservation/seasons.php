<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Seasons </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Seasons</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">    
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12 col-sm-3">            
            <div id="seasons"></div>
            </div>
          </div>
        </div>
      </div><!-- row -->

    </div><!-- contentpanel -->

<script src="<?php echo site_url('assets'); ?>/jtable/jquery.jtable.js"></script>
<link href="<?php echo site_url('assets'); ?>/jtable/themes/metro/jtable_metro_base.min.css" rel="stylesheet">
<link href="<?php echo site_url('assets'); ?>/jtable/themes/metro/blue/jtable.css" rel="stylesheet">
<link href="<?php echo site_url('assets'); ?>/jtable/themes/metro/blue/jquery-ui.css" rel="stylesheet">



<script type="text/javascript">
 
    $(document).ready(function () {
    //Localization texts

          var messages = {
              serverCommunicationError: '<?php echo lang('server_communication_error'); ?>',
              loadingMessage: '<?php echo lang('loading_message'); ?>',
              noDataAvailable: '<?php echo lang('no_data'); ?>',
              addNewRecord: '<?php echo lang('add_new'); ?>',
              editRecord: '<?php echo lang('edit_season'); ?>',
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

          var roomMessages = {
              serverCommunicationError: 'Sunucu ile iletişim kurulurken bir hata oluştu.',
              loadingMessage: 'Kayıtlar yükleniyor...',
              noDataAvailable: 'Hiç kayıt bulunmamaktadır!',
              addNewRecord: 'Oda Fiyatı Ekle',
              editRecord: 'Fiyatları düzenle',
              areYouSure: 'Emin misiniz?',
              deleteConfirmation: 'Bu odaya ait tüm sezon fiyatları silinecektir. Emin misiniz?',
              save: 'Kaydet',
              saving: 'Kaydediyor',
              cancel: 'İptal',
              deleteText: 'Sil',
              deleting: 'Siliyor',
              error: 'Hata',
              close: 'Kapat'
          };


        $('#seasons').jtable({
            messages: messages, //Lozalize
            title  :'<?php echo lang('seasons'); ?>',
            paging: false, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            sorting: false, //Enable sorting
            defaultSorting: 'name ASC', //Set default sorting
            //openChildAsAccordion: true,
            actions: {
                listAction: '<?php echo site_url("reservation_actions/seasons?action=list"); ?>',
                deleteAction : '<?php echo site_url("reservation_actions/seasons?action=delete"); ?>',
                updateAction : '<?php echo site_url("reservation_actions/seasons?action=update"); ?>',
                createAction: '<?php echo site_url("reservation_actions/seasons?action=create"); ?>'
            },
            fields: {
                id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false,
                    width: '4%'
                },
                /*rooms: {
                    title: '',
                    width: '5%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (seasonData) {
                        //Create an image that will be used to open child table
                        var $img = $('<i class="fa fa-list"></i>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#seasons').jtable('openChildTable',
                              $img.closest('tr'),
                              {
                                  title: seasonData.record.name + ' Room Prices',
                                  messages: roomMessages, //Lozalize
                                  actions: {
                                      listAction: '<?php echo site_url("reservation_actions/season_price?action=list&season_id="); ?>' + seasonData.record.id,
                                      createAction: '<?php echo site_url("reservation_actions/season_price?action=create&season_id="); ?>' + seasonData.record.id,
                                      updateAction: '<?php echo site_url("reservation_actions/season_price?action=update&season_id="); ?>' + seasonData.record.id,
                                      deleteAction: '<?php echo site_url("reservation_actions/season_price?action=delete&season_id="); ?>' + seasonData.record.id,
                                  },
                                  fields: {
                                      id: {
                                          key: true,
                                          create: false,
                                          edit: false,
                                          list: false,
                                          width: '4%'
                                      },
                                      season_id: {
                                          type :'hidden',
                                          defaultValue : seasonData.record.id
                                      },
                                      room_id :{
                                          title : 'Room Name',
                                          width: '23%',
                                          options : '<?php echo site_url("reservation_actions/hotel_rooms"); ?>'
                                      },
                                      base_price :{
                                          title : 'Base Price',
                                          width: '10%'
                                      },
                                      double_price :{
                                          title : 'Double Price',
                                          width: '12%'
                                      },
                                      triple_price :{
                                          title : 'Triple Price',
                                          width: '12%'
                                      },
                                      extra_adult :{
                                          title : 'Extra Adult',
                                          width: '12%'
                                      },
                                      child_price :{
                                          title : 'Child Price',
                                          width: '12%'
                                      },
                                      extra_child :{
                                          title : 'Extra Child',
                                          width: '12%'
                                      },

                                  }
                              }, function (data) { //opened handler
                                  data.childTable.jtable('load');
                            });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
                },*/
                name:{
                    title : '<?php echo lang('name'); ?>',
                    width: '23%'
                },
                start_date: {
                    title: '<?php echo lang('start_date'); ?>',
                    width: '10%',
                    type : 'date'
                },
                end_date:{
                    title: '<?php echo lang('end_date'); ?>',
                    width: '10%',
                    type : 'date'
                },
                early_reservation_days :{
                  title: '<?php echo lang('early_reservation'); ?>',
                    width: '18%'
                },
                cancel_days :{
                  title: '<?php echo lang('cancel_days'); ?>',
                    width: '10%'
                },
                min_stay :{
                  title: '<?php echo lang('min_stay'); ?>',
                    width: '10%'
                },
                max_stay :{
                  title: '<?php echo lang('max_stay'); ?>',
                    width: '10%'
                }

            }
        });
        
        $('#seasons').jtable('load');
    });
 
</script>

<?php $this->load->view('footer'); ?>