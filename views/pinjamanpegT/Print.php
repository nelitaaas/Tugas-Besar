
<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
}
echo $this->renderPartial('application.views.headerReport.headerDefault',array('judulLaporan'=>$judulLaporan));      
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pinjamanpeg-t-grid',
	'dataProvider'=>$model->searchPrint(),
	'columns'=>array(
		'pinjamanpeg_id',
		'pengeluarankas_id',
		   array(
                                    'name'=>'karyawan_id',
                                    'value'=>'$data->karyawan->nama_karyawan',
                                ),
		   array(
                                    'name'=>'komponengaji_id',
                                    'value'=>'$data->komponengaji->komponengaji_nama',
                                ),
		
		'tglpinjampeg',
		'nopinjam',
		
		'untukkeperluan',
		//'keterangan',
		'jumlahpinjaman',
		//'lamapinjambln',
		//'persenpinjaman',
		'sisapinjaman',
		
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
            )
)); ?>