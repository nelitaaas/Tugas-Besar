<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pendidikan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pendidikan_id), array('view', 'id'=>$data->pendidikan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pendidikan_nama')); ?>:</b>
	<?php echo CHtml::encode($data->pendidikan_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pendidikan_urutan')); ?>:</b>
	<?php echo CHtml::encode($data->pendidikan_urutan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pendidikan_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->pendidikan_aktif); ?>
	<br />

</div>