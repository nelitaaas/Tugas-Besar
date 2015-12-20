
<h1>Lihat Golongan #<?php echo $model->golongan_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'golongan_id',
            'golongan_nama',
            'golongan_aktif',
	),
)); ?>
