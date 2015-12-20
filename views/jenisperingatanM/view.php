
<h1>Lihat Jenis Peringatan </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'jenisperingatan_id',
            'jenisperingatan_nama',
            'jenisperingatan_aktif',
	),
)); ?>
