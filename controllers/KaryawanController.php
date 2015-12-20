<?php

class KaryawanController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','print',
                                                'lihatRiwayat','kelolaKaryawan','pendidikanKaryawan','finger',
                                                'pengalamanKerja','mutasi','cuti','kontrak','suratPeringatan',
                                                'prestasiKerja','manageKaryawan','jenjangKarir','ajaxKaryawanBerhenti',
                                                'ajaxAddKaryawanBerhenti','PrintKontrak','PrintMutasi','PrintPeringatan','Printview'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new KKaryawanM;
                $model->propinsi_id = Params::DEFAULT_PROPINSI_ID;
                $model->kabupatenkota_id = Params::DEFAULT_KABUPATEN_ID;
                $model->lokasi_id = Params::DEFAULT_LOKASI;
                $model->warganegara_karyawan = Params::DEFAULT_WARGA_NEGARA;
                $model->tglditerima = date('Y-m-d');
                // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KKaryawanM']))
		{
                      $random = rand(000000, 999999);
                      $model->attributes=$_POST['KKaryawanM'];
                      $model->create_user_id = Yii::app()->session['loginpemakai_id'];
                      $model->create_time = date('Y-m-d H:m:s');
                      $model->photo_karyawan = CUploadedFile::getInstance($model, 'photo_karyawan');
                      $gambar=$model->photo_karyawan;
                      $model->tglditerima = date('Y-m-d h:i:s');
//                      $model->tgllahir_karyawan = date('Y-m-d');
                      $model->karyawan_aktif = true;
                      
                      if(!empty($model->photo_karyawan))//Klo User Memasukan Logo
                      { 
                            
                            $model->photo_karyawan =$random.$model->photo_karyawan;

                            Yii::import("ext.EPhpThumb.EPhpThumb");

                             $thumb=new EPhpThumb();
                             $thumb->init(); // this is needed
                             $fullImgName =$model->photo_karyawan;   
                             $fullImgSource = Params::pathKaryawanDirectory().$fullImgName;
                             $fullThumbSource = Params::pathKaryawanThumbsDirectory().'kecil_'.$fullImgName;
                             if($model->validate()){   
                                    
                                        
                                 if($model->save())
                                 {
                                       if (!empty($model->no_fingerprint)){
                                           $this->insertData($model);
                                       }
                                       $gambar->saveAs($fullImgSource);
                                       $thumb->create($fullImgSource)
                                             ->resize(200,200)
                                             ->save($fullThumbSource);
                                       $this->redirect(array('view','id'=>$model->karyawan_id));
                                 }
                             }

                      }else{
                          if($model->validate()){   
                                
                              if($model->save())
                                  {
                                       if (!empty($model->no_fingerprint)){
                                           $this->insertData($model);
                                       }
                                       $this->redirect(array('admin'));
                                  }
                            }
                      } 
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        protected function insertData($model){
            $IP = Params::IP_FINGER_PRINT;
            $Key = Params::KEY_FINGER_PRINT;
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if($Connect){
                $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg>
                        <PIN>".$model->no_fingerprint."</ PIN>
                        <Name>".$model->nama_karyawan."</Name>
                        </Arg></SetUserInfo>";
		$newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
                $buffer=$this->ParseData($buffer,"<Information>","</Information>");
                if ($buffer == 'Successfully!'){
                    return true;
                }
                else{
                    return false;
                }
                
            }else{
                return false;
            }
        }
        
        protected function deleteData($model){
            $IP = Params::IP_FINGER_PRINT;
            $Key = Params::KEY_FINGER_PRINT;
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if($Connect){
                $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg>
                        <PIN>".$model->no_fingerprint."</ PIN>
                        <Name>".$model->nama_karyawan."</Name>
                        </Arg></SetUserInfo>";
		$newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
                $buffer=$this->ParseData($buffer,"<Information>","</Information>");
                if ($buffer == 'Successfully!'){
                    return true;
                }
                else{
                    return false;
                }
                
            }else{
                return false;
            }
        }
        
        protected function getData($model){
            $IP = Params::IP_FINGER_PRINT;
            $Key = Params::KEY_FINGER_PRINT;
            $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
            if($Connect){
                $soap_request="<GetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>All</PIN></Arg></GetUserInfo>";
		$newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
                
                $buffer=$this->ParseData($buffer,"<GetUserInfoResponse>","</GetUserInfoResponse>");
                echo $buffer;
            }else{
                return false;
            }
        }
        
        protected function ParseData($data,$p1,$p2){
            $data=" ".$data;
            $hasil="";
            $awal=strpos($data,$p1);
            if($awal!=""){
                    $akhir=strpos(strstr($data,$p1),$p2);
                    if($akhir!=""){
                            $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
                    }
            }
            return $hasil;	
        }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                
                                /* penyesuaian format date dari db ke data yang ditampilkan ke user*/
                
                                $format = new CustomFormat();    
                                empty($model->tglditerima)?$model->tglditerima = null :$model->tglditerima = $format->formatDbtoDate($model->tglditerima);
                                empty($model->tglkeluar)?$model->tglkeluar = null :$model->tglkeluar = $format->formatDbtoDate($model->tglkeluar);
                                empty($model->tgllahir_karyawan)?$model->tgllahir_karyawan = null:$model->tgllahir_karyawan = $format->formatDbtoDate($model->tgllahir_karyawan);
//                                $tempcreatetime = $model->create_time;
                                /*---------------------------------------------------------------------------------------------------------*/
                                
                                $temLogo = $model->photo_karyawan;  
                                

		if(isset($_POST['KKaryawanM']))
		{
                                                
                                                $random=rand(0000000,9999999);
                                                
			$model->attributes=$_POST['KKaryawanM'];
                                                $model->photo_karyawan = CUploadedFile::getInstance($model, 'photo_karyawan');
                                                $gambar=$model->photo_karyawan;
                                               
                                                empty($model->tglditerima)?$model->tglditerima = null :$model->tglditerima = $format->formatDateForDb($model->tglditerima);
                                                empty($model->tglkeluar)?$model->tglkeluar = null :$model->tglkeluar = $format->formatDateForDb($model->tglkeluar);
                                                empty($model->tgllahir_karyawan)?$model->tgllahir_karyawan = null:$model->tgllahir_karyawan = $format->formatDateForDb($model->tgllahir_karyawan);
//                                                print_r($model->create_time);exit;   
                                                
                                                if(!empty($model->photo_karyawan))//Klo User Memasukan Logo
                                                  { 

                                                        $model->photo_karyawan =$random.$model->photo_karyawan;

                                                        Yii::import("ext.EPhpThumb.EPhpThumb");

                                                         $thumb=new EPhpThumb();
                                                         $thumb->init(); //this is needed

                                                         $fullImgName =$model->photo_karyawan;   
                                                         $fullImgSource = Params::pathKaryawanDirectory().$fullImgName;
                                                         $fullThumbSource = Params::pathKaryawanDirectory().'kecil_'.$fullImgName;

                                                         if($model->save())
                                                              {
                                                             if (!empty($model->no_fingerprint)){
                                                                   $this->insertData($model);
                                                               }
                                                                      if(!empty($temLogo))
                                                                        { 
                                                                           unlink(Params::pathKaryawanDirectory().$temLogo);
                                                                           unlink(Params::pathKaryawanDirectory().'kecil_'.$temLogo);
                                                                        }
                                                                   $gambar->saveAs($fullImgSource);
                                                                   $thumb->create($fullImgSource)
                                                                         ->resize(200,200)
                                                                         ->save($fullThumbSource);
                                                                   $this->redirect(array('view','id'=>$model->karyawan_id));
                                                              }
                                                          else
                                                              {
                                                                   Yii::app()->user->setFlash('error', 'Data <strong>Gagal!</strong>  disimpan.');
                                                              }
                                                    }else{
                                                             
//                                                            $model->create_time = $format->formatDbToDateTime($model->create_time);
                                                            $model->photo_karyawan = $temLogo;
//                                                            exit();
                                                            if ($model->validate()){
                                                                if($model->save()){
                                                                    if (!empty($model->no_fingerprint)){
                                                                       $this->insertData($model);
                                                                   }
                                                                   $this->redirect(array('admin','id'=>$model->karyawan_id));
                                                                }
                                                            }
				
                                                    }
                                                    
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
                                                $img = $model->photo_karyawan;
                                                if($model->delete()){
                                                        if(file_exists(Params::urlIconModulDirectory().$img) && file_exists(Params::urlIconModulThumbsDirectory().'kecil_'.$img) && $img != null ){
                                                            unlink(Params::urlIconModulDirectory().$img);
                                                            unlink(Params::urlIconModulThumbsDirectory().'kecil_'.$img);
                                                        }
                                                }
                                                
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('KKaryawanM');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KKaryawanM('search');
                                $modelsb = new KStatusberhentiM;
                                $modelkb = new KKaryawanberhentiR;
                
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KKaryawanM']))
			$model->attributes=$_GET['KKaryawanM'];

		$this->render('admin',array(
			'model'=>$model,
                        'modelsb'=>$modelsb,
                        'modelkb'=>$modelkb,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=KKaryawanM::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sakaryawan-m-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                
                
        public function actionPrintview($id)
        {
            $model = $this->loadModel($id);
            $model->attributes=$_REQUEST['KKaryawanM'];
            $judulLaporan='Data Karyawan';
            $caraPrint=$_REQUEST['caraPrint'];
            if($caraPrint=='PRINT') {
                $this->layout='//layouts/printWindows';
                $this->render('Printview',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($caraPrint=='EXCEL') {
                $this->layout='//layouts/printExcel';
                $this->render('Printview',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($_REQUEST['caraPrint']=='PDF') {
                $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                $mpdf = new MyPDF('',$ukuranKertasPDF); 
                $mpdf->useOddEven = 2;
                $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css'). '/core/table.css');
                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                $mpdf->WriteHTML($this->renderPartial('Printview',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                $mpdf->Output();
            }                       
        }
                
                
                
        public function actionPrint()
        {
            $model= new KKaryawanM;
            $model->attributes=$_REQUEST['KKaryawanM'];
            $judulLaporan='Rekapitulasi Data Karyawan';
            $caraPrint=$_REQUEST['caraPrint'];
            if($caraPrint=='PRINT') {
                $this->layout='//layouts/printWindows';
                $this->render('PrintKaryawan',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($caraPrint=='EXCEL') {
                $this->layout='//layouts/printExcel';
                $this->render('PrintKaryawan',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($_REQUEST['caraPrint']=='PDF') {
                $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                $mpdf = new MyPDF('',$ukuranKertasPDF); 
                $mpdf->useOddEven = 2;  
                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                $mpdf->WriteHTML($this->renderPartial('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                $mpdf->Output();
            }                       
        }
                
              
                public function actionPendidikanKaryawan($id)
                {
                    //$this->layout = '//layouts/polos';
                    $model = $this->loadModel($id);
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
                        }
                        
                    }
                    $this->render('_formPendidikan',array(
                                                        'model'=>$model,
                                                        'modelp'=>$modelp,
                                                        'modelpro'=>$modelpro,
                                                        'modelkab'=>$modelkab,
                                                        'indexTab'=>$indexTab,
                                                        'id'=>$id,
                        ));
                }
                
                public function actionPengalamanKerja($id)
                {
                    $model = $this->loadModel($id);
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
                                                                'modelpk'=>$modelpk,
                                                                'id'=>$id,
                                                                'indexTab'=>$indexTab,
                        ));
                }
                
                public function actionMutasi($id)
                {
                    $model = $this->loadModel($id);
                    $modelm   = new KMutasiR;
                    $indexTab = 2;
                    $modeljs  = KJenissuratM::model()->findByPk(Params::JENISSURAT_MUTASI_ID);
                    $modelse  = KSuratelektronikR::model()->findAll();
                    $nosurat = count(KSuratelektronikR::model()->findAll())+1;
                    $modelm->mutasi_nomorsurat= $modeljs->jenissurat_no."/".date('m')."/".date('Y')."/".str_pad($nosurat,3,00,STR_PAD_LEFT);
                    
                    if(isset($_POST['KMutasiR']))
                    {
                        $modelm->attributes=$_POST['KMutasiR'];
                        
                        $modelm->karyawan_id = $_POST['karyawan_id'];
                        $modelser->jenissurat_id = $_POST['jenissurat_id'];
                        
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
                    $this->render('_formMutasi',array('modelser'=>$modelser,
                                                       'modelse'=>$modelse,
                                                        'modeljs'=>$modeljs,
                                                        'model'=>$model,
                                                        'modelm'=>$modelm,
                                                        'id'=>$id,
                                                        'indexTab'=>$indexTab,
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
                    $model = $this->loadModel($id);
                    $modelc=new KCutikaryawanR;
                    $indexTab=3;
                    if(isset($_POST['KCutikaryawanR']))
                    {
                        $modelc->attributes=$_POST['KCutikaryawanR'];
                        $modelc->karyawan_id = $_POST['karyawan_id'];
                        $nourut = count(KCutikaryawanR::model()->findAllByAttributes(array('karyawan_id'=>$modelc->karyawan_id)))+1;
                        $modelc->nourutcuti = $nourut;
                       // $modelc->nourutcuti = count(KCutikaryawanR::model()->findByPk($karyawan_id)+1);
                        if($modelc->validate()){
                            $modelc->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                        }
                    }
                    $this->render('_formCuti',array(
                                                                'model'=>$model,
                                                                'modelc'=>$modelc,
                                                                'id'=>$id,
                                                                'indexTab'=>$indexTab,
                    ));
                }
                
                public function actionJenjangKarir($id)
                {
                    $model = $this->loadModel($id);
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
                         }
                    }
                    $this->render('_formJenjangKarir',array(
                                                                'model'=>$model,
                                                                'modeljk'=>$modeljk,
                                                                'id'=>$id,
                                                                'indexTab'=>$indexTab,
                    ));
                }
                
                 public function actionKontrak($id)
                {
                     $modelkar = KKaryawanM::model()->findAll();
                    $model    = $this->loadModel($id);
                    $modelkk  = new KKontrakkaryawanR;
                    $modeljs  = KJenissuratM::model()->findByPk(3);
                    $modelse  = KSuratelektronikR::model()->findAll();
                    $nosurat = count(KSuratelektronikR::model()->findAll())+1;
                    $modelkk->nosuratkontrak= $modeljs->jenissurat_no."/".date('m')."/".date('Y')."/".str_pad($nosurat,3,00,STR_PAD_LEFT);

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


                public function actionPrestasiKerja($id)
                {
                    $model = $this->loadModel($id);
                    $modelpresk=new KPrestasikerjaR;
                    if(isset($_POST['KPrestasikerjaR']))
                    {
                        $modelpresk->attributes=$_POST['KPrestasikerjaR'];
                        $modelpresk->karyawan_id = $_POST['karyawan_id'];
                        $nourut = count(KPrestasikerjaR::model()->findAllByAttributes(array('karyawan_id'=>$modelpresk->karyawan_id)))+1;
                        $modelpresk->nourutprestasi = $nourut;
                         if($modelpresk->validate()){
                            $modelpresk->save() == true? Yii::app()->user->setFlash('status','Berhasil disimpan !'):Yii::app()->user->setFlash('status','Gagal disimpan !');
                        }
                    }
                    $this->render('_formPrestasiKerja',array(
                                                                'model'=>$model,
                                                                'modelpresk'=>$modelpresk,
                    ));
                }
                
                public function actionSuratPeringatan($id)
                {
                    $modkaryawan = KaryawanM::model()->findAll();
                    $model = $this->loadModel($id);
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
                        }   

                   }
                       
                    $this->render('_formSuratPeringatan',array( 'modelser'=>$modelser,
                                                                'modelse'=>$modelse,
                                                                'modeljs'=>$modeljs,
                                                                'model'=>$model,
                                                                'modelsp'=>$modelsp,
                                                                'modkaryawan'=>$modkaryawan,
                    ));
                }
                
                 public function actionPrintPeringatan($idPeringatan,$idSurel)
                {
                    $judulLaporan='Surat_Peringatan';
                    $model = KSuratperingatanR::model()->findByPk($idPeringatan);
                    $modSurel = KSuratelektronikR::model()->findByPk($idSurel);
                   
                    if(isset($_POST["PRINT"])) {
                        $this->layout='//layouts/printWindows';
                        $this->render('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }
                    else if(isset($_POST["EXCEL"])) {
                        $this->layout='//layouts/printExcel';
                        $this->render('PrintSp',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
                    }
                    else if(isset($_POST["PDF"])) {
                        $ukuranKertasPDF = Yii::app()->session['ukuran_kertas'];                  // Ukuran Kertas Pdf
                        $posisi = Yii::app()->session['posisi_kertas'];                                      // Posisi L->Landscape,P->Portait
                        $mpdf = new MyPDF('',$ukuranKertasPDF); 
                        $mpdf->useOddEven = 2;  
                        $mpdf->WriteHTML($stylesheet,1);
                        $mpdf->AddPage($posisi,'','','','',15,15,15,15,15,15);
                        $mpdf->WriteHTML($this->renderPartial('PrintSp',array('modSurel'=>$modSurel,'model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint),true));
                        $mpdf->Output();
                    } 
                }

                
                public function actionAjaxKaryawanBerhenti(){
                     if (Yii::app()->getRequest()->getIsAjaxRequest()) 
                     { 
                         $modelsb = new KStatusberhentiM;
                         $modelkb = new KKaryawanberhentiR;
                         $transaksi = Yii::app()->db->beginTransaction();
                        
                             $modelsb->statusberhenti_aktif = 1;
                             $modelkb->attributes = $_POST['KKaryawanberhentiR'];
                             $modelkb->karyawan_id = $_POST['KKaryawanM']['karyawan_id'];
                             if($modelsb->save){
                                 $modelkb->statusberhenti_id = $modelsb->statusberhenti_Id;
                                 if($modelkb->save()){
                                     
                                     $transaksi->commit();
                                     $data['status'] = 'Berhasil di save!';
                                     
                                 }else{
                                     $transaksi->rollback();
                                     $data['status'] = 'Gagal di save !';
                                 }
                             }else{
                                    $data['status'] = 'Gagal di save !';
                             }//catch(Exception $e){
                               //  $transaksi->rollback();
                               //  $data['status'] = 'Gagal di save !';
                            // }
                         echo json_encode($data);
                         Yii::app()->end();
                     }
                }
                
                public function actionAjaxAddKaryawanBerhenti()
                {
                        
                            empty($id)?$id = $_POST['karyawan_id']:$id;
                            $model= $this->loadModel($id);
                            $modelkb = new KKaryawanberhentiR;
                            $datas = array($model,$modelkb);
                            $url = Yii::app()->createUrl($this->module->id.'/'.$this->id.'/admin');
                            $jsReload = '<script>$(document).ready(function(){window.top.location.href = "'.$url.'";});</script>';
                            if(isset($_POST['KKaryawanberhentiR'])){
                                $format = new CustomFormat();   
                                $modelkb->attributes= $_POST['KKaryawanberhentiR'];
                                $modelkb->karyawan_id =$id;
//                                $modelkb->tglberhenti = $format->formatDateForDb($modelkb->tglberhenti);
                                
                                if($modelkb->validate()){
                                    if($modelkb->save()){
                                        
                                        //$model->statusberhenti_id = $modelkb->statusberhenti_id;
                                        $model->karyawanberhenti_id = $modelkb->karyawanberhenti_id;
                                        $model->karyawan_aktif= 0;
                                        
                                        $model->save()?$status = $jsReload :$status = 'data gagal disimpan';
                                        
                                    }
                                     if (Yii::app()->request->isAjaxRequest){
                                       
                                     echo CJSON::encode(array(
                                                    'status'=>'proses_form', 
                                                    'div'=>"<div class='flash-success'>".$status." </div>",
                                                    'id'=>$modelkb->karyawan_id,
                                                    )
                                    );
                                    Yii::app()->end();
                                   }
                                }
                            }
                             if (Yii::app()->request->isAjaxRequest){
                                 
                                echo CJSON::encode(array(
                                    'status'=>'form', 
                                   // 'div'=>$this->renderPartial('_formKaryawanBerhenti', array('model'=>$model, 'modelkb'=>$modelkb),true),
                                    'datas'=>$datas,
                                    )
                                ); 
                                Yii::app()->end();  
                             }
                }
                
                
                public function actionLihatRiwayat($id){
                        $file = Yii::app()->basePath.'/images/icon_modul/test.pdf';
                        if(file_exists($file)){
                            
                       
                        $filename = 'Custom file name for the.pdf'; /* Note: Always use .pdf at the end. */
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="' . $filename . '"');
                        header('Content-Transfer-Encoding: binary');
                        header('Content-Length: ' . filesize($file));
                        header('Accept-Ranges: bytes');

                        @readfile($file);   
                        }else{
                            print_r($file);exit();
                        }
                }
                
                public function actionFindKaryawan()
	{
            if(Yii::app()->request->isAjaxRequest) {
                $criteria = new CDbCriteria();
                $criteria->compare('LOWER(nama_karyawan)', strtolower($_GET['term']), true);
                $criteria->order = 'nama_karyawan';
                $criteria->limit=10;
                $models = KKaryawanM::model()->findAll($criteria);
                foreach($models as $i=>$models)
                {
                    $attributes = $model->attributeNames();
                    foreach($attributes as $j=>$attribute) {
                        $returnVal[$i]['label'] = $models->karyawan_id.' - '.$models->nama_karyawan;
                        $returnVal[$i]['value'] = $models->nama_karyawan;
                        $returnVal[$i]["$attribute"] = $models->$attribute;
                    }
                }

                echo CJSON::encode($returnVal);
            }
            Yii::app()->end();
	}
        
        public function actionFinger($id){
            if (Yii::app()->request->isAjaxRequest){
                $data = $_POST['data'];
                $modKaryawan = KKaryawanM::model()->findByPk($id);
                $modKaryawan->no_fingerprint = $data;
                $modKaryawan->create_user_id = Yii::app()->session['loginpemakai_id'];
                if (!empty($data)){
                    if($modKaryawan->validate()){
                        if($modKaryawan->save())
                          {
                               if (!empty($modKaryawan->no_fingerprint)){
                                   $this->insertData($modKaryawan);
                               }
                               echo true;
                          }
                    }else{
                        echo 'No Fingerprint Tidak Valid';
                    }
                }
                else {
                    echo 'Kosong';
                }
            } 
        }
      
}

    