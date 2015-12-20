<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pinjamanpeg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pinjamanpeg_id), array('view', 'id'=>$data->pinjamanpeg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pengeluarankas_id')); ?>:</b>
	<?php echo CHtml::encode($data->pengeluarankas_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('karyawan_id')); ?>:</b>
	<?php echo CHtml::encode($data->karyawan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('komponengaji_id')); ?>:</b>
	<?php echo CHtml::encode($data->komponengaji_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tglpinjampeg')); ?>:</b>
	<?php echo CHtml::encode($data->tglpinjampeg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nopinjam')); ?>:</b>
	<?php echo CHtml::encode($data->nopinjam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('untukkeperluan')); ?>:</b>
	<?php echo CHtml::encode($data->untukkeperluan); ?>
	<br />
</div>