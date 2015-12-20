<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
} 
echo $this->renderPartial('application.views.headerReport.headerMaster',array('judulLaporan'=>$judulLaporan));  
?>
<div class="mws-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'komponengaji-m-grid',
	'dataProvider'=>$model->searchPrint(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'ID',
            'value'=>'$data->komponengaji_id',
        ),
        array(
            'header'=>'Komponen Gaji',
            'value'=>'$data->komponengaji_nama',
        ),
        array(
            'header'=>'Gaji',
            'type'=>'raw',
            'value'=>'(($data->isgaji == TRUE)? "Ya" : "Bukan")',
        ),
        array(
            'header'=>'Potongan',
            'type'=>'raw',
            'value'=>'(($data->ispotongan == TRUE)? "Ya" : "Bukan")',
        ),
	),
)); ?>
</div>