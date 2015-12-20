<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusberhenti_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->statusberhenti_id), array('view', 'id'=>$data->statusberhenti_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusberhenti_nama')); ?>:</b>
	<?php echo CHtml::encode($data->statusberhenti_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusberhenti_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->statusberhenti_aktif); ?>
	<br />

</div>