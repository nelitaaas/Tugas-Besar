<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('propinsi_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->propinsi_id), array('view', 'id'=>$data->propinsi_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('propinsi_nama')); ?>:</b>
	<?php echo CHtml::encode($data->propinsi_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('propinsi_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->propinsi_aktif); ?>
	<br />

</div>