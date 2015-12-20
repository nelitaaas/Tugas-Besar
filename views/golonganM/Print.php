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
        'id'=>'golongan-m-grid',
        'dataProvider'=>$model->searchPrint(),
                'enablePagination'=>false,
                'enableSorting'=>false,
        'columns'=>array(
            'golongan_id',
            'golongan_nama',
            array(
                'header'=>'Aktif',
                'value' => '($data->golongan_aktif = 1) ? "Aktif" : "Tidak Aktif"',
            ),
           
        ),
    )); ?>
</div>