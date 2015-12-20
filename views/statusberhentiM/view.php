<h1>Lihat Status Berhenti </h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'statusberhenti_id',
            'statusberhenti_nama',
            'statusberhenti_aktif',
	),
)); ?>
