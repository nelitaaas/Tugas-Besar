
<h1>Lihat Penggajian #<?php echo $model->penggajian_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'penggajian_id',
		'karyawan_id',
		'pengeluarankas_id',
		'tglpenggajian',
		'bulan',
		'tahun',
		'nopenggajian',
		'keterangan',
		'mengetahui',
		'menyetujui',
		'penerimaankotor',
		'jmlpotongan',
		'penerimaanbersih',
	),
)); ?>
