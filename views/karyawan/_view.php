<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('karyawan_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->karyawan_id), array('view', 'id'=>$data->karyawan_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kabupatenkota_id')); ?>:</b>
	<?php echo CHtml::encode($data->kabupatenkota_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('golongan_id')); ?>:</b>
	<?php echo CHtml::encode($data->golongan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lokasi_id')); ?>:</b>
	<?php echo CHtml::encode($data->lokasi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jabatan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jabatan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pelamar_id')); ?>:</b>
	<?php echo CHtml::encode($data->pelamar_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pendidikan_id')); ?>:</b>
	<?php echo CHtml::encode($data->pendidikan_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('subdepartement_id')); ?>:</b>
	<?php echo CHtml::encode($data->subdepartement_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departement_id')); ?>:</b>
	<?php echo CHtml::encode($data->departement_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jurusan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('propinsi_id')); ?>:</b>
	<?php echo CHtml::encode($data->propinsi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgllowongan')); ?>:</b>
	<?php echo CHtml::encode($data->tgllowongan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomorindukkaryawan')); ?>:</b>
	<?php echo CHtml::encode($data->nomorindukkaryawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('npwp')); ?>:</b>
	<?php echo CHtml::encode($data->npwp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jenisidentitas')); ?>:</b>
	<?php echo CHtml::encode($data->jenisidentitas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noidentitas')); ?>:</b>
	<?php echo CHtml::encode($data->noidentitas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gelardepan')); ?>:</b>
	<?php echo CHtml::encode($data->gelardepan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->nama_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_keluarga')); ?>:</b>
	<?php echo CHtml::encode($data->nama_keluarga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gelarbelakang')); ?>:</b>
	<?php echo CHtml::encode($data->gelarbelakang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tempatlahir_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->tempatlahir_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgllahir_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->tgllahir_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jeniskelamin')); ?>:</b>
	<?php echo CHtml::encode($data->jeniskelamin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusperkawinan')); ?>:</b>
	<?php echo CHtml::encode($data->statusperkawinan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jmlanak')); ?>:</b>
	<?php echo CHtml::encode($data->jmlanak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->alamat_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kodepos')); ?>:</b>
	<?php echo CHtml::encode($data->kodepos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agama')); ?>:</b>
	<?php echo CHtml::encode($data->agama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('golongandarah')); ?>:</b>
	<?php echo CHtml::encode($data->golongandarah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rhesus')); ?>:</b>
	<?php echo CHtml::encode($data->rhesus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamatemail')); ?>:</b>
	<?php echo CHtml::encode($data->alamatemail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomobile_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->nomobile_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notelp_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->notelp_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warganegara_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->warganegara_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategorikaryawan')); ?>:</b>
	<?php echo CHtml::encode($data->kategorikaryawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_jamsostek')); ?>:</b>
	<?php echo CHtml::encode($data->no_jamsostek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_karyawan')); ?>:</b>
	<?php echo CHtml::encode($data->photo_karyawan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('namabank')); ?>:</b>
	<?php echo CHtml::encode($data->namabank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('norekeningbank')); ?>:</b>
	<?php echo CHtml::encode($data->norekeningbank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tglkeluar')); ?>:</b>
	<?php echo CHtml::encode($data->tglkeluar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pphditanggungperusahaan')); ?>:</b>
	<?php echo CHtml::encode($data->pphditanggungperusahaan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_fingerprint')); ?>:</b>
	<?php echo CHtml::encode($data->no_fingerprint); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('karyawan_aktif')); ?>:</b>
	<?php echo CHtml::encode($data->karyawan_aktif); ?>
	<br />

	*/ ?>

</div>