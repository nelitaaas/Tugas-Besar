<?php 
if(isset($_POST["EXCEL"]))
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
} 
echo $this->renderPartial('application.views.headerReport.headerSurat',array('judulLaporan'=>$judulLaporan));  
?>

<div align="right">
    Bandung, <?php echo date('d'); ?> <?php echo date('M'); ?> <?php echo date('Y'); ?>
</div>
<div>
    <table>
        <tr>
            <td>Nomor Surat</td>
            <td>:</td>
            <td><?php echo $model->nosuratperingatan; ?></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?php echo $modSurel->jenissurat->jenissurat_judul; ?></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td> - </td>
        </tr>
    </table>
</div>
</br><br><br><br>
<div>
    <h4><b>Dengan Hormat,</b></h4>
    <p align="justify">
        Surat Peringatan ini ditujukan kepada: <br>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>Nama Direktur</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Direktur PT. Business Software Solution</td>
            </tr>
        </table><br>
        Surat Peringatan diterbitkan berdasarkan :<br>
        Bahwa <?php echo $model->karyawan->nama_karyawan; ?> telah melakukan kesalahan berupa :<br>
        <p align="justify">Indisiplin, terlambat masuk kerja selama lebih dari 5x dalam kurun waktu satu bulan.
        Sebagai seorang karyawan Sdr. <?php echo $model->karyawan->nama_karyawan; ?> seharusnya mampu menjaga tata tertib kerja dan bersedia untuk
        tiba dilokasi kerja pada waktu yang telah ditentukan sebagaimana yang telah tercantum dalam Surat Perjanjian Kerja (SPK).<br><br>
        Catatan :<br>
        PT. Business Software Solution hanya memberikan Surat Peringatan sekali. Dan jika Sdr. <?php echo $model->karyawan->nama_karyawan; ?>
            dikemudian hari didapati kembali melakukan kesalahan yang sama, maka PT. Graha Jasa Konstruksi akan memberhentikan Sdr. <?php echo $model->karyawan->nama_karyawan; ?> <br><br>
        
        Demikian Surat Peringatan ini dikeluarkan untuk dapat dijadikan sebagai bahan perhatian dan digunakan sebagaimana mestinya.

    </p>
</div><br><br><br><br><br>
<div>
    Bandung, <?php echo date('d'); ?> <?php echo date('M'); ?> <?php echo date('Y'); ?>
</div>
<div>
    PT. Business Software Solution
</div><br><br><br><br><br>
<div>
    Nama Direktur
</div>
<div>
    Direktur Utama
</div>