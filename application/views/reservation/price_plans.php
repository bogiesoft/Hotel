<?php $this->load->view('header'); ?>
    <div class="pageheader">
      <h2><i class="fa fa-building-o"></i> Price Plans </h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard'); ?>">Yönetim</a></li>
          <li class="active">Price Plans</li>
        </ol>
      </div>
    </div>
    
    <div class="contentpanel">
      <div class="row">
        <a href="<?php echo site_url('reservation/price_plans/add_new'); ?>" class="btn btn-info pull-right"> Yeni Ekle </a>
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

          var turkishMessages = {
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
              gotoPageLabel: 'Sayfaya Git',
              pageSizeChangeLabel: 'Satır Sayısı',
              cannotLoadOptionsFor: '{0} alanı için seçenekler yüklenemedi!',
              pagingInfo: 'Toplam {2}, {0} ile {1} arası gösteriliyor',
              canNotDeletedRecords: '{1} kayıttan {0} adedi silinemedi!',
              deleteProggress: '{1} kayıttan {0} adedi silindi, devam ediliyor...'
          };

        $('#plans').jtable({
            messages: turkishMessages, //Lozalize
            title: 'Promotions',
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
                    title: 'Name',
                    width: '23%'
                },

                type : {
                    title :'Type',
                    display: function(data){
                      //return data.record.promotion_type;
                    
                        if (data.record.promotion_type == '1') {
                          return 'Basic Deal';
                        }else if(data.record.promotion_type == '2'){
                          return 'Minimum Stay';
                        }else if(data.record.promotion_type == '3'){
                          return 'Early Booker';
                        }else if(data.record.promotion_type == 4){
                          return 'Last Minute';
                        }else if(data.record.promotion_type == 5){
                          return '24 Hour Promotion';
                        }
                        
                    }
                },
                promotion_discount : {
                    title : 'Discount (%)',
                },
                start_date : {
                    title : 'Start Date',
                },
                end_date : {
                    title : 'End Date',
                },
                detail:{
                  title: '',
                  sorting: false,
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