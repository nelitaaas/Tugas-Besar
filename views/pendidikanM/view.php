
<h1>Lihat Pendidikan </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'pendidikan_id',
            'pendidikan_nama',
            'pendidikan_urutan',
            'pendidikan_aktif',
	),
)); ?>
