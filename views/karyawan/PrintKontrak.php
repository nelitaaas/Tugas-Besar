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
            <td><?php echo $model->nosuratkontrak; ?></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?php echo $modSurel->jenissurat->jenissurat_judul; ?></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td><?php echo $modSurel->jmlprint; ?></td>
        </tr>
    </table>
</div>
</br><br><br><br>
<div>
    <h4><b>Dengan Hormat,</b></h4>
    <p align="justify">
        Yang bertandatangan di bawah ini, :<br>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td> Nama Direktur</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Direktur Utama</td>
            </tr>
        </table><br>
        Dalam hal ini bertindak atas nama direksi ( --- nama perusahaan --- ) yang berkedudukan di ( --- alamat lengkap perusahaan --- ) dan selanjutnya disebut PIHAK PERTAMA.><br>
        <br><table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>......</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>.......</td>
            </tr>
             <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <td>.......</td>
            </tr>
             <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>.......</td>
            </tr>
             <tr>
                <td>Agama</td>
                <td>:</td>
                <td>.......</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>.........</td>
            </tr>
             <tr>
                <td>NO. Identitas</td>
                <td>:</td>
                <td>.......</td>
            </tr>
             <tr>
                <td>Telepon</td>
                <td>:</td>
                <td>.......</td>
            </tr>
        </table>
        <br>
        Dalam hal ini bertindak untuk dan atas nama diri pribadi dan selanjutnya disebut PIHAK KEDUA.
        <Br><br><br>
        
        Demikianlah perjanjian ini dibuat, disetujui, dan ditandatangani dalam rangkap dua, asli dan 
        tembusan bermaterei cukup dan berkekuatan hukum yang sama. Satu dipegang oleh PIHAK PERTAMA dan lainnya untuk PIHAK KEDUA.
    </p>
</div><br>
<div>
    <table>
        <tr>
            <td>Dibuat Di</td>
            <td>:</td>
            <td>Bandung</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <Td>:</td>
            <td><?php echo date('d'); ?> <?php echo date('M'); ?> <?php echo date('Y'); ?></td>
        </tr>
    </table>
</div>
<div align="center">
<p>PIHAK PERTAMA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PIHAK KEDUA</p>
</div><br><br>
<div align="center">
<p>(_ _ _ _ _ _ _ _ _ _)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(_ _ _ _ _ _ _ _ _ _)</p>
</div>