<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabupatenkota_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kabupatenkota_id), array('view', 'id'=>$data->kabupatenkota_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('propinsi_id')); ?>:</b>
	<?php echo CHtml::encode($data->propinsi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabupatenkota_nama')); ?>:</b>
	<?php echo CHtml::encode($data->kabupatenkota_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabupatenkota_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->kabupatenkota_aktif); ?>
	<br />

</div>