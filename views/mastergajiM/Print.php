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
	'id'=>'mastergaji-m-grid',
	'dataProvider'=>$model->searchPrint(),
	'columns'=>array(
                array(
                  'header'=>'ID',
                  'value'=>'$data->mastergaji_id',
                ),
                 array(
                  'header'=>'Lama Bulan',
                  'value'=>'$data->lama_bln',
                ),
		 array(
                  'header'=>'Gaji Pokok',
                  'value'=>'$data->gajipokok',
                ),
		 array(
                  'header'=>'Komisi Galon',
                  'value'=>'$data->kgalon',
                ),
		 array(
                  'header'=>'Komisi Gelas',
                  'value'=>'$data->kgelas',
                ),
		 array(
                  'header'=>'Komisi Karton',
                  'value'=>'$data->kkarton',
                ),
		
	),
)); ?>
</div>
        