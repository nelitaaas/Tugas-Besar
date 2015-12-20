<h1>Lihat Jenis Cuti </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'jeniscuti_id',
            'jeniscuti_nama',
            'jeniscuti_aktif',
	),
)); ?>
