<?php 
if($caraPrint=='EXCEL')
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
            <td></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td></td>
        </tr>
    </table>
</div>
</br><br><br><br>
<div>
    <h4><b>Dengan Hormat,</b></h4>
    <p align="justify">
        &nbsp;Yang bertandatangan di bawah ini, :<br>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td></td>
            </tr>
        </table><br>
        &nbsp;Yang dengan ini bertindak atas nama PT. Business Software Solution. Memutuskan untuk melakukan mutasi terhadap karyawan PT. Business Software Solution di bawah ini:<br><br>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>No. Pegawai</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
        <br>
        &nbsp;Adapun jabatan serta lokasi kantor yang baru adalah sebagai berikut:
        <table>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Kantor</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
        <br>
        &nbsp;Proses mutasi ini mulai efektif pada 1 Agustus 2012. Oleh karena itu, 
        mohon kepada karyawan yang bersangkutan serta Field PT. Business Software Solution, Jakarta mempersiapkan segala sesuatunya sebelum tanggal tersebut.<br><br>
        
        &nbsp;Demikian surat mutasi ini dibuat untuk dapat dipergunakan sebagaimana mestinya
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
    Jabatan Direktur
</div>