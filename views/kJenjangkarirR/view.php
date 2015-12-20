
<h1>View KJenjangkarirR #<?php echo $model->jenjangkarir_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'jenjangkarir_id',
		'tgljenjangkarir',
		'karyawan_id',
		'nourutjenjangkarir',
		'departement_nama',
		'jabatanasal',
		'lokasiasal',
		'jabatanbaru',
		'lokasibaru',
		'fasilitasdiperoleh',
		'keterangan_karir',
	),
)); ?>
