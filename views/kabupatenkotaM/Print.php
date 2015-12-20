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
	'id'=>'kabupatenkota-m-grid',
	'dataProvider'=>$model->searchPrint(),
                'enablePagination'=>false,
                'enableSorting'=>false,
	'filter'=>$model,
	'columns'=>array(
            array(
                'header'=>'ID Kab / Kota',
                'name'=>'kabupatenkota_id',
                'value'=>'$data->kabupatenkota_id',
            ), 
            array(
                'header'=>'Propinsi',
                'name'=>'propinsi_id',
                'value'=>'$data->propinsi->propinsi_nama',
            ),
            array(
                'header'=>'Nama Kab / Kota',
                'name'=>'kabupatenkota_nama',
                'value'=>'$data->kabupatenkota_nama',
            ),
            array(
                    'header'=>'Aktif',
                    'value' => '($data->kabupatenkota_aktif = 1) ? "Aktif" : "Tidak Aktif"',
            ),
           
		
	),
)); ?>
              </div>