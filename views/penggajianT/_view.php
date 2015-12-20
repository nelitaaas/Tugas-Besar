<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('penggajian_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->penggajian_id), array('view', 'id'=>$data->penggajian_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('karyawan_id')); ?>:</b>
	<?php echo CHtml::encode($data->karyawan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pengeluarankas_id')); ?>:</b>
	<?php echo CHtml::encode($data->pengeluarankas_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tglpenggajian')); ?>:</b>
	<?php echo CHtml::encode($data->tglpenggajian); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bulan')); ?>:</b>
	<?php echo CHtml::encode($data->bulan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun')); ?>:</b>
	<?php echo CHtml::encode($data->tahun); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nopenggajian')); ?>:</b>
	<?php echo CHtml::encode($data->nopenggajian); ?>
	<br />

</div>