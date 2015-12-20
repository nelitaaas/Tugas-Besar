<?php

class FormTabController extends Controller
{
        public $layout='//layouts/column2';
        public $accordionIndx = Params::ACCORDION_PEGAWAI;
        
	public function actionPendidikanKaryawan($id)
	{
            $this->layout = '//layouts/column2';
            $this->setUserMenu();
            $indexTab = 0;            
            $pendidikan = KPendidikanM::model()->findByAttributes(array('karyawan_id'=>$id));
            
            $this->render('_formPendidikan',array('id'=>$id,
                                           'indexTab'=>$indexTab,
                                           'pendidikan'=>$pendidikan));
	}

	public function actionPengalamanKerja($id)
	{
            $this->layout = '//layouts/column2';
            $this->setUserMenu();
            $indexTab = 1;
            $pengalaman = KPengalamankerjaR::model()->findByAttributes(array('karyawan_id'=>$id));
            
            $this->render('_formPengalamanKerja',array('id'=>$id,
                                              'indexTab'=>$indexTab,
                                              'pengalaman'=>$pengalaman));
	}

	public function actionMutasi($id)
	{
            $this->layout = '//layouts/column2';
            $this->setUserMenu();
            $indexTab = 2;
            $pendaftaran = KMutasiR::model()->findByAttributes(array('karyawan_id'=>$id));
            
            $this->render('_formMutasi',array('nopend'=>$nopend,
                                               'indexTab'=>$indexTab,
                                               'mutasi'=>$mutasi));
	}

	public function actionCutiKaryawan($id)
	{
            $this->layout = '//layouts/column2';
            $this->setUserMenu();
            $indexTab = 3;
            $cutikaryawan = KCutikaryawanR::model()->findByAttributes(array('karyawan_id'=>$id));
            
            $this->render('_formCutiKaryawan',array('id'=>$id,
                                            'indexTab'=>$indexTab,
                                            'cutikaryawan'=>$cutikaryawan));
	}

	public function actionKontrakKerja($id)
	{
            $this->layout = '//layouts/column2';
            $this->setUserMenu();
            $indexTab = 4;
            $kontrakkerja = KKontrakkaryawanR::model()->findByAttributes(array('karyawan_id'=>$id));
            
            $this->render('_formKontrakKerja',array('id'=>$id,
                                           'indexTab'=>$indexTab,
                                           'kontrakkerja'=>$kontrakkerja));
	}


	public function actionTerapi($nopend)
	{
            $this->layout = '//layouts/column2';
            $this->setUserMenu();
            $indexTab = 6;
            $pendaftaran = DaftarpasienV::model()->findByAttributes(array('no_pendaftaran'=>$nopend));
            $no_resep = $this->generateNoResep(); // mengambil no resep
            
            $this->render('terapi',array('nopend'=>$nopend,
                                         'indexTab'=>$indexTab,
                                         'pendaftaran'=>$pendaftaran,
                                         'no_resep'=>$no_resep));
	}

        public function actionAjaxPendidikanKaryawan($id)
        {
            $this->layout = '//layouts/polos';
            $idpegawai = Yii::app()->session['karyawan_id'];
            
            $anamnesa = AnamnesaT::model()->findByAttributes(array('no_pendaftaran'=>$nopend,'ruangan_id'=>$idruang));
            if(empty($anamnesa))
                $anamnesa = new AnamnesaT;
            
            if(isset($_POST['simpan_anamnesa'])){
                $_POST['AnamnesaT']['logpemakai_id'] = Yii::app()->session['log_pemakai_id']; 
                
                $anamnesa->attributes = $_POST['AnamnesaT'];
                $anamnesa->no_pendaftaran = $nopend;
                //$anamnesa->ruangan_id = $idruang;
                //$anamnesa->pegawai_id = $idpegawai;
                
                CActiveForm::validate(array($anamnesa));            
                if ($anamnesa->validate()){
                   if($anamnesa->save()){
                        PendaftaranT::model()->updateByPk($nopend,array('statusperiksa_id'=>'2'));
                        Yii::app()->user->setFlash('success',"Data Anamnesa berhasil disimpan");
                   }else{
                        Yii::app()->user->setFlash('error',"Data Anamnesa gagal disimpan");
                   }
                }
                
//                $url = Yii::app()->createUrl('rawatJalan/formTab/anamnesa', array('nopend'=>$nopend));
//                $this->redirect($url);
                header("Location: ".$_REQUEST['link']." ");

            }
            
            $pendaftaran = PendaftaranT::model()->findByPk($nopend);
            
            //$anamnesas = AnamnesaT::model()->findAllByAttributes(array('ruangan_id'=>$idruang,'pegawai_id'=>$idpegawai),array('order'=>'tglperiksaanamnesa DESC'));
            $anamnesas = AnamnesaV::model()->findAllByAttributes(array('ruangan_id'=>$idruang,'no_rekam_medik'=>$pendaftaran->no_rekam_medik),array('order'=>'tglperiksaanamnesa DESC'));
            
            $this->render('_formAnamnesa',array('anamnesa'=>$anamnesa,
                                                'pendaftaran'=>$pendaftaran,
                                                'anamnesas'=>$anamnesas));
        }
        
        public function actionAjaxLihatAnamnesa()
        {
            $id = $_POST['anamesa_id'];
            $anamnesa = AnamnesaT::model()->findByPk($id);
            $pendaftaran = DaftarpasienV::model()->findByAttributes(array('no_pendaftaran'=>$anamnesa->no_pendaftaran));
            $render = $this->renderPartial('_viewAnamnesa',array('anamnesa'=>$anamnesa,'pendaftaran',$pendaftaran),true);
            
            $data['render'] = $render;

            echo json_encode($data);
            Yii::app()->end();
        }
        
        public function actionAjaxPemeriksaan($nopend)
        {
            $this->layout = '//layouts/polos';
            $idruang = Yii::app()->session['pemakai_ruangan_id'];
            $idpegawai = Yii::app()->session['pegawai_id'];
            
            $pemeriksaanFisik = PemeriksaanfisikT::model()->findByAttributes(array('no_pendaftaran'=>$nopend,'ruangan_id'=>$idruang));
            if(empty($pemeriksaanFisik))
                $pemeriksaanFisik = new PemeriksaanfisikT;
            
            if(isset($_POST['simpan_pemeriksaan'])){
                $_POST['PemeriksaanfisikT']['logpemakai_id'] = Yii::app()->session['log_pemakai_id'];

                if(isset ($_POST['PemeriksaanfisikT']['beratbadan'])){
                    $_POST['PemeriksaanfisikT']['beratbadan'] .= 'kg';
                }
                if(isset ($_POST['PemeriksaanfisikT']['suhutubuh'])){
                    $_POST['PemeriksaanfisikT']['suhutubuh'] .= 'celcius';
                }
                if(isset ($_POST['PemeriksaanfisikT']['tinggibadan'])){
                    $_POST['PemeriksaanfisikT']['tinggibadan'] .= 'cm';
                }
                
                $pemeriksaanFisik->attributes = $_POST['PemeriksaanfisikT'];
                $pemeriksaanFisik->no_pendaftaran = $nopend;
                $pemeriksaanFisik->tglperiksafisik = date('Y-m-d');
                $pemeriksaanFisik->ruangan_id = $idruang;
                $pemeriksaanFisik->pegawai_id = $idpegawai;

                if($pemeriksaanFisik->save()){
                        PendaftaranT::model()->updateByPk($nopend,array('statusperiksa_id'=>'2'));
                        Yii::app()->user->setFlash('success',"Data Pemeriksaan Fisik berhasil disimpan");
                }else{
                        Yii::app()->user->setFlash('error',"Data Pemeriksaan Fisik gagal disimpan");
                }
                
//                $url = Yii::app()->createUrl('rawatJalan/formTab/pemeriksaan', array('nopend'=>$nopend));
//                $this->redirect($url);
                   header("Location: ".$_REQUEST['link']."");
            }
            
            $pendaftaran = PendaftaranT::model()->findByPk($nopend);
            //$periksas = PemeriksaanfisikT::model()->findAllByAttributes(array('ruangan_id'=>$idruang,'pegawai_id'=>$idpegawai));
            $periksas = PemeriksaanfisikV::model()->findAllByAttributes(array('ruangan_id'=>$idruang,'no_rekam_medik'=>$pendaftaran->no_rekam_medik),array('order'=>'tglperiksafisik DESC'));
            
            $this->render('_formPemeriksaan',array('pemeriksaanFisik'=>$pemeriksaanFisik,
                                                   'pendaftaran'=>$pendaftaran,
                                                   'periksas'=>$periksas));
        }
        
        public function actionAjaxLihatPeriksa()
        {
            $id = $_POST['periksa_id'];
            $pemeriksaanFisik = PemeriksaanfisikT::model()->findByPk($id);
            $pendaftaran = DaftarpasienV::model()->findByAttributes(array('no_pendaftaran'=>$anamnesa->no_pendaftaran));
            $render = $this->renderPartial('_viewPemeriksaan',array('pemeriksaanFisik'=>$pemeriksaanFisik,'pendaftaran',$pendaftaran),true);
            
            $data['render'] = $render;

            echo json_encode($data);
            Yii::app()->end();
        }
        
        public function actionAjaxLaboratorium($nopend)
        {
            if(isset($_POST['simpan_laboratorium'])){
                $no_rekam_medik = Yii::app()->db->createCommand("SELECT no_rekam_medik FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryScalar();
                $sql = "SELECT pemeriksaanlabklinik_t.pemeriksaanklinik_id FROM hasilpemeriksaanlabklinik_t
                        JOIN pemeriksaanlabklinik_t ON pemeriksaanlabklinik_t.pemeriksaanklinik_id = hasilpemeriksaanlabklinik_t.pemeriksaanklinik_id
                        WHERE pemeriksaanlabklinik_t.no_pendaftaran = '$nopend'";
                $tindakans = Yii::app()->db->createCommand($sql)->queryAll();
                $pemeriksaanklinik_id = $tindakans[0]['pemeriksaanklinik_id'];
                
                $sql1 = "select * from pasienkirimkeunitlain_t WHERE no_pendaftaran = '$nopend'
                        AND ruangan_id = ".Yii::app()->params['ruangan_labklinik'];
                $cek = Yii::app()->db->createCommand($sql1)->queryAll();
                if($cek[0]['pasienkirimkeunitlain_id']==''){
                    $rujukanMasuk = new PasienkirimkeunitlainT;
                    $rujukanMasuk->pegawai_id = Yii::app()->session['pegawai_id'];
                    $rujukanMasuk->ruangan_id = Yii::app()->params['ruangan_labklinik'];
                    $rujukanMasuk->no_pendaftaran = $nopend;
                    $rujukanMasuk->no_rekam_medik = $no_rekam_medik;
                    $rujukanMasuk->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                    $rujukanMasuk->tgl_kirimpasien = date('Y-m-d H:i:s');
                    if($rujukanMasuk->save())
                        $this->saveRujukanLab($nopend,$pemeriksaanklinik_id);
                        header("Location: ".$_REQUEST['link']."");
                } else {
                    $this->saveRujukanLab($nopend,$pemeriksaanklinik_id);
                     header("Location: ".$_REQUEST['link']."");

                }
                 header("Location: ".$_REQUEST['link']."");
            }
            
            $this->layout = '//layouts/polos';
            $sql = "SELECT * FROM hasilpemeriksaanlabklinik_t
                    JOIN pemeriksaanlabklinik_t ON pemeriksaanlabklinik_t.pemeriksaanklinik_id = hasilpemeriksaanlabklinik_t.pemeriksaanklinik_id
                    WHERE no_pendaftaran = '$nopend'";
            $tindakans = Yii::app()->db->createCommand($sql)->queryAll();
            $jenisPemeriksaanLabs = JenispemeriksaanlabM::model()->findAllByAttributes(array('jenispemeriksaanlab_aktif'=>TRUE),array('order'=>'jenispemeriksaanlab_urutan'));
            $pemeriksaanLabs = PemeriksaanlabM::model()->with('daftartindakan')->findAllByAttributes(array('pemeriksaanlab_aktif' => true),array('order'=>'pemeriksaanlab_urutan'));
            $pemeriksaanLabDetails = PemeriksaanlabdetailM::model()->findAllByAttributes(array('pemeriksaanlabdetail_aktif' => TRUE),array('order'=>'pemeriksaanlabdetail_urutan'));
            
            $this->render('_formLaboratorium',array('jenisPemeriksaanLabs'=>$jenisPemeriksaanLabs,
                                                    'pemeriksaanLabs'=>$pemeriksaanLabs,
                                                    'pemeriksaanLabDetails'=>$pemeriksaanLabDetails,
                                                    'tindakans'=>$tindakans));
        }
        
        public function actionAjaxRadiologi($nopend)
        {
            if(isset($_POST['simpan_radiologi'])){
                $no_rekam_medik = Yii::app()->db->createCommand("SELECT no_rekam_medik FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryScalar();
                $sql = "select * from pasienkirimkeunitlain_t WHERE no_pendaftaran = '$nopend'
                        AND ruangan_id = ".Yii::app()->params['ruangan_radiologi'];
                $cek = Yii::app()->db->createCommand($sql)->queryAll();
                if($cek[0]['pasienkirimkeunitlain_id']==''){
                    $rujukanMasuk = new PasienkirimkeunitlainT;
                    $rujukanMasuk->pegawai_id = Yii::app()->session['pegawai_id'];
                    $rujukanMasuk->ruangan_id = Yii::app()->params['ruangan_radiologi'];
                    $rujukanMasuk->no_pendaftaran = $nopend;
                    $rujukanMasuk->no_rekam_medik = $no_rekam_medik;
                    $rujukanMasuk->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                    $rujukanMasuk->tgl_kirimpasien = date('Y-m-d H:i:s');
                    if($rujukanMasuk->save())
                        $this->saveRujukanRadiologi($nopend);
                        header("Location: ".$_REQUEST['link']."");
                } else {
                    $this->saveRujukanRadiologi($nopend);
                    header("Location: ".$_REQUEST['link']."");
                }
                header("Location: ".$_REQUEST['link']."");
            }
            
            $this->layout = '//layouts/polos';
            $hasilRad = HasilpemeriksaanradT::model()->findAllByAttributes(array('no_pendaftaran'=>$nopend));
            $tindakans = TindakanpelayananT::model()->findAllByAttributes(array('no_pendaftaran'=>$nopend));
            
            $this->render('_formRadiologi',array('hasilRad'=>$hasilRad,
                                                 'tindakans'=>$tindakans));
        }
        
        public function actionAjaxTindakan($nopend)
        {
            $this->layout = '//layouts/polos';
            $pendaftaran = PendaftaranT::model()->findByPk($nopend);
            $pasien = PasienM::model()->findByPk($pendaftaran->no_rekam_medik);
            $jenis_dokter = JenisdokterpemeriksaM::model()->findAllByAttributes(array('instalasi_id'=>Yii::app()->session['pemakai_ruangan_instalasi_id']));
            $paketTindakan = PakettindakanV::model()->findAllByAttributes(array('kelaspelayanan_id'=>$pendaftaran->kelaspelayanan_id,
                                                                                'penjamin_id'=>$pendaftaran->penjamin_id));
            
            if(isset($_POST['simpan_tindakan'])){ 
                $transaction = Yii::app()->db->beginTransaction();
                try 
                {
                    if(isset($_POST['tindakan']['tarif'])){
                        if(isset($_POST['tipepaket1']) && $_POST['tipepaket1']=='non_paket'){ 
                            $this->saveTindakanNonPaket($pendaftaran);
                            $tipepaket = '1'; // 1 = non paket
                        }

                        if(isset($_POST['tipepaket2']) && $_POST['tipepaket2']=='paket'){
                            $this->saveTindakanPaket($pendaftaran);
                            $tipepaket = $_POST['tipepaket_id'];
                        }
                    } else { $tipepaket = '1'; }

                    if(isset($_POST['obatalkes'])){
                        $this->saveTindakanObatAlkes($pendaftaran,$tipepaket);
                        $obatalkes = PelayananobatalkesT::model()->with('obatAlkes')->findAllByAttributes(array('no_pendaftaran'=>$nopend,'ruangan_id'=>Yii::app()->session['pemakai_ruangan_id']));
                    }
                    
                    $transaction->commit();
                    Yii::app()->user->setFlash('success',"Data Tindakan berhasil disimpan");

                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error',"Data Tindakan gagal disimpan");
                }
                
//                $url = Yii::app()->createUrl('rawatJalan/formTab/tindakan', array('nopend'=>$nopend));
//                $this->redirect($url);
                 header("Location: ".$_REQUEST['link']." ");
            }
            
            $tindakan = TindakanbelumbayarV::model()->findAllByAttributes(array('no_pendaftaran'=>$nopend,'ruangan_id'=>Yii::app()->session['pemakai_ruangan_id']));
            //$tindakanNonPaket = TindakanbelumbayarV::model()->findAllByAttributes(array('no_pendaftaran'=>$nopend,'ruangan_id'=>Yii::app()->session['pemakai_ruangan_id'],'tipepaket_id'=>'1'));
            $obatalkes = PelayananobatalkesT::model()->with('obatAlkes')->findAllByAttributes(array('no_pendaftaran'=>$nopend,'ruangan_id'=>Yii::app()->session['pemakai_ruangan_id']));
            $dokterTindakans = array();
            $paramediss = array();
            if(!empty($tindakan)){
                foreach ($tindakan as $key => $tindak) {
                    $dokterTindakans[$tindak->tindakanpel_id] = DoktertindakanT::model()->findAllByAttributes(array('tindakanpel_id'=>$tindak->tindakanpel_id));
                    $paramediss[$tindak->tindakanpel_id] = ParamedisnonparamedisT::model()->findAllByAttributes(array('tindakanpel_id'=>$tindak->tindakanpel_id));
                }
            }
            
            $this->render('_formTindakan',array('pendaftaran'=>$pendaftaran,
                                                'pasien'=>$pasien,
                                                'dokterTindakans'=>$dokterTindakans,
                                                'tindakan'=>$tindakan,
                                                //'tindakanNonPaket'=>$tindakanNonPaket,
                                                'jenis_dokter'=>$jenis_dokter,
                                                'paketTindakan'=>$paketTindakan,
                                                'obatalkes'=>$obatalkes,
                                                'paramediss'=>$paramediss,));
        }
        
        public function actionAjaxDiagnosa($nopend)
        {
            $this->layout = '//layouts/polos';
            $diagnosa = new DiagnosapasienT;
            $diagnosaPasienV = DiagnosapasienT::model()->with('diagnosa','kelompokdiagnosa')->findAllByAttributes(array('no_pendaftaran'=>$nopend),array('order'=>'tglperiksadiagnosa'));

            $diagnosaM = new DiagnosaM;
            $diagnosatindakanM = new DiagnosatindakanM;
            $diagnosatindakanP = new DiagnosatindakanpasienT;

            $pendaftar = PendaftaranT::model()->findByPk($nopend);
            $pasien = PasienM::model()->findByAttributes(array('no_rekam_medik'=>$pendaftar->no_rekam_medik));
            $cek = array('diagnosa_kode'=>'','diagnosa_nama'=>'','diagnosa_namalainnya'=>'','diagnosa_katakunci'=>'');
            
            if(isset($_POST['simpan_diagnosa'])){
                if(isset($_POST['DiagnosapasienT'])){
                    
                    if(!empty($_POST['diagnosa_id'])){
                        $diag = $_POST['diagnosa_id'];
                        $counter = count($diag);
                        $keldiag = $_POST['keldiagnosa'];
                    }
                    
                    if(empty ($counter)){
                        CActiveForm::validate(array($diagnosa)); 
                    } else {
                        $golumur_id = Yii::app()->db->createCommand("SELECT golonganumur_id FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryScalar();
                        for($i = 0 ; $i < $counter; $i++){
                            $diagnosa = new DiagnosapasienT;
                            $diagnosa->ruangan_id = Yii::app()->session['pemakai_ruangan_id'];
                            $diagnosa->no_pendaftaran = $nopend;
                            $diagnosa->pegawai_id = Yii::app()->session['pegawai_id'];
                            $diagnosa->golonganumur_id = $golumur_id;
                            $diagnosa->kasusdiagnosa_id = '';
                            $diagnosa->tglperiksadiagnosa = date('Y-m-d');
                            $diagnosa->kelompokdiagnosa_id = $keldiag[$i];
                            $diagnosa->diagnosa_id = $diag[$i];

                            CActiveForm::validate(array($diagnosa));
                            if($diagnosa->validate()){
                                if($diagnosa->save()){
                                    if(isset($_POST['isDiagnosaTindakan'])){
                                        $diagnosatindakanP = new DiagnosatindakanpasienT;
                                        $diagnosatindakanP->diagnosapasien_id = $diagnosa->diagnosapasien_id;
                                        $diagnosatindakanP->no_pendaftaran = $nopend;
                                        $diagnosatindakanP->diagnosatindakan_id = $_POST['DiagnosatindakanpasienT']['diagnosatindakan_id'];
                                        $diagnosatindakanP->tgldiagnosatindpasien = date('Y-m-d');
                                        CActiveForm::validate(array($diagnosatindakanP));
                                        if($diagnosatindakanP->validate()){
                                            $diagnosatindakanP->save();
                                        }
                                    }
                                    Yii::app()->user->setFlash('success',"Data berhasil disimpan");
                                    $diagnosaPasienV = DiagnosapasienT::model()->with('diagnosa','kelompokdiagnosa')->findAllByAttributes(array('no_pendaftaran'=>$nopend),array('order'=>'tglperiksadiagnosa'));
                                }else{
                                    Yii::app()->user->setFlash('error',"Data gagal disimpan!");
                                }
                            }else{
                                Yii::app()->user->setFlash('error',"Data tidak valid!");
                            }
                        }
                    }
                }
                
//                $url = Yii::app()->createUrl('rawatJalan/formTab/diagnosa', array('nopend'=>$nopend));
//                $this->redirect($url);
                   header("Location: ".$_REQUEST['link']."");
            }
            
            $this->render('_formDiagnosa',array('diagnosa'=>$diagnosa,
                                                'pendaftar'=>$pendaftar,
                                                'diagnosaM'=>$diagnosaM,
                                                'cek'=>$cek,
                                                'pasien'=>$pasien,
                                                'diagnosaPasienV'=>$diagnosaPasienV,
                                                'diagnosatindakanP'=>$diagnosatindakanP,
                                                'diagnosatindakanM'=>$diagnosatindakanM,));
        }
        
        public function actionAjaxTerapi($nopend)
        {
            $this->layout = '//layouts/polos';

            if(isset($_POST['simpan_terapi'])){
                $no_rekam_medik = Yii::app()->db->createCommand("SELECT no_rekam_medik FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryScalar();
                if(!empty($_POST['no_resep'])){
                    $dokterresep = new DokterresepT;
                    $dokterresep->noresep = $_POST['no_resep'];
                    $dokterresep->pegawai_id = $_POST['dokter_resep'];
                    $dokterresep->tglresep = date('Y-m-d');
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        $cekSave = false;
                        $cekData = true;
                        if($dokterresep->save()){
                            $cekSave = true;
                            $resep = new PenulisanresepT;
                            $resep->dokterreseptur_id = $dokterresep->dokterreseptur_id;
                            $resep->ruangan_id = $_POST['apotik_tujuan'];
                            $resep->no_rekam_medik = $no_rekam_medik;
                            $resep->no_pendaftaran = $nopend;
                            $resep->penjualanapotik_id = null;
                            $resep->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                            $resep->tglresep_tulis = date('Y-m-d');
                            $resep->statusresep = 0;
                            $resep->ruangantulisresep_id = Yii::app()->session['pemakai_ruangan_id'];

                            if($resep->save()){
                                $cekSave = true;
                                for($i=0;$i<count($_POST['obatalkesId']);$i++){
                                    $resepdetail = new TulisresepdetailT;
                                    $resepdetail->obatalkes_id = $_POST['obatalkesId'][$i];
                                    $resepdetail->satuankecil_id = $_POST['satuankecil_id'][$i];
                                    $resepdetail->asalbarang_id = $_POST['asalbarang_id'][$i];
                                    $resepdetail->penulisanresep_id = $resep->penulisanresep_id;
                                    $resepdetail->qty_tulisresep = $_POST['qty'][$i];
                                    $resepdetail->hna_tulisresep = $_POST['hna'][$i];
                                    $resepdetail->hpp_tulisresep = $_POST['harga'][$i];
                                    $resepdetail->subtotal_tulisresep = $_POST['subTotal'][$i];
                                    $resepdetail->dosis_tulisresep = $_POST['dosis'][$i];
                                    $resepdetail->signa_tulisresep = null;
                                    if($resepdetail->save()){
                                        $cekSave = true;
                                    }  else {
                                        $cekSave = false;
                                        $cekData = false;
                                    }   
                                }
                            } else {
                                $cekSave = false;
                                $cekData = false;
                            }

                        } else {
                            $cekSave = false;
                            $cekData = false;
                        }

                        if($cekSave && $cekData){
                            $transaction->commit();
                            Yii::app()->user->setFlash('success',"Data Berhasil disimpan");
                        } else {
                            $transaction->rollback();
                            Yii::app()->user->setFlash('error',"Data Gagal disimpan");
                        }

                    } catch (Exception $e) {
                        $transaction->rollback();
                        Yii::app()->user->setFlash('error',"Data Gagal disimpan");
                    }
                }
                
//               
                 header("Location: ".$_REQUEST['link']."");
            }
            
            if(Yii::app()->request->getIsAjaxRequest()){
                $sql = "SELECT * 
                        FROM penulisanresep_t
                        JOIN tulisresepdetail_t on tulisresepdetail_t.penulisanresep_id = penulisanresep_t.penulisanresep_id
                        JOIN obatalkes_v on obatalkes_v.obatalkes_id = tulisresepdetail_t.obatalkes_id AND penulisanresep_t.ruangan_id = obatalkes_v.ruangan_id
                        WHERE penulisanresep_t.no_pendaftaran = '$nopend' ORDER BY penulisanresep_t.tglresep_tulis DESC";
                $datas = Yii::app()->db->createCommand($sql)->queryAll();
                $no_resep = $this->generateNoResep();
                $this->render('_formTerapi',array('datas'=>$datas, 'no_resep'=>$no_resep));
            } else {
//                $url = Yii::app()->createUrl('rawatJalan/formTab/terapi', array('nopend'=>$nopend));
//                $this->redirect($url);
                  header("Location: ".$_REQUEST['link']." ");
            }
        }
        
        public function actionAjaxHapusTerapi()
        {
            if(Yii::app()->request->isAjaxRequest){
                $t_id = $_POST['tid'];
                $p_id = $_POST['pid'];
                $d_id = $_POST['did'];
                
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    TulisresepdetailT::model()->deleteByPk($t_id);
                    $terapi = TulisresepdetailT::model()->findAllByAttributes(array('penulisanresep_id'=>$p_id));
                    if(count($terapi) > 0){
                        // tidak melakukan apa-apa
                    } else {
                        PenulisanresepT::model()->deleteByPk($p_id);
                        DokterresepT::model()->deleteByPk($d_id);
                    }
                    $transaction->commit();
                    $data['status'] = 'ok';
                    $data['message'] = 'Data berhasil dihapus';
                } catch (Exception $e) {
                    $transaction->rollback();
                    $data['status'] = 'error';
                    $data['message'] = 'Data gagal dihapus';
                }
                echo json_encode($data);
            }
            Yii::app()->end();
        }
        
        public function actionAjaxLihatTerapi()
        {
            if(Yii::app()->request->isAjaxRequest){
                $t_id = $_POST['tid'];
                $sql = "SELECT * 
                        FROM penulisanresep_t
                        JOIN tulisresepdetail_t on tulisresepdetail_t.penulisanresep_id = penulisanresep_t.penulisanresep_id
                        JOIN obatalkes_v on obatalkes_v.obatalkes_id = tulisresepdetail_t.obatalkes_id AND penulisanresep_t.ruangan_id = obatalkes_v.ruangan_id
                        WHERE tulisresepdetail_t.tulisresepdetail_id = $t_id";
                $data = Yii::app()->db->createCommand($sql)->queryRow();
                echo var_dump($data);exit;
            }
        }
        
        public function actionAjaxRujukanLuar($nopend)
        {
            $this->layout = '//layouts/polos';
            
            if(isset($_POST['simpan_rujukan'])){
                $logpemakai_id = Yii::app()->session['log_pemakai_id'];
                $pegawai_id = Yii::app()->session['pegawai_id'];
                $rujukankeluar_id = $_POST['rujukankeluar_id'];
                $tgldirujuk = date('Y-m-d H:i:s');
                $dirujukkebagian = $_POST['dirujuk_ke_bagian'];
                $alasandirujuk = $_POST['alasan_dirujuk'];
                $catatandokterperujuk = $_POST['catatan_dokter_pengirim'];
                $doktertujuanrujukan = $_POST['dokterTujuan'];
                
                $sql = "INSERT INTO pasiendirujukkeluar_t (logpemakai_id, pegawai_id, no_pendaftaran, rujukankeluar_id, tgldirujuk,
                                                           dirujukkebagian, alasandirujuk, catatandokterperujuk, doktertujuanrujukan)
                        VALUES ($logpemakai_id,$pegawai_id, '$nopend', $rujukankeluar_id, '$tgldirujuk', '$dirujukkebagian', '$alasandirujuk',
                                '$catatandokterperujuk', '$doktertujuanrujukan')";
                
                //$rujukankeluar = new PasiendirujukkeluarT;
                //$rujukanKeluar->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                //$rujukanKeluar->pegawai_id = Yii::app()->session['pegawai_id'];
                //$rujukanKeluar->no_pendaftaran = $nopend;
                //$rujukanKeluar->rujukankeluar_id=$_POST['rujukankeluar_id'];
                //$rujukanKeluar->tgldirujuk = date('Y-m-d H:i:s');
                //$rujukanKeluar->dirujukkebagian = $_POST['dirujuk_ke_bagian'];
                //$rujukanKeluar->alasandirujuk = $_POST['alasan_dirujuk'];
                //$rujukanKeluar->catatandokterperujuk = $_POST['catatan_dokter_pengirim'];
                //$rujukanKeluar->doktertujuanrujukan = $_POST['dokterTujuan'];
                if(Yii::app()->db->createCommand($sql)->execute())
                    Yii::app()->user->setFlash('success',"simpan_rujukan");
                else
                    Yii::app()->user->setFlash('error',"simpan_rujukan");
                
//                $url = Yii::app()->createUrl('rawatJalan/formTab/rujukanLuar', array('nopend'=>$nopend));
//                $this->redirect($url);
                   header("Location: ".$_REQUEST['link']."");
            } 
            
            $sql = "SELECT pasiendirujukkeluar_t.pasiendirujukkeluar_id,
                           pasiendirujukkeluar_t.pegawai_id,
                           pasiendirujukkeluar_t.no_pendaftaran,
                           pasiendirujukkeluar_t.tgldirujuk,
                           pasiendirujukkeluar_t.dirujukkebagian,
                           pasiendirujukkeluar_t.alasandirujuk,
                           pasiendirujukkeluar_t.catatandokterperujuk,
                           pasiendirujukkeluar_t.doktertujuanrujukan,
                           rujukankeluar_m.rumahsakitrujukan
                    FROM pasiendirujukkeluar_t
                    JOIN rujukankeluar_m ON rujukankeluar_m.rujukankeluar_id = pasiendirujukkeluar_t.rujukankeluar_id
                    WHERE no_pendaftaran = '".$nopend."'
                    ORDER BY tgldirujuk DESC";
            $datas = Yii::app()->db->createCommand($sql)->queryAll();
            
            $this->render('_formRujukanLuar',array('datas'=>$datas,));
        }
        
        public function actionAjaxLihatRujukanKeluar()
        {
            $id = $_POST['pasiendirujukkeluar_id'];
            $rujukan = PasiendirujukkeluarT::model()->with('rujukankeluar')->findByPk($id);
            $pendaftaran = DaftarpasienV::model()->findByAttributes(array('no_pendaftaran'=>$rujukan->no_pendaftaran));
            $render = $this->renderPartial('_viewRujukanKeluar',array('rujukan'=>$rujukan,'pendaftaran',$pendaftaran),true);
            
            $data['render'] = $render;

            echo json_encode($data);
            Yii::app()->end();
        }
        
        public function actionprintStatusPulang($nopend) 
        {
            $this->layout='//layouts/templatePrintLaporan';
            $rujukanKeluarRS = PasiendirujukkeluarrsV::model()->findByAttributes(array('no_pendaftaran'=>$nopend));
            $this->render('cetakStatusPulangPrint', array('rujukanKeluarRS'=>$rujukanKeluarRS));
        } 
        
        public function actionAjaxKonsulPoli($nopend)
        {
            $this->layout = '//layouts/polos';
            $ruangan_labklinik = Yii::app()->params['ruangan_labklinik'];
            $ruangan_radiologi = Yii::app()->params['ruangan_radiologi'];
            $ruangan_bedahsentral = Yii::app()->params['ruangan_bedahsentral'];
            $sql = "SELECT pasienkirimkeunitlain_t.pasienkirimkeunitlain_id,
                           pasienkirimkeunitlain_t.no_pendaftaran,
                           pasienkirimkeunitlain_t.tgl_kirimpasien,
                           ruangan_m.ruangan_nama ruangan_asal,
                           ruangan_m2.ruangan_nama ruangan_tujuan
                    FROM pasienkirimkeunitlain_t
                    JOIN pendaftaran_t ON pendaftaran_t.no_pendaftaran = pasienkirimkeunitlain_t.no_pendaftaran
                    JOIN ruangan_m ON ruangan_m.ruangan_id = pendaftaran_t.ruangan_id
                    JOIN ruangan_m ruangan_m2 ON ruangan_m2.ruangan_id = pasienkirimkeunitlain_t.ruangan_id
                    WHERE pasienkirimkeunitlain_t.no_pendaftaran = '$nopend'
                    AND ruangan_m2.ruangan_id != $ruangan_labklinik AND ruangan_m2.ruangan_id != $ruangan_radiologi AND ruangan_m2.ruangan_id != $ruangan_bedahsentral
                    ORDER BY pasienkirimkeunitlain_t.no_pendaftaran, pasienkirimkeunitlain_t.tgl_kirimpasien DESC";
            
            $datas = Yii::app()->db->createCommand($sql)->queryAll();
            
            if(isset($_POST['simpan_konsul'])){
                $no_rekam_medik = Yii::app()->db->createCommand("SELECT no_rekam_medik FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryScalar();
                
                $rujukanMasuk = new PasienkirimkeunitlainT;
                $rujukanMasuk->pegawai_id = Yii::app()->session['pegawai_id'];
                $rujukanMasuk->ruangan_id = $_POST['ruangan_id'];
                $rujukanMasuk->no_pendaftaran = $nopend;
                $rujukanMasuk->no_rekam_medik = $no_rekam_medik;
                $rujukanMasuk->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                $rujukanMasuk->tgl_kirimpasien = date('Y-m-d H:i:s');
                if($rujukanMasuk->save())
                    Yii::app()->user->setFlash('success',"Data berhasil disimpan");
                else
                    Yii::app()->user->setFlash('error',"Data gagal disimpan");
                
//                $url = Yii::app()->createUrl('rawatJalan/formTab/konsulPoli', array('nopend'=>$nopend));
//                $this->redirect($url);
                 header("Location: ".$_REQUEST['link']." ");
            }
            
            $this->render('_formKonsulPoli',array('datas'=>$datas));
        }
        
        public function actionHapusKonsulPoli($pk,$nopend)
        {
            if(isset($pk)){
//                echo $pk;
//                echo 'mau hapus';exit;
                if(PasienkirimkeunitlainT::model()->deleteByPk($pk))
                    Yii::app()->user->setFlash('success',"Data berhasil dihapus");
                else
                    Yii::app()->user->setFlash('error',"Data gagal dihapus");
                
                $url = Yii::app()->createUrl('rawatJalan/formTab/konsulPoli', array('nopend'=>$nopend));
                $this->redirect($url);
            }
            
        }
        
        protected function saveRujukanRadiologi($nopend)
        {
            $data = Yii::app()->db->createCommand("SELECT kelaspelayanan_id,penjamin_id FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryRow();
            $kelaspel = $data['kelaspelayanan_id'];
            $penjamin_id = $data['penjamin_id'];
            $transaction = Yii::app()->db->beginTransaction();
            try 
            {
                $cekSave = true;
                $cekData = true;
                for ($i = 0; $i < count($_POST['periksarads']); $i++) {
                    $hasilperiksas =  new HasilpemeriksaanradT;
                    $hasilperiksas->pemeriksaanrad_id = $_POST['periksarads'][$i];
                    $hasilperiksas->tglpemeriksaanrad = date('Y-m-d');
                    $hasilperiksas->tglpegambilanhasilrad = date('Y-m-d');
                    $hasilperiksas->no_pendaftaran = $nopend;
                    $hasilperiksas->ruanganasal_id = Yii::app()->session['pemakai_ruangan_id'];
                    if($hasilperiksas->save()){
                        $cekSave = true;
                    }  else {
                        $cekSave = false;
                        $cekData = false;
                    }

                    //mengambil satuantindakan_id,tipepaket_id,
                    $daftin = $_POST['daftartindakan_id'][$i];
//                    $sql = "select * from tindakanruangan_v where daftartindakan_id =$daftin and kelaspelayanan_id = $kelaspel";
                    $sql = "select * from tindakanruangan_v where daftartindakan_id =$daftin ";
                    $JalankanQuery = Yii::app()->db->createCommand($sql)->queryRow();
                    //mengambil tipe paket id
                    $sql2 = "select * from tipepakettindakan_v where daftartindakan_id =$daftin and kelaspelayanan_id = $kelaspel and penjamin_id = $penjamin_id";
                    $JalankanQuery2 = Yii::app()->db->createCommand($sql2)->queryRow();

                    //simpan ke tindakanpelayanan_t
                        $tindakan = new TindakanpelayananT;
                        if(!empty ($JalankanQuery)){
                            $tindakan->satuantindakan_id = $JalankanQuery['satuantindakan_id'];
                            $tindakan->tarif_tindakan = $JalankanQuery['harga_tariftindakan'];
                        } 
                        
                        $tindakan->no_pendaftaran = $nopend;
                        $tindakan->kelaspelayanan_id = $kelaspel;
                        $tindakan->logpemakai_id = Yii::app()->session['log_pemakai_id'];
//                        $tindakan->pasienmasukpenunjang_id = $_POST['pasienmasukpenunjang_id'];
                        $tindakan->daftartindakan_id = $_POST['daftartindakan_id'][$i];
                        $tindakan->ruangan_id = Yii::app()->params['ruangan_radiologi'];
                        $tindakan->penjamin_id = $penjamin_id;
                        $tindakan->tgltindakanpel = date('Y-m-d H:i:s');
                        if(!empty ($JalankanQuery2)){
                            $tindakan->tipepaket_id = $JalankanQuery2['tipepaket_id'];
                        }
                        
                        $tindakan->qty_tindakan = 1;
                        $tindakan->cytotindakan = 0;
                        if($tindakan->save()){
                            $cekSave = true;
                        }  else {
                            $cekSave = false;
                            $cekData = false;
                        }

                }
            
                if($cekSave && $cekData){
                    $transaction->commit();
                    Yii::app()->user->setFlash('success',"Data Radiologi Berhasil disimpan");
                    $url = Yii::app()->createUrl('rawatJalan/formTab/radiologi', array('nopend'=>$nopend));
                    $this->redirect($url);
                } else {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error',"Data Radiologi Gagal disimpan");
                    $url = Yii::app()->createUrl('rawatJalan/formTab/radiologi', array('nopend'=>$nopend));
                    $this->redirect($url);
                }
                
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error',"Data Radiologi Gagal disimpan");
                $url = Yii::app()->createUrl('rawatJalan/formTab/radiologi', array('nopend'=>$nopend));
                $this->redirect($url);
            }
        }
        
        protected function saveRujukanLab($nopend,$pemeriksaanklinik_id)
        {
            $data = Yii::app()->db->createCommand("SELECT kelaspelayanan_id,penjamin_id FROM pendaftaran_t WHERE no_pendaftaran = '$nopend'")->queryRow();
            $kelaspel = $data['kelaspelayanan_id'];
            $penjamin_id = $data['penjamin_id'];
            
            if(!empty($_POST['pemeriksaanlabdetail'])){
                if(empty($pemeriksaanklinik_id)){
                    $pemeriksaanlab = new PemeriksaanlabklinikT;
                    $pemeriksaanlab->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                    $pemeriksaanlab->statusperiksa_id = 1;
                    $pemeriksaanlab->no_pendaftaran = $nopend;
                    $pemeriksaanlab->ruanganasal_id = Yii::app()->session['pemakai_ruangan_id'];
                    if($pemeriksaanlab->save()){
                        $pemeriksaanklinik_id = $pemeriksaanlab->pemeriksaanklinik_id;
                    } 
                }
                $transaction = Yii::app()->db->beginTransaction();
                try {

                    $n = count($_POST['pemeriksaanlabdetail']);
                    if(!empty($n)){
                        for ($i = 0; $i < $n; $i++) {
                            $hasilpemeriksaanlab = new HasilpemeriksaanlabklinikT;
                            $hasilpemeriksaanlab->pemeriksaanklinik_id = $pemeriksaanklinik_id;
                            $hasilpemeriksaanlab->pemeriksaanlabdetail_id = $_POST['pemeriksaanlabdetail'][$i];
                            $hasilpemeriksaanlab->daftartindakan_id = $_POST['daftartindakan_id'][$i];
                            $hasilpemeriksaanlab->save();

                            $ambilTindakan = TindakanruanganV::model()->findByAttributes(array('daftartindakan_id'=>$hasilpemeriksaanlab->daftartindakan_id,'kelaspelayanan_id'=>$kelaspel));    
                            $ambilTipeTindakan = TipepakettindakanV::model()->findByAttributes(array('daftartindakan_id'=>$hasilpemeriksaanlab->daftartindakan_id,'kelaspelayanan_id'=>$kelaspel,'penjamin_id'=>$penjamin_id));    

                            $tindakan = new TindakanpelayananT;
                            if(!empty($ambilTindakan)){$satuan = $ambilTindakan->satuantindakan_id;}else{$satuan =null;}
                            $tindakan->satuantindakan_id = $satuan;
                            $tindakan->no_pendaftaran = $nopend;
                            $tindakan->kelaspelayanan_id = $kelaspel;
                            $tindakan->logpemakai_id = Yii::app()->session['log_pemakai_id'];
//                                                $tindakan->pasienmasukpenunjang_id = $pasienmasuk_id;
                            $tindakan->daftartindakan_id = $_POST['daftartindakan_id'][$i]; //$hasilpemeriksaanlab->daftartindakan_id;
                            $tindakan->ruangan_id = Yii::app()->params['ruangan_labklinik'];
                            if(!empty($ambilTipeTindakan)){$tipepaket = $ambilTipeTindakan['tipepaket_id'];}else{$tipepaket =null;}
                            $tindakan->tipepaket_id = $tipepaket;
                            $tindakan->penjamin_id = $penjamin_id;
                            $tindakan->tgltindakanpel = date('Y-m-d H:i:s');
                            if($ambilTindakan['harga_tariftindakan'] == ''){
                                $tindakan->tarif_tindakan = 0;   
                            } else {
                                $tindakan->tarif_tindakan = $ambilTindakan['harga_tariftindakan'];
                            }

                            $tindakan->qty_tindakan = 1;
                            $tindakan->cytotindakan = 0;
                            $tindakan->tarifcytotindakan = null;
                            $tindakan->jumlahdiscounttind = null;
                            $tindakan->subsidiaskes_tind = null;
                            $tindakan->subsidirumahsakit_tind = null;
                            $tindakan->subsidipemerintah_tind = null;
                            $tindakan->costsharing_tind = null;
                            $tindakan->save();

                        }
                        $transaction->commit();
                    }
                        Yii::app()->user->setFlash('success', "Data berhasil disimpan");
                        $url = Yii::app()->createUrl('rawatJalan/formTab/laboratorium', array('nopend'=>$nopend));
                        $this->redirect($url);

                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error', "Data gagal disimpan");
                    $url = Yii::app()->createUrl('rawatJalan/formTab/laboratorium', array('nopend'=>$nopend));
                    $this->redirect($url);
                }
           } else {
                $url = Yii::app()->createUrl('rawatJalan/formTab/laboratorium', array('nopend'=>$nopend));
                $this->redirect($url);
           }
        }


        protected function saveTindakanNonPaket($pendaftaran)
        {
//            $transaction = Yii::app()->db->beginTransaction();
//            try 
//            {   
                for($i=0;$i<count($_POST['tindakan']['daftartindakan_id']);$i++) :
                $daftarTindakan_id = (int)$_POST['tindakan']['daftartindakan_id'][$i];
                $tindakan = new TindakanpelayananT;
                //$tindakan->tindakanpel_id =
                $tindakan->no_pendaftaran = "$pendaftaran->no_pendaftaran";
                $tindakan->kelaspelayanan_id = (int)$pendaftaran->kelaspelayanan_id;
                $tindakan->logpemakai_id = (int)Yii::app()->session['log_pemakai_id'];
                $tindakan->daftartindakan_id = (int)$_POST['tindakan']['daftartindakan_id'][$i];
                $tindakan->tgltindakanpel = date('Y-m-d H:i:s');
                $tindakan->qty_tindakan = $_POST['tindakan']['qty_tindakan'][$i];
                if(!isset($_POST['tindakan']['cytotindakan'][$i])) $_POST['tindakan']['cytotindakan'][$i] = 0; 
                $tindakan->cytotindakan = $_POST['tindakan']['cytotindakan'][$i];
                $tindakan->satuantindakan_id = (int)$_POST['tindakan']['satuantindakan_id'][$i];
                $tindakan->tipepaket_id = '1'; // 1 = non paket
                $tindakan->penjamin_id = (int)$pendaftaran->penjamin_id;
                $tindakan->tarif_tindakan = $_POST['tindakan']['tarif'][$i];
                $tindakan->tarifcytotindakan = $_POST['tindakan']['tarifcytotindakan'][$i];
                $tindakan->jumlahdiscounttind = $_POST['tindakan']['hargadiskon_tind'][$i];
                $tindakan->subsidirumahsakit_tind = '0';
//                $tindakan->subsidipenjamin = '0';
//                $tindakan->subsidipasien = '0';
                $tindakan->ruangan_id = (int)Yii::app()->session['pemakai_ruangan_id'];//(int)$pendaftaran->ruangan_id;
                if($tindakan->save())
                {
                    if(isset($_POST['tindakan']['dokter_id'][$daftarTindakan_id])){
                        for($j=0;$j<count($_POST['tindakan']['dokter_id'][$daftarTindakan_id]);$j++):
                            $dokterTindakan = new DoktertindakanT;
                            $dokterTindakan->pegawai_id = $_POST['tindakan']['dokter_id'][$daftarTindakan_id][$j];
                            $dokterTindakan->jenisdokter_id = $_POST['tindakan']['jenisdokter_id'][$daftarTindakan_id][$j];
                            $dokterTindakan->tglperiksadokter = date('Y-m-d');
                            $dokterTindakan->tindakanpel_id = $tindakan->tindakanpel_id;
                            $dokterTindakan->save();
                        endfor;
                    }

                    if(isset($_POST['tindakan']['paramedis_id'][$daftarTindakan_id])){
                        for($k=0;$k<count($_POST['tindakan']['paramedis_id'][$daftarTindakan_id]);$k++):
                            $paramedis = new ParamedisnonparamedisT;
                            $paramedis->pegawai_id = $_POST['tindakan']['paramedis_id'][$daftarTindakan_id][$k];
                            $paramedis->tglperiksaparam = date('Y-m-d');
                            $paramedis->tindakanpel_id = $tindakan->tindakanpel_id;
                            $paramedis->save();
                        endfor;
                    }
                }
                endfor;

//                $transaction->commit();
//                Yii::app()->user->setFlash('success',"Data Tindakan berhasil disimpan");
//
//            } catch (Exception $e) {
//                $transaction->rollback();
//                Yii::app()->user->setFlash('error',"Data Tindakan gagal disimpan");
//            }
        }

        protected function saveTindakanPaket($pendaftaran)
        {
            //var_dump($_POST['tindakan']);exit;
            $tarifPaket = $_POST['tarifPaket'];
            $jmlTarif = $_POST['jmlTarif'];
//            $transaction = Yii::app()->db->beginTransaction();
//            try 
//            {   
                for($i=0;$i<count($_POST['tindakan']['daftartindakan_id']);$i++) :
                $daftarTindakan_id = (int)$_POST['tindakan']['daftartindakan_id'][$i];
                $tindakan = new TindakanpelayananT;
                //$tindakan->tindakanpel_id =
                $tindakan->no_pendaftaran = "$pendaftaran->no_pendaftaran";
                $tindakan->kelaspelayanan_id = (int)$pendaftaran->kelaspelayanan_id;
                $tindakan->logpemakai_id = (int)Yii::app()->session['log_pemakai_id'];
                $tindakan->daftartindakan_id = (int)$_POST['tindakan']['daftartindakan_id'][$i];
                $tindakan->tgltindakanpel = date('Y-m-d H:i:s');
                $tindakan->qty_tindakan = $_POST['tindakan']['qty_tindakan'][$i];
                if(!isset($_POST['tindakan']['cyto'][$i])) $_POST['tindakan']['cyto'][$i] = 0; 
                $tindakan->cytotindakan = $_POST['tindakan']['cyto'][$i];
                //if(!isset($_POST['tindakan']['persendiskon'][$i])) $_POST['tindakan']['persendiskon'][$i] = 0;
                //$tindakan->persendiscount = $_POST['tindakan']['persendiskon'][$i];
                $tindakan->satuantindakan_id = (int)$_POST['tindakan']['satuantindakan_id'][$i];
                $tindakan->tipepaket_id = $_POST['tipepaket_id']; 
                $tindakan->penjamin_id = (int)$pendaftaran->penjamin_id;
                $tindakan->tarif_tindakan = $_POST['tindakan']['tarif'][$i]; //$this->proporsiTarifTindakan($tarifPaket, $_POST['tindakan']['tarif'][$i], $jmlTarif);//============================
                $tindakan->tarifcytotindakan = '0'; //$_POST['tindakan']['tarifcyto'][$i];
                $tindakan->jumlahdiscounttind = '0'; //$_POST['tindakan']['hargadiskon'][$i];
                $tindakan->subsidirumahsakit_tind = '0';
                $tindakan->ruangan_id = (int)Yii::app()->session['pemakai_ruangan_id'];
                if($tindakan->save())
                {
                    if(isset($_POST['tindakan']['dokter_id'][$daftarTindakan_id])){
                        for($j=0;$j<count($_POST['tindakan']['dokter_id'][$daftarTindakan_id]);$j++):
                            $dokterTindakan = new DoktertindakanT;
                            $dokterTindakan->pegawai_id = $_POST['tindakan']['dokter_id'][$daftarTindakan_id][$j];
                            $dokterTindakan->jenisdokter_id = $_POST['tindakan']['jenisdokter_id'][$daftarTindakan_id][$j];
                            $dokterTindakan->tglperiksadokter = date('Y-m-d');
                            $dokterTindakan->tindakanpel_id = $tindakan->tindakanpel_id;
                            $dokterTindakan->save();
                        endfor;
                    }

                    if(isset($_POST['tindakan']['paramedis_id'][$daftarTindakan_id])){
                        for($k=0;$k<count($_POST['tindakan']['paramedis_id'][$daftarTindakan_id]);$k++):
                            $paramedis = new ParamedisnonparamedisT;
                            $paramedis->pegawai_id = $_POST['tindakan']['paramedis_id'][$daftarTindakan_id][$k];
                            $paramedis->tglperiksaparam = date('Y-m-d');
                            $paramedis->tindakanpel_id = $tindakan->tindakanpel_id;
                            $paramedis->save();
                        endfor;
                    }
                }
                endfor;

//                $transaction->commit();
//                Yii::app()->user->setFlash('success',"Data Tindakan berhasil disimpan");
//
//            } catch (Exception $e) {
//                    $transaction->rollback();
//                    Yii::app()->user->setFlash('error',"Data Tindakan gagal disimpan");
//            }
        }
        
        protected function proporsiTarifTindakan($tarifPaket,$tarifTindakan,$jmlTarif)
        {
            $tarif = 0;
            $tarif = $tarifTindakan / $jmlTarif * $tarifPaket;
            
            return $tarif;
        }

        protected function saveTindakanObatAlkes($pendaftaran,$tipepaket)
        {
            $obatAlkes_id = $_POST['obatalkes']['obatalkes_id'];
            $qty = $_POST['obatalkes']['qty'];
            $harga = $_POST['obatalkes']['harga'];
            $counter = count($obatAlkes_id);
            
            for($i = 0 ; $i < $counter; $i++){
                $obatAlkes = new PelayananobatalkesT;
                $obatAlkes->obatalkes_id = $obatAlkes_id[$i];
                $obatAlkes->tipepaket_id = $tipepaket;//$pendaftaran->ruangan_id;
                $obatAlkes->no_pendaftaran = $pendaftaran->no_pendaftaran;
                $obatAlkes->logpemakai_id = Yii::app()->session['log_pemakai_id'];
                $obatAlkes->asalbarang_id = '2';// 2 = operasional | untuk sementara
                $obatAlkes->ruangan_id = Yii::app()->session['pemakai_ruangan_id'];
                $obatAlkes->tglpelayananoa = date('Y-m-d H:i:s');
                $obatAlkes->qtyobatalkes = $qty[$i];
                $obatAlkes->hargasatuanoa = $harga[$i];
                $obatAlkes->cytooa = '0';
                $obatAlkes->hargacytooa = '0';
                $obatAlkes->harganettooa = $harga[$i];
                $obatAlkes->signa = '';

                //CActiveForm::validate(array($diagnosa));
                if($obatAlkes->validate()){
                    if($obatAlkes->save()){
                        Yii::app()->user->setFlash('success',"Data Obat / Alkes berhasil disimpan");
                        $diagnosaPasien = DiagnosapasienT::model()->with('diagnosa','kelompokdiagnosa')->findAllByAttributes(array('no_pendaftaran'=>$pendaftaran->no_pendaftaran),array('order'=>'tglperiksadiagnosa'));
                    }else{
                        Yii::app()->user->setFlash('error',"Data Obat / Alkes gagal disimpan");
                    }
                }else{
                    Yii::app()->user->setFlash('error',"Data Obat / Alkes tidak valid");
                }
            }
        }
        
        public function actionAutoCompleteCariTindakan()
        {
            if(Yii::app()->request->isAjaxRequest){

                 $criteria = new CDbCriteria;
                 $criteria->compare('LOWER(daftartindakan_nama)', strtolower($_GET['q']),true);
                 $criteria->compare('kelaspelayanan_id',$_GET['kelaspelayanan_id']);
                 $criteria->compare('ruangan_id',$_GET['ruangan_id']);
                 $criteria->limit = $_GET['limit'];
                 $criteria->order = 'daftartindakan_nama';

                 $datas = TindakanruanganV::model()->findAll($criteria);
                 
                 $returnVal = '';
                 foreach($datas as $data)
                 {
                    $returnVal .= $data->getAttribute('daftartindakan_nama').'|'
                                  .$data->getAttribute('daftartindakan_id').'|'
                                  .$data->getAttribute('satuantindakan_id').'|'
                                  .$data->getAttribute('satuantindakan_nama').'|'
                                  .$data->getAttribute('kategoritindakan_id').'|'
                                  .$data->getAttribute('kategoritindakan_nama').'|'
                                  .$data->getAttribute('harga_tariftindakan').'|'
                                  .$data->getAttribute('persencyto_tind').'|'
                                  .$data->getAttribute('persendiskon_tind').'|'
                                  .$data->getAttribute('hargadiskon_tind')."\n";
                 }

                  echo $returnVal;
             }
             Yii::app()->end();
        }
        
        public function actionAutoCompleteCariTindakanPaket()
        {
            if(Yii::app()->request->isAjaxRequest){

                 $sql = "SELECT tipepaket_m.tipepaket_nama,
                               tipepaket_m.tipepaket_id
                        FROM pakettindakan_v
                        JOIN pakettindakan_m ON pakettindakan_m.pakettindakan_id = pakettindakan_v.pakettindakan_id
                        JOIN tipepaket_m ON tipepaket_m.tipepaket_id = pakettindakan_m.tipepaket_id
                        WHERE ((LOWER(tipepaket_m.tipepaket_nama) LIKE '".$_GET['q']."%' ) AND 
                            pakettindakan_v.kelaspelayanan_id = ".$_GET['kelaspelayanan_id'].") AND 
                            pakettindakan_v.penjamin_id = ".$_GET['penjamin_id']."
                        GROUP BY tipepaket_m.tipepaket_id, tipepaket_m.tipepaket_nama
                        LIMIT ".$_GET['limit'];

                 $datas = Yii::app()->db->createCommand($sql)->queryAll();
                 
                 $returnVal = '';
                 foreach($datas as $data)
                 {
                    $returnVal .= $data['tipepaket_nama'].'|'
                                  .$data['tipepaket_id']."\n";
                 }

                  echo $returnVal;
             }
             Yii::app()->end();
        }
        
        protected function setUserMenu()
        {
            $this->menu=require(dirname(__FILE__).'/usermenuparams.php');
        }
        
        public function actionhapusTindakan($idTindakan)
        {
            $data=explode('-', $idTindakan);
            $sql = "SELECT tindakansudahbayar_id FROM tindakansudahbayar_t WHERE tindakanpel_id=".$data[0]."";
            $belumBayar = Yii::app()->db->createCommand($sql)->query();

            if($belumBayar){
                $sqlObatAlkes = "DELETE FROM
                                        doktertindakan_t WHERE
                                        tindakanpel_id=".$data[0]."";

                $sqlParamedis = "DELETE FROM
                                        paramedisnonparamedis_t WHERE
                                        tindakanpel_id=".$data[0]."";

                $sqlKomponen = "DELETE FROM
                                        tindakankomponen_t WHERE
                                        tindakanpel_id=".$data[0]."";

                $dataSqlObatAlkes = Yii::app()->db->createCommand($sqlObatAlkes)->query();
                $dataSqlParamedis = Yii::app()->db->createCommand($sqlParamedis)->query();
                $dataKomponen = Yii::app()->db->createCommand($sqlKomponen)->query();
                $hapus = TindakanpelayananT::model()->deleteBypk($data[0]);
                if($hapus)
                {
                   Yii::app()->user->setFlash('success',"Data Tindakan Berhasil Dihapus");
                   header("Location:".bu()."/index.php/rawatJalan/formTab/tindakan/nopend/".$data[1].""); 
                }
                else
                {
                    Yii::app()->user->setFlash('error',"Data Tindakan Gagal Dihapus");
                    header("Location:".bu()."/index.php/rawatJalan/formTab/tindakan/nopend/".$data[1].""); 
                }
            } else {
                Yii::app()->user->setFlash('error',"Tindakan sudah dibayar");
                header("Location:".bu()."/index.php/rawatJalan/formTab/tindakan/nopend/".$data[1]."");
            }
        }
        
        public function actionHapusObat($idObat)
	{
	    $data=explode('-', $idObat);
            $sql = "SELECT obatalkessudahbayar_id FROM obatalkessudahbayar_t WHERE pelayananoa_id=".$data[0]."";
            $belumBayar = Yii::app()->db->createCommand($sql)->query();
            if($belumBayar) {
                $transaction = Yii::app()->db->beginTransaction();
                try 
                {
                    $sqlObatAlkes = "DELETE FROM
                                        obatalkeskomponen_t WHERE
                                        pelayananoa_id=".$data[0]."";

                    $dataSqlObatAlkes = Yii::app()->db->createCommand($sqlObatAlkes)->query();
                    $hapus = PelayananobatalkesT::model()->deleteBypk($data[0]);

                    $transaction->commit();
                    Yii::app()->user->setFlash('success',"Data Obat Berhasil Dihapus");

                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('error',"Data Obat Gagal Dihapus");
                }

                if($hapus)
                {
                   Yii::app()->user->setFlash('success',"Data Obat Berhasil Dihapus");
                   header("Location:".bu()."/index.php/rawatJalan/formTab/tindakan/nopend/".$data[1].""); 
                }
                else
                {
                    Yii::app()->user->setFlash('error',"Data Obat Gagal Dihapus");
                    header("Location:".bu()."/index.php/rawatJalan/formTab/tindakan/nopend/".$data[1].""); 
                }
            } else {
                Yii::app()->user->setFlash('error',"Obat sudah dibayar");
                header("Location:".bu()."/index.php/rawatJalan/formTab/tindakan/nopend/".$data[1]."");
            }
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
