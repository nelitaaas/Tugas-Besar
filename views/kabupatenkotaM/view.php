
<h1>Lihat Kabupaten / Kota </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kabupatenkota_id',
		'propinsi_id',
		'kabupatenkota_nama',
		'kabupatenkota_aktif',
	),
)); ?>
