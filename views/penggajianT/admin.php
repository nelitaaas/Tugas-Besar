<h1>Daftar Penggajian</h1>

<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
        <?php Yii::app()->clientScript->registerScript('search', "
    $('form#cariSearch').submit(function(){
            $.fn.yiiGridView.update('penggajian-t-grid', {
                    data: $(this).serialize()
            });
            return false;
    });   
", CClientScript::POS_READY); ?>
</div><!-- search-form -->
<p>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Tabel Penggajian</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-toolbar top clearfix">
            <ul>
                <li><a class="mws-ic-16 ic-add" href="index.php?r=kepegawaian/penggajianT/create">Transaksi Penggajian</a></li>
            </ul>
        </div>
        <div class="mws-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'penggajian-t-grid',
	'dataProvider'=>$model->searchTabel(),
	'filter'=>$model,
	'columns'=>array(
                                array(
                                    'header'=>'Tgl Penggajian',
                                    'value'=>'$data->tglpenggajian',
                                ),
                                array(
                                    'header'=>'Bulan',
                                    'value'=>'$data->bulan',
                                ),
                                array(
                                    'header'=>'Tahun',
                                    'value'=>'$data->tahun',
                                ),
                                array(
                                    'header'=>'No Penggajian',
                                    'value'=>'$data->nopenggajian',
                                ),
                                array(
                                    'header'=>'Nama Karyawan',
                                    'value'=>'$data->karyawan->nama_karyawan',
                                ),
                                array(
                                    'header'=>'Mengetahui',
                                    'value'=>'$data->mengetahui',
                                ),
                                array(
                                    'header'=>'Menyetujui',
                                    'value'=>'$data->menyetujui',
                                ),
                                array(
                                    'header'=>'Pendapatan Bersih',
                                    'value'=>'$data->penerimaanbersih',
                                ),
                                array(
                                    'header'=>'Jumlah Potongan',
                                    'value'=>'$data->jmlpotongan',
                                ),
                                array(
                                    'header'=>'Penerimaan Kotor',
                                    'value'=>'$data->penerimaankotor',
                                ),
                                array(
                                    'header'=>'Bayarkan',
                                    'type'=>'raw',
//                                    'class'=>'CButtonColumn',
//                                    'template'=>'{bayar}',
//                                    'buttons'=>array(
//                                        'bayar'=>array(
//                                            'label'=>'<icon class="mws-ic-16 ic-coins"></icon>',
//                                            'url'=>''.Yii::app()->createUrl('kepegawaian/penggajianT/bayar&id=$data->penggajian_id'),
//                                            'htmlOptions'=>array(
//                                                'target'=>'dialogFrame',
//                                                'onclick'=>'$("#dialogPembayaran").dialog("open");'
//                                            ),
//                                            'visible'=>'$data->pengeluarankas_id < 1',
//                                        ),
//                                    ),
//                                    'value'=>'($data->pengeluarankas_id == "0") ? "aawaw" : "Sudah dibayarkan"',
                                    'value'=>'($data->pengeluarankas_id == 0) ? CHtml::link(\'<icon class="mws-ic-16 ic-coins"></icon>\', Yii::app()->createUrl(\'kepegawaian/penggajianT/bayar&id=\'.$data->penggajian_id), array(\'target\'=>\'dialogFrame\',\'onclick\'=>\'$("#dialogPembayaran").dialog("open");\')) : "Sudah dibayarkan"',
                                ),
                                array(
                                    'header'=>'Rincian',
                                    'class'=>'CButtonColumn',
                                    'template'=>'{view}',
                                ),
//		'penggajian_id',
//		'karyawan_id',
//		'pengeluarankas_id',
//		'tglpenggajian',
//		'bulan',
//		'tahun',
		/*
		'nopenggajian',
		'keterangan',
		'mengetahui',
		'menyetujui',
		'penerimaankotor',
		'jmlpotongan',
		'penerimaanbersih',
		*/
//		array(
//                                    'header'=>'Lihat',
//       		    'class'=>'CButtonColumn',                                  
//                                    'template'=>'{view}',  
//                                ),
//                               array(
//                                    'header'=>'Ubah',
//       		    'class'=>'CButtonColumn',                                  
//                                    'template'=>'{update}',  
//                                ),
//		array(
//                                    'header'=>'Delete',
//       		    'class'=>'CButtonColumn',                                  
//                                    'template'=>'{delete}',  
//                                ),
	),
)); ?>
              </div>
        
                <div class="mws-button-row" align="right">
                    <?php 
       echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
                  //echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
                    //echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
                   // echo CHtml::htmlButton(Yii::t('mds','{icon} Petunjuk',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button yellow', 'type'=>'button','id'=>'clickme'))."&nbsp&nbsp";
                    ?>
                </div><br>
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
    window.open("${urlPrint}/"+$('#cariSearch').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>

<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialogPembayaran',
    'options'=>array(
        'title'=>'Pengeluaran Kas',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>600,
        'height'=>600,
        'resizable'=>false,
    ),
));
?>
<iframe name='dialogFrame' width="100%" height="100%"></iframe>
<?php $this->endWidget(); ?>
<?php
Yii::app()->createUrl('kepegawaian/penggajianT/bayar&id=$data->penggajian_id', array('target'=>'dialogFrame','onclick'=>'$("#dialogPembayaran").dialog("open");'));
    ?>