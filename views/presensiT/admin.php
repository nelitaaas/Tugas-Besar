<h1>Manage Presensi</h1>

<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<p>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Tabel Presensi</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-toolbar top clearfix">
            <ul>
                <li><a class="mws-ic-16 ic-add" href="index.php?r=kepegawaian/presensiT/create">Tambah Presensi</a></li>
                <li><a class="mws-i-24"><?php echo CHtml::checkBox('atur', AturpresensiM::getStatusAutoRefresh(), array('style'=>'line-height:10px;','onchange'=>"setAuto();return false;")); ?><label>Auto</label></a></li>
            </ul>
        </div>
        <div class="mws-table">
            
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kpresensi-t-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
                array(
                'header'=>'NIP',
                'name'=>'no_fingerprint',
            ),
                //'karyawan.nomorindukkaryawan',
                'karyawan.nama_karyawan',
                //'statusscan.statusscan_nama',
                'tglpresensi',
                array(
                    'header'=>'Jam Presensi',
                    'type'=>'raw',
                    'value'=>'substr($data->tglpresensi,11,10)',
                ),
                array(
                        'name'=>'statuskehadiran_id',
                        'filter'=>  CHtml::listData($model->StatusItems, 'statuskehadiran_id', 'statuskehadiran_nama'),
                        'value'=>'$data->statuskehadiran->statuskehadiran_nama',
                ),
//		'statuskehadiran_id',
		//'verifikasi',
	),
)); ?>
              </div>
        
                <div class="mws-button-row" align="right">
                    <?php 
//                    echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
//                    echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
//                    echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
                    //echo CHtml::htmlButton(Yii::t('mds','{icon} Petunjuk',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button gray', 'type'=>'button','id'=>'clickme'))."&nbsp&nbsp";
                    ?>
                </div>
        <br/>
                 <div id ="ptjk" class="mws-form-message info" style="display: none;">
                    <p>
                    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
                    </p>
                </div>
         </div>
    </div>
<?php
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/print');

$js = <<< JSCRIPT
function print(caraPrint)
{
    window.open("${urlPrint}/"+$('#sakelompokmenu-k-grid').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>

<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>

<?php Yii::app()->clientScript->registerScript('search', "
    $('form#formCari').submit(function(){
            $.fn.yiiGridView.update('kpresensi-t-grid', {
                    data: $(this).serialize()
            });
            return false;
    });   
    
    setInterval(function() {
        beat();
    }, 3000);
", CClientScript::POS_READY); ?>

<?php Yii::app()->clientScript->registerScript('onheadfungsi','
    function updateTable(){
        $.fn.yiiGridView.update("kpresensi-t-grid", {
                    data: $("form#formCari").serialize()
            });
    }
    
    function setAuto(){
        if ($("#atur").is(":checked")){
            atur = $("#atur").val();
        }else{
            atur = 0;
        }
        $.post("'.Yii::app()->createUrl('actionAjax/turnAutoRefresh').'",{atur:atur},function(data){
        });
    }
    
    function beat(){
        $.post("'.Yii::app()->createUrl('kepegawaian/presensiT/ambilData').'",{},function(data){
            if (data == 1){
                updateTable();
            }
        });
    }
', CClientScript::POS_HEAD); ?>