
<h1>Lihat Jurusan</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'jurusan_id',
		'jurusan_nama',
		'jurusan_aktif',
	),
)); ?>
