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
	'id'=>'komponengaji-m-grid',
	'dataProvider'=>$model->searchPrint(),
                'enablePagination'=>false,
                'enableSorting'=>false,
	'columns'=>array(
            array(
                'header'=>'Tgl. Diterima',
                'type'=>'raw',
                'value'=>'$data->tglditerima',
            ),
            array(
                'header'=>'Departement',
                'type'=>'raw',
                'value'=>'$data->departement->departement_nama',
            ),    
            array(
                'header'=>'Nomor Induk Karyawan',
                'type'=>'raw',
                'value'=>'$data->nomorindukkaryawan',
            ),      
            array(
                'header'=>'Nama Karyawan',
                'type'=>'raw',
                'value'=>'$data->nama_karyawan',
            ),
            array(
                'header'=>'Jenis Kelamin',
                'type'=>'raw',
                'value'=>'$data->jeniskelamin',
            ),   
            array(
                'header'=>'Alamat Karyawan',
                'type'=>'raw',
                'value'=>'$data->alamat_karyawan',
            ),
            array(
                'header'=>'Tempat Lahir',
                'type'=>'raw',
                'value'=>'$data->tempatlahir_karyawan',
            ),
            array(
                'header'=>'Tanggal Lahir',
                'type'=>'raw',
                'value'=>'$data->tgllahir_karyawan',
            ),                               
		
	),
)); ?>
</div>