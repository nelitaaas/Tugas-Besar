<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenisperingatan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->jenisperingatan_id), array('view', 'id'=>$data->jenisperingatan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenisperingatan_nama')); ?>:</b>
	<?php echo CHtml::encode($data->jenisperingatan_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenisperingatan_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->jenisperingatan_aktif); ?>
	<br />

</div>