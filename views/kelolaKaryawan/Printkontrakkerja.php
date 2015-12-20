<style>
    .mws-form-row
    {
        width:300px;
        margin-top:6px;
        margin-bottom:6px;
        text-decoration:underline;
    }
</style>
<?php 
if($caraPrint=='EXCEL')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'."Surat".'-'.date("Y/m/d").'.xls"');
    header('Cache-Control: max-age=0');     
} 
echo $this->renderPartial('application.views.headerReport.headerSurat',array('judulLaporan'=>$judulLaporan));  
?>
        <div class="mws-form">    
                <div class="mws-form-inline"> 
                    <table>
                        <tr>
                            <td>
                            
                            <div class="mws-form-row">
                                    <?php echo 'Jenis surat :'; ?>
                                    <div style="float:right;">
                                        <?php
                                            $jenissurat_id = $_GET['KJenissuratM']['jenissurat_id'];
                                            $modJenissurat = JenissuratM::model()->findByPK($jenissurat_id);
                                            echo $modJenissurat->jenissurat_nama;
                                        ?>
                                    </div>
                            </div>
                            
                            <div class="mws-form-row">
                                    <?php echo 'Perihal :'; ?>     
                                    <div style="float:right;">                                      
                                        <?php echo $_GET['KJenissuratM']['jenissurat_judul'] ?>
                                    </div>
                            </div>
                                
                            <div class="mws-form-row">
                                    <?php echo 'Jabatan :'; ?>      
                                    <div style="float:right;">   
                                        <?php
                                            $jabatan_id = $_GET['KKontrakkaryawanR']['jabatan_id'];
                                            $modJabatan = JabatanM::model()->findByPK($jabatan_id);
                                            echo $modJabatan->jabatan_nama;
                                        ?>
                                    </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo 'Sub Departement :' ?>   
                                    <div style="float:right;">                
                                        <?php
                                            $subdepartement_id = $_GET['KKontrakkaryawanR']['subdepartement_id'];
                                            $modSubdepartement = SubdepartementM::model()->findByPK($subdepartement_id);
                                            echo $modSubdepartement->subdepartement_nama;
                                        ?>
                                  </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo 'Departement :'?>   
                                    <div style="float:right;">                                
                                        <?php
                                            $departement_id = $_GET['KKontrakkaryawanR']['departement_id'];
                                            $modDepartement = DepartementM::model()->findByPK($departement_id);
                                            echo $modDepartement->departement_nama;
                                        ?>
                                  </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo 'No Surat Kontrak : '; ?>   
                                    <div style="float:right;">                                                
                                    <?php echo $_GET['KKontrakkaryawanR']['nosuratkontrak']; ?>
                                      </div>
                            </div>
                               
                                
                            <div class="mws-form-row">
                                    <?php echo 'Tgl. Kontrak :'?>   
                                    <div style="float:right;">                                              
                                    <?php
                                        echo $_GET['KKontrakkaryawanR']['tglkontrak'];
                                    ?>
                                      </div>
                            </div> 
                               
                            <div class="mws-form-row">
                                    <?php echo 'Tgl. Mulai kontrak :'; ?>
                                    <div style="float:right;">                                              
                                    <?php echo $_GET['KKontrakkaryawanR']['tglmulaikontrak']; ?>
                                      </div>
                            </div>
                             </td><td>
                            <div class="mws-form-row">
                                    <?php echo 'Tgl. Akhir Kontrak :'; ?>
                                    <div style="float:right;">                                                 
                                    <?php echo $_GET['KKontrakkaryawanR']['tglakhirkontrak']; ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo 'Lama Kontrak :'; ?>
                                    <div style="float:right;">                                                   
                                    <?php
                                        echo $_GET['KKontrakkaryawanR']['lamakontrak'].' Tahun';
                                    ?>
                                      </div>
                            </div> 
                            <div class="mws-form-row">
                                    <?php echo 'Keterangan Kontrak :'; ?>
                                    <div style="float:right;">            
                                    <?php echo $_GET['KKontrakkaryawanR']['keterangankontrak']; ?>
                                      </div>
                            </div>
                            <div class="mws-form-row">
                                    <?php echo 'Mengetahui :'; ?>
                                    <div style="float:right;">
                                    <?php echo $_GET['mengetahui']; ?>
                                    </div>
                            </div>                                                       
                         </td>
                   </tr>
               </table>
            </div>
        </div>
<?php echo $this->renderPartial('application.views.headerReport.footerDefault',array('mengetahui'=>$_GET['mengetahui']));  ?>