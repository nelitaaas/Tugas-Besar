
<h1>Lihat Penggajian Detail #<?php echo $model->penggajiandetail_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'penggajiandetail_id',
		'karykomponen_m',
		'penggajian_id',
		'jumlah',
	),
)); ?>
