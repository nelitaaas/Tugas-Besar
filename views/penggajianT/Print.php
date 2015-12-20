
<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
}
echo $this->renderPartial('application.views.headerReport.headerDefault',array('judulLaporan'=>$judulLaporan));      
?>
<div class="mws-panel">
    <div class="mws-panel-body">
        <div class="mws-table">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'penggajian-t-grid',
	'dataProvider'=>$model->searchPrint(),
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
	),
)); ?>
              </div>  
         </div>
    </div>
