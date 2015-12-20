<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('presensi_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->presensi_id), array('view', 'id'=>$data->presensi_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusscan_id')); ?>:</b>
	<?php echo CHtml::encode($data->statusscan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('karyawan_id')); ?>:</b>
	<?php echo CHtml::encode($data->karyawan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statuskehadiran_id')); ?>:</b>
	<?php echo CHtml::encode($data->statuskehadiran_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tglpresensi')); ?>:</b>
	<?php echo CHtml::encode($data->tglpresensi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_fingerprint')); ?>:</b>
	<?php echo CHtml::encode($data->no_fingerprint); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('verifikasi')); ?>:</b>
	<?php echo CHtml::encode($data->verifikasi); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>