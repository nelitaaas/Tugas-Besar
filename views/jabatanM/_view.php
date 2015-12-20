<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->jabatan_id), array('view', 'id'=>$data->jabatan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatan_nama')); ?>:</b>
	<?php echo CHtml::encode($data->jabatan_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatan_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->jabatan_aktif); ?>
	<br />

</div>