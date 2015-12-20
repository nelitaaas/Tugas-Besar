
<h1>Lihat Master Gaji</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mastergaji_id',
		'lama_bln',
		'gajipokok',
		'kgalon',
		'kgelas',
		'kkarton',
	),
)); ?>
