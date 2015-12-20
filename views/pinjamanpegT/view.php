
<h1>Lihat Peminjaman karyawan</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pinjamanpeg_id',
		'pengeluarankas_id',
		'karyawan_id',
		'komponengaji_id',
		'tglpinjampeg',
		'nopinjam',
		'untukkeperluan',
		'keterangan',
		'jumlahpinjaman',
		'lamapinjambln',
		'persenpinjaman',
		'sisapinjaman',
	),
)); ?>
