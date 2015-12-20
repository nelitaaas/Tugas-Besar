
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
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kpelamar-t-grid',
	'dataProvider'=>$model->searchPrint(),
//	'filter'=>$model,
	'columns'=>array(
                                 array(
                                     'header'=>'Tanggal Lowongan',
                                     'value'=>'$data->tgllowongan',
                                 ),
                                array(
                                    'header'=>'Departement',
                                    'value'=>'$data->departement->departement_nama',
                                ),
                                 array(
                                     'header'=>'Nama Pelamar',
                                     'value'=>'$data->nama_pelamar',
                                 ),
                                array(
                                    'header'=>'Jabatan',
                                    'value'=>'$data->jabatan->jabatan_nama',
                                ),
                                 array(
                                     'header'=>'Jenis Kelamin',
                                     'value'=>'$data->jeniskelamin',
                                 ),
                                 array(
                                     'header'=>'Alamat Pelamar',
                                     'value'=>'$data->alamat_pelamar',
                                 ),
                                 array(
                                     'header'=>'No. Identitas',
                                     'value'=>'$data->noidentitas',
                                 ),
                                 array(
                                     'header'=>'Tempat Lahir',
                                     'value'=>'$data->tempatlahir_pelamar',
                                 ),
                                array(
                                     'header'=>'Tanggal Lahir',
                                     'value'=>'$data->tgl_lahirpelamar',
                                 ),    
            ),
   ));
?>
            
            </div>