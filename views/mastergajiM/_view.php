<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mastergaji_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mastergaji_id), array('view', 'id'=>$data->mastergaji_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lama_bln')); ?>:</b>
	<?php echo CHtml::encode($data->lama_bln); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gajipokok')); ?>:</b>
	<?php echo CHtml::encode($data->gajipokok); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kgalon')); ?>:</b>
	<?php echo CHtml::encode($data->kgalon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kgelas')); ?>:</b>
	<?php echo CHtml::encode($data->kgelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kkarton')); ?>:</b>
	<?php echo CHtml::encode($data->kkarton); ?>
	<br />


</div>