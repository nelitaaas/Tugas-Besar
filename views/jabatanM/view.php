
<h1>Lihat Jabatan </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'jabatan_id',
		'jabatan_nama',
		'jabatan_aktif',
	),
)); ?>
