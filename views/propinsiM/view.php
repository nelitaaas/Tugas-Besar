
<h1>Lihat Propinsi</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'propinsi_id',
		'propinsi_nama',
		'propinsi_aktif',
	),
)); ?>
