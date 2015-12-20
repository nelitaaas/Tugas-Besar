<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
} 
echo $this->renderPartial('application.views.headerReport.headerDefault',array('judulLaporan'=>$judulLaporan));  
?>
<div class="mws-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'statusberhenti-m-grid',
	'dataProvider'=>$model->searchPrint(),
                'enablePagination'=>false,
                'enableSorting'=>false,
	'filter'=>$model,
	'columns'=>array(
		'statusberhenti_id',
		'statusberhenti_nama',
		array(
                    'header'=>'Aktif',
                    'value' => '($data->statusberhenti_aktif = 1) ? "Aktif" : "Tidak Aktif"',
                ),
	),
)); ?>
              </div>