<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('komponengaji_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->komponengaji_id), array('view', 'id'=>$data->komponengaji_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komponengaji_kode')); ?>:</b>
	<?php echo CHtml::encode($data->komponengaji_kode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komponengaji_nama')); ?>:</b>
	<?php echo CHtml::encode($data->komponengaji_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komponengaji_singkt')); ?>:</b>
	<?php echo CHtml::encode($data->komponengaji_singkt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isgaji')); ?>:</b>
	<?php echo CHtml::encode($data->isgaji); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ispotongan')); ?>:</b>
	<?php echo CHtml::encode($data->ispotongan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nourut')); ?>:</b>
	<?php echo CHtml::encode($data->nourut); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('komponengaji_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->komponengaji_aktif); ?>
	<br />

	*/ ?>

</div>