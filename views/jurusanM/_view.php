<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->jurusan_id), array('view', 'id'=>$data->jurusan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan_nama')); ?>:</b>
	<?php echo CHtml::encode($data->jurusan_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->jurusan_aktif); ?>
	<br />

</div>