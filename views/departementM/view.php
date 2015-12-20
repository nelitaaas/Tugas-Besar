
<h1>Lihat Departement</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'departement_id',
            'departement_nama',
            'departement_aktif',
	),
)); ?>
