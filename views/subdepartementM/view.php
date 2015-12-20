
<h1>Lihat Sub Departement </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'subdepartement_id',
		'subdepartement_nama',
		'subdepartement_akitf',
	),
)); ?>
