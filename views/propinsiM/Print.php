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
	'id'=>'propinsi-m-grid',
	'dataProvider'=>$model->searchPrint(),
                'enablePagination'=>false,
                'enableSorting'=>false,
	'filter'=>$model,
	'columns'=>array(
		'propinsi_id',
		'propinsi_nama',
                 array(
                    'header'=>'Aktif',
                    'value' => '($data->propinsi_aktif = 1) ? "Aktif" : "Tidak Aktif"',
                ),
		
	),
)); ?>
              </div>