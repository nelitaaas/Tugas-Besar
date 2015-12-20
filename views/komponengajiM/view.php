
<h1>Lihat Komponen Gaji</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'komponengaji_id',
		'komponengaji_kode',
		'komponengaji_nama',
		'komponengaji_singkt',
		'isgaji',
		'ispotongan',
		'nourut',
		'komponengaji_aktif',
	),
)); ?>
