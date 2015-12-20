<h1>Daftar Peminjaman Karyawan</h1>

<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<p>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Tabel Pinjaman Karyawan</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-toolbar top clearfix">
            <ul>
                <li><a class="mws-ic-16 ic-add" href="index.php?r=kepegawaian/pinjamanpegT/create">Transaksi Peminjaman Karyawan</a></li>
            </ul>
        </div>
        <div class="mws-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pinjamanpeg-t-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'pinjamanpeg_id',
		'pengeluarankas_id',
		   array(
                        'name'=>'karyawan_id',
                        'filter'=>  CHtml::listData($model->KaryawanItems, 'karyawan_id', 'nama_karyawan'),
                        'value'=>'isset($data->karyawan->nama_karyawan) ? $data->karyawan->nama_karyawan : ""',
                ),
		   array(
                        'name'=>'komponengaji_id',
                        'filter'=>  CHtml::listData($model->KomponenGajiItems, 'komponengaji_id', 'komponengaji_nama'),
                        'value'=>'isset($data->komponengaji->komponengaji_nama) ? $data->komponengaji->komponengaji_nama : ""',
                ),
		
		'tglpinjampeg',
		'nopinjam',
		
		'untukkeperluan',
		'jumlahpinjaman',
		'sisapinjaman',
            array(
                        'header' => 'Detail',
                        'type' => 'raw',
                        'value' => 'CHtml::link(\'<icon class="mws-ic-16 ic-application-side-boxes icon-mws16"></icon>\', Yii::app()->createUrl(\'kepegawaian/pinjamanpegT/details&id=\'.$data->pinjamanpeg_id), array(\'target\'=>\'dialogFrame\',\'onclick\'=>\'$("#dialogDetails").dialog("open");\'))',
                    ),
                    array(
                        'header' => 'Bayar',
                        'type' => 'raw',
                        'value' => '(!empty($data->sisapinjaman)) ? CHtml::link(\'<icon class="mws-ic-16 ic-application-side-boxes icon-mws16"></icon>\', Yii::app()->createUrl(\'kepegawaian/pinjamanpegT/bayar&id=\'.$data->pinjamanpeg_id), array(\'target\'=>\'dialogFrameBayar\',\'onclick\'=>\'$("#dialogBayar").dialog("open");\',\'title\'=>\'Bayar\')) : "Sudah Lunas"',
                    ),
	),
)); ?>
              </div>
        
                <div class="mws-button-row" align="right">
                    <?php 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
                    //echo CHtml::htmlButton(Yii::t('mds','{icon} Petunjuk',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button yellow', 'type'=>'button','id'=>'clickme'))."&nbsp&nbsp";
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
    //========= Dialog buat cari data Karyawan =========================
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(// the dialog
        'id' => 'dialogDetails',
        'options' => array(
            'title' => 'Detail Cicilan ',
            'autoOpen' => false,
            'modal' => true,
            'width' => '700',
            'height' => '350',
            'resizable' => false,
        ),
    ));
?>
<iframe name='dialogFrame' width="100%" height="100%"></iframe>

<?php $this->endWidget(); ?>

<?php
    //========= Dialog buat cari data Karyawan =========================
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(// the dialog
        'id' => 'dialogBayar',
        'options' => array(
            'title' => 'Detail Pembayaran Cicilan',
            'autoOpen' => false,
            'modal' => true,
            'width' => '750',
            'height' => '450',
            'resizable' => false,
        ),
    ));
?>
<iframe name='dialogFrameBayar' width="100%" height="100%"></iframe>

<?php $this->endWidget(); ?>
<?php
        $controller = Yii::app()->controller->id; //mengambil Controller yang sedang dipakai
        $module = Yii::app()->controller->module->id; //mengambil Module yang sedang dipakai
        $urlPrint=  Yii::app()->createAbsoluteUrl($module.'/'.$controller.'/print');

$js = <<< JSCRIPT
function print(caraPrint)
{
    window.open("${urlPrint}/"+$('#pinjamanpeg-t-grid').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>

<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>