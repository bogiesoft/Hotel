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

          var turkishMessages = {
              serverCommunicationError: 'Sunucu ile iletişim kurulurken bir hata oluştu.',
              loadingMessage: 'Kayıtlar yükleniyor...',
              noDataAvailable: 'Hiç kayıt bulunmamaktadır!',
              addNewRecord: 'Sezon Ekle',
              editRecord: 'Sezon düzenle',
              areYouSure: 'Emin misiniz?',
              deleteConfirmation: 'Bu sezona ait tüm veriler silinecektir. Emin misiniz?',
              save: 'Kaydet',
              saving: 'Kaydediyor',
              cancel: 'İptal',
              deleteText: 'Sil',
              deleting: 'Siliyor',
              error: 'Hata',
              close: 'Kapat',
              gotoPageLabel: 'Sayfaya Git',
              pageSizeChangeLabel: 'Satır Sayısı',
              cannotLoadOptionsFor: '{0} alanı için seçenekler yüklenemedi!',
              pagingInfo: 'Toplam {2}, {0} ile {1} arası gösteriliyor',
              canNotDeletedRecords: '{1} kayıttan {0} adedi silinemedi!',
              deleteProggress: '{1} kayıttan {0} adedi silindi, devam ediliyor...'
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
            messages: turkishMessages, //Lozalize
            title  :'Seasons',
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
                    title : 'Name',
                    width: '23%'
                },
                start_date: {
                    title: 'Start Date',
                    width: '10%',
                    type : 'date'
                },
                end_date:{
                    title: 'End Date',
                    width: '10%',
                    type : 'date'
                },
                early_reservation_days :{
                  title: 'Early Reservation Days',
                    width: '18%'
                },
                cancel_days :{
                  title: 'Cancel days',
                    width: '10%'
                },
                min_stay :{
                  title: 'Min. Stay',
                    width: '10%'
                },
                max_stay :{
                  title: 'Max. Stay',
                    width: '10%'
                }

            }
        });
        
        $('#seasons').jtable('load');
    });
 
</script>

<?php $this->load->view('footer'); ?>