<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenjangkarir_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->jenjangkarir_id), array('view', 'id'=>$data->jenjangkarir_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgljenjangkarir')); ?>:</b>
	<?php echo CHtml::encode($data->tgljenjangkarir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('karyawan_id')); ?>:</b>
	<?php echo CHtml::encode($data->karyawan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nourutjenjangkarir')); ?>:</b>
	<?php echo CHtml::encode($data->nourutjenjangkarir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_nama')); ?>:</b>
	<?php echo CHtml::encode($data->departement_nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatanasal')); ?>:</b>
	<?php echo CHtml::encode($data->jabatanasal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lokasiasal')); ?>:</b>
	<?php echo CHtml::encode($data->lokasiasal); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatanbaru')); ?>:</b>
	<?php echo CHtml::encode($data->jabatanbaru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lokasibaru')); ?>:</b>
	<?php echo CHtml::encode($data->lokasibaru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fasilitasdiperoleh')); ?>:</b>
	<?php echo CHtml::encode($data->fasilitasdiperoleh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan_karir')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan_karir); ?>
	<br />

	*/ ?>

</div>