
<h1>Lihat Presensi</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'presensi_id',
		'statusscan_id',
		'karyawan_id',
		'statuskehadiran_id',
		'tglpresensi',
		'no_fingerprint',
		'verifikasi',
		'keterangan',
		'create_time',
		'user_id',
	),
)); ?>
