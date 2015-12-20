<h1>Daftar Status Berhenti </h1>

<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<p>
<div class="mws-panel">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-table-1">Tabel Status Berhenti</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-toolbar top clearfix">
            <ul>
                <li><a class="mws-ic-16 ic-add" href="index.php?r=kepegawaian/statusberhentiM/create">Tambah Status Berhenti</a></li>
            </ul>
        </div>
        <div class="mws-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'statusberhenti-m-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'header'=>'ID',
                    'name'=>'statusberhenti_id',
                    'type'=>'raw',
                    'value'=>'$data->statusberhenti_id',
                ),
		array(
                    'header'=>'Nama Status Berhenti',
                    'name'=>'statusberhenti_nama',
                    'value'=>'$data->statusberhenti_nama',
                ),
		array(
                        'header'=>'Aktif',
                        'class'=>'CCheckBoxColumn',     
                        'selectableRows'=>0,
                        'id'=>'rows',
                        'checked'=>'$data->statusberhenti_aktif',
                ),
		array(
                    'header'=>'Lihat',
                    'class'=>'CButtonColumn',                                  
                    'template'=>'{view}',  
                ),
               array(
                    'header'=>'Ubah',
                    'class'=>'CButtonColumn',                                  
                    'template'=>'{update}',  
                ),
		array(
                    'header'=>'Delete',
                    'class'=>'CButtonColumn',                                  
                    'template'=>'{delete}',  
                ),
	),
)); ?>
              </div>
        
                <div class="mws-button-row" align="right">
                    <?php 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} PDF',array('{icon}'=>'<i class="icon-book icon-white"></i>')),array('class'=>'mws-button blue', 'type'=>'button','onclick'=>'print(\'PDF\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Excel',array('{icon}'=>'<i class="icon-pdf icon-white"></i>')),array('class'=>'mws-button green', 'type'=>'button','onclick'=>'print(\'EXCEL\')'))."&nbsp&nbsp"; 
                    echo CHtml::htmlButton(Yii::t('mds','{icon} Print',array('{icon}'=>'<i class="icon-print icon-white"></i>')),array('class'=>'mws-button orange', 'type'=>'button','onclick'=>'print(\'PRINT\')'))."&nbsp&nbsp";
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
    window.open("${urlPrint}/"+$('#statusberhenti-m-grid').serialize()+"&caraPrint="+caraPrint,"",'location=_new, width=900px');
}
JSCRIPT;
Yii::app()->clientScript->registerScript('print',$js,CClientScript::POS_HEAD);                        
?>

<script type="text/javascript">
	$('#clickme').click(function() {
                    $('#ptjk').toggle('fast');
                });
</script>