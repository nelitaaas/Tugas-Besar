<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$judulLaporan.'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
} 
echo $this->renderPartial('application.views.headerReport.headerSurat',array('judulLaporan'=>$judulLaporan));  
?>
    <table style="width:100%;margin:0px;" class="mws-table">
        <tr>
            <td>
                <table style="width:100%;margin:0px;" class="mws-table">
                      <tr>
                             <td rowspan="7" align="center" width="20%"> 
                                 <img src="<?php echo Params::urlKaryawanThumbsDirectory().$model->photo_karyawan; ?>" width="250" height=200" >     

                            </td>
                      </tr>
                      <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('jenisidentitas'),$model->getAttributeLabel('jenisidentitas'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->jenisidentitas,  $model->jenisidentitas);?>                  
                               </td>
                               <td></td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('noidentitas'),$model->getAttributeLabel('noidentitas'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->noidentitas,  $model->noidentitas);?>                  
                               </td>
                               <td></td>

                        </tr>

                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('nama_karyawan'),$model->getAttributeLabel('nama_karyawan'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->gelardepan.' '.$model->nama_karyawan.' '.$model->nama_keluarga,  $model->gelardepan.' '.$model->nama_karyawan.' '.$model->nama_keluarga);?>                  
                               </td>
                               <td></td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('tempatlahir_karyawan'),$model->getAttributeLabel('tempatlahir_karyawan'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->tempatlahir_karyawan,  $model->tempatlahir_karyawan);?>                  
                               </td>
                               <td></td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('tgllahir_karyawan'),$model->getAttributeLabel('tgllahir_karyawan'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->tgllahir_karyawan,  $model->tgllahir_karyawan);?>                  
                               </td>
                               <td></td>

                        </tr>
<!--                        <tr>
                            <td width="20%"> -->
                                   <?php // echo CHtml::label($model->getAttributeLabel('karyawan_aktif'),$model->getAttributeLabel('karyawan_aktif'));?>
<!--                              </td>
                              <td width="30%" colspan="4">-->
                                    <?php // echo CHtml::label($model->karyawan_aktif,  $model->karyawan_aktif);?>               
<!--                               </td>-->
                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('jabatan_id'),$model->getAttributeLabel('jabatan_id'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->jabatan->jabatan_nama,  $model->jabatan->jabatan_nama);?>                  
                               </td>
                               <td></td>

                        </tr>

                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('jurusan_id'),$model->getAttributeLabel('jurusan_id'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->jurusan->jurusan_nama,  $model->jurusan->jurusan_nama);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('alamat_karyawan'),$model->getAttributeLabel('alamat_karyawan'));?>
                              </td>
                              <td width="30%" colspan="3">
                                    <?php echo CHtml::label($model->alamat_karyawan,  $model->alamat_karyawan);?>                  
                               </td>

                        </tr>
                        <tr>

                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('kodepos'),$model->getAttributeLabel('kodepos'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->kodepos,  $model->kodepos);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('propinsi_id'),$model->getAttributeLabel('propinsi_id'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->propinsi->propinsi_nama,  $model->propinsi->propinsi_nama);?>                  
                               </td>

                        </tr>

                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('kabupatenkota_id'),$model->getAttributeLabel('kabupatenkota_id'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->kabupatenkota->kabupatenkota_nama,  $model->kabupatenkota->kabupatenkota_nama);?>                  
                               </td>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('departement_id'),$model->getAttributeLabel('departement_id'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->departement->departement_nama,  $model->departement->departement_nama);?>                  
                               </td>
                        </tr>

                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('subdepartement_id'),$model->getAttributeLabel('subdepartement_id'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->subdepartement->subdepartement_nama,  $model->subdepartement->subdepartement_nama);?>                  
                               </td>
                                <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('agama'),$model->getAttributeLabel('agama'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->agama,  $model->agama);?>                  
                               </td>

                        </tr>

                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('pendidikan_id'),$model->getAttributeLabel('pendidikan_id'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->pendidikan->pendidikan_nama,  $model->pendidikan->pendidikan_nama);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('jeniskelamin'),$model->getAttributeLabel('jeniskelamin'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->jeniskelamin,  $model->jeniskelamin);?>                  
                               </td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('statusperkawinan'),$model->getAttributeLabel('statusperkawinan'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->statusperkawinan,  $model->statusperkawinan);?>                  
                               </td>
                               
                               <!--     =============== sini ====================           -->
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('pelamar_id'),$model->getAttributeLabel('pelamar_id'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->pelamar->nama_pelamar,  $model->pelamar->nama_pelamar);?>                  
                               </td>
                               
                               

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('lokasi_id'),$model->getAttributeLabel('lokasi_id'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->lokasi->lokasi_nama,  $model->lokasi->lokasi_nama);?>                  
                               </td>
                               
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('npwp'),$model->getAttributeLabel('npwp'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->npwp,  $model->npwp);?>                  
                               </td>
                        </tr>
                         <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('nomorindukkaryawan'),$model->getAttributeLabel('nomorindukkaryawan'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->nomorindukkaryawan,  $model->nomorindukkaryawan);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('golongandarah'),$model->getAttributeLabel('golongandarah'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->golongandarah,  $model->golongandarah);?>                  
                               </td>


                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('jmlanak'),$model->getAttributeLabel('jmlanak'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->jmlanak,  $model->jmlanak);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('nomobile_karyawan'),$model->getAttributeLabel('nomobile_karyawan'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->nomobile_karyawan,  $model->nomobile_karyawan);?>                  
                               </td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('rhesus'),$model->getAttributeLabel('rhesus'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->rhesus,  $model->rhesus);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('warganegara_karyawan'),$model->getAttributeLabel('warganegara_karyawan'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->warganegara_karyawan,  $model->warganegara_karyawan);?>                  
                               </td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('notelp_karyawan'),$model->getAttributeLabel('notelp_karyawan'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->notelp_karyawan,  $model->notelp_karyawan);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('no_jamsostek'),$model->getAttributeLabel('no_jamsostek'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->no_jamsostek,  $model->no_jamsostek);?>                  
                               </td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('kategorikaryawan'),$model->getAttributeLabel('kategorikaryawan'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->kategorikaryawan,  $model->kategorikaryawan);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('tglditerima'),$model->getAttributeLabel('tglditerima'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->tglditerima,  $model->tglditerima);?>                  
                               </td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('norekeningbank'),$model->getAttributeLabel('norekeningbank'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->norekeningbank,  $model->norekeningbank);?>                  
                               </td>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('no_fingerprint'),$model->getAttributeLabel('no_fingerprint'));?>
                              </td>
                              <td width="30%" colspan="2">
                                    <?php echo CHtml::label($model->no_fingerprint,  $model->no_fingerprint);?>                  
                               </td>

                        </tr>
                        <tr>
                              <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('tglkeluar'),$model->getAttributeLabel('tglkeluar'));?>
                              </td>
                              <td width="30%" >
                                    <?php echo CHtml::label($model->tglkeluar,  $model->tglkeluar);?>                  
                               </td>
                               <td>
                               </td>
                               <td>
                               </td>


                        </tr>
                        <tr>
                               <td width="20%"> 
                                   <?php echo CHtml::label($model->getAttributeLabel('pphditanggungperusahaan'),$model->getAttributeLabel('pphditanggungperusahaan'));?>
                              </td>
                              <td width="30%">
                                    <?php echo CHtml::label($model->pphditanggungperusahaan,  $model->pphditanggungperusahaan);?>                  
                               </td>
                               <td>
                               </td>
                               <td>
                               </td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div>Riwayat pendidikan</div>
                <?php $this->renderPartial('_tabelPendidikankaryawan',array()); ?>
            </td>
        </tr>
        <tr>
            <td>
                <div>Pengalaman kerja</div>
                <?php $this->renderPartial('_tabelPengalamankerja',array()); ?>
            </td>
        </tr>
        <tr>
            <td>
                <div>Mutasi</div>
                <?php $this->renderPartial('_tabelMutasi',array()); ?>
            </td>
        </tr>
        <tr>
            <td>
                <div>Cuti karyawan</div>
                <?php $this->renderPartial('_tabelCutikaryawan',array()); ?>
            </td>
        </tr>
        <tr>
            <td>
                <div>Komponen gaji</div>
                <?php $this->renderPartial('_tabelKomponengaji',array()); ?>
            </td>
        </tr>
    </table>
<?php echo $this->renderPartial('application.views.headerReport.footerDefault',array('mengetahui'=>$mengetahui,'menyetujui'=>$menyetujui)); ?>