    <?php

class KelolaKaryawanController extends Controller
{
	public $accordionIndex = Params::ACCORDION_PEGAWAI;
         
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
                if(!Yii::app()->user->checkAccess(Yii::app()->controller->action->id)){throw new CHttpException(401,Yii::t('mds','You are prohibited to access this page. Contact Super Administrator'));}
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
                        'actions'=>array(
                                'index',
                                'PendidikanKaryawan',
                                'PengalamanKerja',
                                'Mutasi',
                                'Cuti',
                                'SuratPeringatan',
                                'Kontrak',
                                'JenjangKarir',
                                'PrestasiKerja',
                                'PrintMutasi',
                                'PrintKontrak',
                                'PrintPeringatan',
                                'Komponengaji',
                                'deletePendidikan',
                                'deletePengalamankerja',
                                'deleteMutasi',
                                'deleteCutikaryawan',
                                'deleteKarykomponen',
                                'Printkontrakkerja',
                                'Printsuratperingatan',
                            ),
                        'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex($id)
	{
        $model=KKaryawanM::model()->findByPk($id);
	   $modPendidikankaryawan = array();
        $this->render('index',array('model'=>$model,
            'modPendidikankaryawan'=>$modPendidikankaryawan,
            'id'=>$id
        ));
	}

        public function actionPendidikanKaryawan($id)
        {
            if(Yii::app()->request->isAjaxRequest)
            $this->layout = '//layouts/polos';
            $model=KKaryawanM::model()->findByPk($id);
            $modelp=new KPendidikankaryawanR;
            $modelpro = KKaryawanM::model()->findAll();
            $modelkab = KKabupatenkotaM::model()->findAll();
            $indexTab = 0;
            if(isset($_POST['KPendidikankaryawanR']))
            {
                $modelp->attributes=$_POST['KPendidikankaryawanR'];
                $modelp->karyawan_id = $_POST['karyawan_id'];
                $nourutpendidikan = count(KPendidikankaryawanR::model()->findAllByAttributes(array('karyawan_id'=>$modelp->karyawan_id)))+1;
                $modelp->pendidikankaryawan_nourut = $nourutpendidikan;
              
                if($modelp->validate()){
                   $modelp->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                }else{
                      CActiveForm::validate($modelp);
                }

            }
            $this->render('_formPendidikan',array(
              'model'=>$model,
              'modelp'=>$modelp,
              'modelpro'=>$modelpro,
              'modelkab'=>$modelkab,
              'indexTab'=>$indexTab
            ));
        }
        public function actionPengalamanKerja($id)
        {
            if(Yii::app()->request->isAjaxRequest)
            $this->layout = '//layouts/polos';
            $model=KKaryawanM::model()->findByPk($id);
            $modelpk=new KPengalamankerjaR;
            $indexTab = 1;
            if(isset($_POST['KPengalamankerjaR']))
            {
                $modelpk->attributes=$_POST['KPengalamankerjaR'];
                $modelpk->karyawan_id = $_POST['karyawan_id'];
                $nourut = count(KPengalamankerjaR::model()->findAllByAttributes(array('karyawan_id'=>$modelpk->karyawan_id)))+1;
                $modelpk->pengalamankerja_nourut = $nourut;
                if($modelpk->validate()){ 
                    $modelpk->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                }
            }
            $this->render('_formPengalamanKerja',array(
                'model'=>$model,
                'modelpk'=>$modelpk,'indexTab'=>$indexTab
             ));
        }
                
        public function actionMutasi($id)
        {
            if(Yii::app()->request->isAjaxRequest)
            $this->layout = '//layouts/polos';
            $model=KKaryawanM::model()->findByPk($id);
            $modelm   = new KMutasiR;
            $modeljs  = KJenissuratM::model()->findByPk(Params::JENISSURAT_MUTASI_ID);
            $modelse  = KSuratelektronikR::model()->findAll();
            $nosurat = count(KSuratelektronikR::model()->findAll())+1;
            $modelm->mutasi_nomorsurat= $modeljs->jenissurat_no."/".date('m')."/".date('Y')."/".str_pad($nosurat,3,00,STR_PAD_LEFT);
            $modelser = array();
            if(isset($_POST['KMutasiR']))
            {
                $modelm->attributes=$_POST['KMutasiR'];

                $modelm->karyawan_id = $_POST['karyawan_id'];
                $modelser->jenissurat_id = $_POST['jenissurat_id'];
                
               CActiveForm::validate($modelm);
                $valid=$modelm->validate();
                if($valid){
                    if($modelm->save())
                    {
                        $modelm->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                        $modelser = new KSuratelektronikR;

                        $nosuratelektronik = count(KSuratelektronikR::model()->findAll())+1;
                        $modelser->nosurat = $modelm->mutasi_nomorsurat;
                        $modelser->tglsurat = $modelm->tglmutasi;
                        $modelser->judulsurat = $modeljs->jenissurat_judul;
                        $modelser->urutan = $nosuratelektronik;
                        $modelser->jenissurat_id = $modeljs->jenissurat_id;
                        $modelser->mengetahui = $_POST["mengetahui"];
                        $modelser->jmlprint = 1;

                        if($modelser->validate())
                        {
                            $modelser->save();
                            //$this->redirect();
                        } else {
                            Yii::app()->user->setFlash('status','Surel tidak valid !');
                        }
                    }
                }

            }
            $this->render('_formMutasi',array(
                'modelser'=>$modelser,
                'modelse'=>$modelse,
                'modeljs'=>$modeljs,
                'model'=>$model,
                'modelm'=>$modelm,
            ));
        }

    public function actionPrintMutasi($idMutasi,$idSurel)
    {
        $judulLaporan='Surat_Mutasi';
        $model = KMutasiR::model()->findByPk($idMutasi);
        $modSurel = KSuratelektronikR::model()->findByPk($idSurel);

        if(isset($_POST["PRINT"])) {
            $this->layout='//layouts/printWindows';
            $this->render('PrintMutasi',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
        }
        else if(isset($_POST["EXCEL"])) {
            $this->layout='//layouts/printExcel';
            $this->render('PrintMutasi',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
        }
        else if(isset($_POST["PDF"])) {
            $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
            $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
            $mpdf = new MyPDF('',$ukuranKertasPDF); 
            $mpdf->useOddEven = 2;  
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
            $mpdf->WriteHTML($this->renderPartial('PrintMutasi',array('modSurel'=>$modSurel,'model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
            $mpdf->Output();
        } 
    }

     public function actionCuti($id)
     {
        if(Yii::app()->request->isAjaxRequest)
        $this->layout = '//layouts/polos';
        $model=KKaryawanM::model()->findByPk($id);
        $modelc=new KCutikaryawanR;
        $indexTab=3;
        if(isset($_POST['KCutikaryawanR']))
        {
            $modelc->attributes=$_POST['KCutikaryawanR'];
            $modelc->karyawan_id = $_POST['karyawan_id'];
            $nourut = count(KCutikaryawanR::model()->findAllByAttributes(array('karyawan_id'=>$modelc->karyawan_id)))+1;
            $modelc->nourutcuti = $nourut;
           // $modelc->nourutcuti = count(KCutikaryawanR::model()->findByPk($karyawan_id)+1);
            CActiveForm::validate($modelc);
            if($modelc->validate()){
                $modelc->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
            }
        }
        $this->render('_formCuti',array(
            'model'=>$model,
            'modelc'=>$modelc,
            'id'=>$id,
        ));
    }

    public function actionJenjangKarir($id)
    {
        if(Yii::app()->request->isAjaxRequest)
        $this->layout = '//layouts/polos';
        $model=KKaryawanM::model()->findByPk($id);
        $modeljk=new KJenjangkarirR;
        $indexTab=4;
        if(isset($_POST['KJenjangkarirR']))
        {
            $modeljk->attributes=$_POST['KJenjangkarirR'];
            $modeljk->karyawan_id = $_POST['karyawan_id'];
            $nourut = count(KJenjangkarirR::model()->findAllByAttributes(array('karyawan_id'=>$modeljk->karyawan_id)))+1;
            $modeljk->nourutjenjangkarir = $nourut;
            
             if($modeljk->validate()){
                $modeljk->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
             }else{
                 CActiveForm::validate($modeljk);
             }
        }
        $this->render('_formJenjangKarir',array(
            'model'=>$model,
            'modeljk'=>$modeljk,
            'id'=>$id,
        ));
    }

    public function actionKontrak($id)
    {
        if(Yii::app()->request->isAjaxRequest)
        $this->layout = '//layouts/polos';
        $modelkar = KKaryawanM::model()->findAll();
        $model=KKaryawanM::model()->findByPk($id);
        $modelkk  = new KKontrakkaryawanR;
        $modeljs  = KJenissuratM::model()->findByPk(3);
        $modelse  = KSuratelektronikR::model()->findAll();
        $nosurat = count(KSuratelektronikR::model()->findAll())+1;
        $modelkk->nosuratkontrak= $modeljs->jenissurat_no."/".date('m')."/".date('Y')."/".str_pad($nosurat,3,00,STR_PAD_LEFT);
        $modelser = array();
        if(isset($_POST['KKontrakkaryawanR']))
        {
            $modelkk->attributes=$_POST['KKontrakkaryawanR'];

            $modelkk->karyawan_id = $_POST['karyawan_id'];
            $nourut = count(KKontrakkaryawanR::model()->findAllByAttributes(array('karyawan_id'=>$modelkk->karyawan_id)))+1;
            $modelkk->nourutkontrak = $nourut;
            
            $valid=$modelkk->validate();
            if($valid){
                if($modelkk->save())
                {
                    $modelkk->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                    $modelser = new KSuratelektronikR;
                    $nosuratelektronik = count(KSuratelektronikR::model()->findAll())+1;
                    $modelser->nosurat = $modelkk->nosuratkontrak;
                    $modelser->tglsurat = $modelkk->tglkontrak;
                    $modelser->judulsurat = $modeljs->jenissurat_judul;
                    $modelser->urutan = $nosuratelektronik;
                    $modelser->jenissurat_id = $modeljs->jenissurat_id;
                    $modelser->mengetahui = $_POST["mengetahui"];
                    $modelser->jmlprint = 1;
                    
                    
                    if($modelser->validate())
                    {
                        $modelser->save();
                        //$this->redirect();
                    } else {
                        Yii::app()->user->setFlash('status','Surel tidak valid !');
                    }
                }
            } else{
                
            CActiveForm::validate($modelkk);
            }  

       }              
        $this->render('_formKontrakKerja',array(    
                'modelser'=>$modelser,
                'modeljs'=>$modeljs,
                'model'=>$model,
                'modelkk'=>$modelkk,
                'modelse'=>$modelse,
                'modelkar'=>$modelkar,
        ));
    }

    public function actionPrintKontrak($idKontrak,$idSurel)
    {
        if(Yii::app()->request->isAjaxRequest)
        $judulLaporan='Surat_Kontrak';
        $model = KKontrakkaryawanR::model()->findByPk($idKontrak);
        $modSurel = KSuratelektronikR::model()->findByPk($idSurel);

        if(isset($_POST["PRINT"])) {
            $this->layout='//layouts/printWindows';
            $this->render('PrintKontrak',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
        }
        else if(isset($_POST["EXCEL"])) {
            $this->layout='//layouts/printExcel';
            $this->render('PrintKontrak',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
        }
        else if(isset($_POST["PDF"])) {
            $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
            $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
            $mpdf = new MyPDF('',$ukuranKertasPDF); 
            $mpdf->useOddEven = 2;  
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
            $mpdf->WriteHTML($this->renderPartial('PrintKontrak',array('modSurel'=>$modSurel,'model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
            $mpdf->Output();
        } 
    }

    public function actionPrintkontrakkerja()
    {
            $judulLaporan='Kontrak Kerja';
            $caraPrint=$_REQUEST['caraPrint'];
            if($caraPrint=='PRINT') {
                $this->layout='//layouts/printWindows';
                $this->render('Printkontrakkerja',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($caraPrint=='EXCEL') {
                $this->layout='//layouts/printExcel';
                $this->render('Printkontrakkerja',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($_REQUEST['caraPrint']=='PDF') {
                $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                $mpdf = new MyPDF('',$ukuranKertasPDF); 
                $mpdf->useOddEven = 2;
                $styletable = file_get_contents(Yii::getPathOfAlias('webroot.css.core') . '/table.css');
                $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css'). '/mws.style.css');  
                $mpdf->writeHtml($styletable,1);
                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                $mpdf->WriteHTML($this->renderPartial('Printkontrakkerja',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                $mpdf->Output();
            }                       
        }

    public function actionPrestasiKerja($id)
    {
        if(Yii::app()->request->isAjaxRequest)
        $this->layout = '//layouts/polos';
        $model=KKaryawanM::model()->findByPk($id);
        $modelpresk=new KPrestasikerjaR;
        if(isset($_POST['KPrestasikerjaR']))
        {
            $modelpresk->attributes=$_POST['KPrestasikerjaR'];
            $modelpresk->karyawan_id = $_POST['karyawan_id'];
            $nourut = count(KPrestasikerjaR::model()->findAllByAttributes(array('karyawan_id'=>$modelpresk->karyawan_id)))+1;
            $modelpresk->nourutprestasi = $nourut;
            CActiveForm::validate($modelpresk);
             if($modelpresk->validate()){
                $modelpresk->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
            }
        }
        $this->render('_formPrestasiKerja',array(
            'model'=>$model,
            'modelpresk'=>$modelpresk,
        ));
    }
    
    public function actiondeletePendidikan($karyawan_id, $id)
    {
        $modPendidikankaryawan = PendidikankaryawanR::model();
        if ($modPendidikankaryawan->deleteByPK($id)) {
            $this->redirect(array('index','id'=>$karyawan_id));
        }
    }
    
    public function actiondeletePengalamankerja($karyawan_id, $id)
    {
        $modPengalamankerja = PengalamankerjaR::model();
        if ($modPengalamankerja->deleteByPK($id)) {
            $this->redirect(array('index','id'=>$karyawan_id));
        }
    }
    
    public function actiondeleteMutasi($karyawan_id, $id)
    {
        $modMutasi = MutasiR::model();
        if ($modMutasi->deleteByPK($id)) {
            $this->redirect(array('index','id'=>$karyawan_id));
        }
    }
    
    public function actiondeleteCutikaryawan($karyawan_id, $id)
    {
        $modCutikaryawan = CutikaryawanR::model();
        if ($modCutikaryawan->deleteByPK($id)) {
            $this->redirect(array('index','id'=>$karyawan_id));
        }
    }
    
    public function actiondeleteKarykomponen($karyawan_id, $id)
    {
        $modKarykomponen = KarykomponenM::model();
        if ($modKarykomponen->deleteAllByAttributes(array('tglberlaku'=>$id,'karyawan_id'=>$karyawan_id))) {
            $this->redirect(array('index','id'=>$karyawan_id));
        }
    }
    
    public function actionSuratPeringatan($id)
    {
        if(Yii::app()->request->isAjaxRequest)
        $this->layout = '//layouts/polos';
        $modkaryawan = KaryawanM::model()->findAll();
        $model=KKaryawanM::model()->findByPk($id);
        $modelsp = new KSuratperingatanR;
        $modelser = new KSuratelektronikR;
        $modeljs = KJenissuratM::model()->findByPk(2);
        $modelse = KSuratelektronikR::model()->findAll();
        $nosurat = count(KSuratelektronikR::model()->findAll())+1;
        $modelsp->nosuratperingatan= $modeljs->jenissurat_no."/".date('m')."/".date('Y')."/".str_pad($nosurat,3,00,STR_PAD_LEFT);

        if(isset($_POST['KSuratperingatanR']))
        {
            $modelsp->attributes=$_POST['KSuratperingatanR'];
            $modelsp->karyawan_id = $_POST['karyawan_id'];

             $valid=$modelsp->validate();
            if($valid){
                if($modelsp->save())
                {
                    $modelsp->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                    $modelser = new KSuratelektronikR;
                    $nosuratelektronik = count(KSuratelektronikR::model()->findAll())+1;
                    $modelser->nosurat = $modelsp->nosuratperingatan;
                    $modelser->tglsurat = $modelsp->tglsuratperingatan;
                    $modelser->judulsurat = $modeljs->jenissurat_judul;
                    $modelser->urutan = $nosuratelektronik;
                    $modelser->jenissurat_id = $modeljs->jenissurat_id;
                    $modelser->mengetahui =$_POST["mengetahui"];
                    $modelser->jmlprint = 1;

                    if($modelser->validate())
                    {
                        $modelser->save();
                        //$this->redirect();
                    } else {
                        Yii::app()->user->setFlash('status','Surel tidak valid !');
                    }
                }
            }   else{
                CActiveForm::validate($modelsp);
            }

       }
        
        $this->render('_formSuratPeringatan',array( 
            'modelser'=>$modelser,
            'modelse'=>$modelse,
            'modeljs'=>$modeljs,
            'model'=>$model,
            'modelsp'=>$modelsp,
            'modkaryawan'=>$modkaryawan,
        ));
     }
     
     public function monthDifference($start_date, $end_date)  
     {  
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);

        // takes remaning seconds to find months  2629743.83 seconds each month  
        $months = floor(($end_date - $start_date) / 2629743.83);

        return $months;  
     }
  
     public function actionKomponengaji($id)
     {
         if (Yii::app()->request->isAjaxRequest)
             $this->layout = '//layouts/polos';
             $gaji = 0;
             $modKaryawan = KKaryawanM::model()->findByPK($id);
             $lamaBlnKerja = $this->monthDifference($modKaryawan->tglditerima, date('Y-m-d'));
             $masterGaji = MastergajiM::model()->findByAttributes(array('lama_bln'=>$lamaBlnKerja));
             if(isset($masterGaji)){
                $gaji = $masterGaji->gajipokok;
             }else{
                $gaji = 0;
             }
             $gaji1bln = MastergajiM::model()->findByAttributes(array('lama_bln'=>1));
             $gajiPokok = number_format($gaji);
             $gaji = number_format($gajiPokok);
//             echo $gaji1bln->gajipokok;
//             echo $gajiPokok;
             
             $modKomponengaji = new KomponengajiM;
             $number = 1000;
             $money = number_format($number);
//             echo $money;
//             
             $cek = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id));
             if (COUNT($cek) < 1) {
             $modKarykomponen = new KarykomponenM;
             $modKarykomponen->tglberlaku = date('Y-m-d H:i:s');
            
             
             } else {
                $modKarykomponen = $cek;
             }
            if(isset($_POST['komponengaji_id']) || isset($_POST['jumlah']))
            {
//                echo "<pre>";
//                print_r($_POST);exit;
                KarykomponenM::model()->deleteAllByAttributes(array('karyawan_id'=>$id,'tglberlaku'=>$_POST['KarykomponenM']['tglberlaku']));
                for ($n=0;$n<COUNT($_POST['komponengaji_id']);$n++)
                {
                    $cekkomponengaji = KarykomponenM::model()->findByAttributes(array('karyawan_id'=>$id,'komponengaji_id'=>$_POST['komponengaji_id'][$n],'tglberlaku'=>$_POST['KarykomponenM']['tglberlaku']));
//                    if (COUNT($cekkomponengaji) > 0) {
//                            $modKarykomponen = KarykomponenM::model()->findByPK($cekkomponengaji->karykomponen_m);
//                         } else {
//                            $modKarykomponen = new KarykomponenM;
//                            $modKarykomponen->tglberlaku = date('Y-m-d');
//                         }
                                $modKarykomponen = new KarykomponenM;
                                $modKarykomponen->tglberlaku = date('Y-m-d');
                                $komponengaji_id = $_POST['komponengaji_id'][$n];
                                $modKarykomponen->karyawan_id = $id;
                                $modKarykomponen->komponengaji_id = $komponengaji_id;
//                                $jumlah = isset($_POST['jumlah'][$komponengaji_id]) ? $_POST['jumlah'][$komponengaji_id] : 0;
                                $jumlah = isset($_POST['total'][$komponengaji_id]) ? $_POST['total'][$komponengaji_id] : 0;
                                $modKarykomponen->jumlah = Params::formatNumberForDB($jumlah);
                    
//                    CActiveForm::validate($modKarykomponen);
                    if ($modKarykomponen->validate()) {
                        $modKarykomponen->save();
                        
                    } else {
                        Yii::app()->user->setFlash('status','Data gagal tersimpan');
                    }
                }
                
                    $this->redirect(array('index','id'=>$id));
            }
             
             $this->render('_formKomponengaji',array(
                 'modKomponengaji'=>$modKomponengaji,
                 'modKarykomponen'=>$modKarykomponen,
                 'masterGaji'=>$masterGaji,
                 'gaji1bln'=>$gaji1bln,
             ));
     }

    public function actionPrintsuratperingatan()
    {
            $model = new KSuratperingatanR;
            $model->nosuratperingatan = $_GET['KSuratperingatanR']['nosuratperingatan'];
            $model->karyawan_id = $_GET['id'];
            $modSurel = new KSuratelektronikR;
            $modSurel->jenissurat_id =$_GET['KJenissuratM']['jenissurat_id'];
            $judulLaporan='Surat Peringatan';
            $caraPrint=$_REQUEST['caraPrint'];
            if($caraPrint=='PRINT') {
                $this->layout='//layouts/printWindows';
                $this->render('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($caraPrint=='EXCEL') {
                $this->layout='//layouts/printExcel';
                $this->render('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($_REQUEST['caraPrint']=='PDF') {
                $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                $mpdf = new MyPDF('',$ukuranKertasPDF); 
                $mpdf->useOddEven = 2;
                $styletable = file_get_contents(Yii::getPathOfAlias('webroot.css.core') . '/table.css');
                $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css'). '/mws.style.css');  
                $mpdf->writeHtml($styletable,1);
                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                $mpdf->WriteHTML($this->renderPartial('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                $mpdf->Output();
            }                       
        }
        
//     public function actionPrintPeringatan()
//     {//echo '<pre>'.  print_r($_POST,1).'</pre>';exit;
//        //if(Yii::app()->request->isAjaxRequest)
//        $judulLaporan='Surat_Peringatan';
//        $model = (!empty($idPeringatan)) ? KSuratperingatanR::model()->findByPk(1) : new KSuratperingatanR;
//        $modSurel = (!empty($idSurel)) ? KSuratelektronikR::model()->findByPk(1) : new KSuratelektronikR;
//
//        if(isset($_POST["PRINT"])) {
//            $this->layout='//layouts/printWindows';
//            $this->render('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
//        }
//        else if(isset($_POST["EXCEL"])) {
//            $this->layout='//layouts/printExcel';
//            $this->render('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
//        }
//        else if(isset($_POST["PDF"])) {
//            $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
//            $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
//            $mpdf = new MyPDF('',$ukuranKertasPDF); 
//            $mpdf->useOddEven = 2;  
//            $mpdf->WriteHTML($stylesheet,1);
//            $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
//            $mpdf->WriteHTML($this->renderPartial('PrintSp',array('modSurel'=>$modSurel,'model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
//            $mpdf->Output();
//        } 
//     }
}

    