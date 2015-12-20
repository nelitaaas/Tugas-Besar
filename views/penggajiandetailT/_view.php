<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('penggajiandetail_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->penggajiandetail_id), array('view', 'id'=>$data->penggajiandetail_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('karykomponen_m')); ?>:</b>
	<?php echo CHtml::encode($data->karykomponen_m); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('penggajian_id')); ?>:</b>
	<?php echo CHtml::encode($data->penggajian_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>
	<br />


</div>