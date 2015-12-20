<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->departement_id), array('view', 'id'=>$data->departement_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_nama')); ?>:</b>
	<?php echo CHtml::encode($data->departement_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->departement_aktif); ?>
	<br />


</div>