<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdepartement_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->subdepartement_id), array('view', 'id'=>$data->subdepartement_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdepartement_nama')); ?>:</b>
	<?php echo CHtml::encode($data->subdepartement_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdepartement_akitf')); ?>:</b>
	<?php echo CHtml::encode($data->subdepartement_akitf); ?>
	<br />

</div>