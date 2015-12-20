<?php

class PelamarController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete','print','penerimaanKaryawan','ajaxUpdate','updateCalonKaryawan'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionAjaxUpdate(){
                if(Yii::app()->getRequest()->getIsAjaxRequest()) {
                    $pelamar_id = $_POST['pelamar_id'];
                    $tglditerima = $_POST['tglditerima'];
                    $tglmulaibekerja = $_POST['tglmulaibekerja']; 
                    $stat = KPelamarT::model()->updateByPk($pelamar_id, array('tglditerima'=>$tglditerima, 'tglmulaibekerja'=>$tglmulaibekerja));

                    if($stat){
                        $data['status'] = 'true';
                    }else{
                        $data['status'] = 'false';
                    }
                    echo json_encode($data);
//                            echo json_encode(array("name"=>"John","time"=>"2pm"));
                    Yii::app()->end();
                }
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
//	public function actionCreate()
//	{
//		$model=new KPelamarT;
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//                               
//		if(isset($_POST['KPelamarT']))
//		{
//			$model->attributes=$_POST['KPelamarT'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->karyawan_id2));
//		}
//
//		$this->render('create',array(
//			'model'=>$model,
//		));
//	}
                public function actionPenerimaanKaryawan()
                {
		$model=new KPelamarT;
                $modelpro = PropinsiM::model()->findAll();
                $model->propinsi_id = Params::DEFAULT_PROPINSI_ID;
                $model->kabupatenkota_id = Params::DEFAULT_KABUPATEN_ID;
//                $model->lokasi_id = Params::DEFAULT_LOKASI;
                $model->warganegara_pelamar = Params::DEFAULT_WARGA_NEGARA;
                $model->tglditerima = date('Y-m-d');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['KPelamarT']))
		{
                                              $random = rand(000000, 999999);
                                              $model->attributes=$_POST['KPelamarT'];
                                              $model->karyawan_aktif = 1;
                                              $model->Create_User_Id = Yii::app()->session['loginpemakai_id'];
                                              $model->Create_Time = date('y-m-d H:m:s');
                                              $model->photopelamar = CUploadedFile::getInstance($model, 'photopelamar');
                                              $model->fileCV_Pelamar = CUploadedFile::getInstance($model, 'fileCV_Pelamar');
                                              
                                              $gambar=$model->photopelamar;
                                              $file = $model->fileCV_Pelamar;
                                              
                                        if(!empty($model->photopelamar))//Klo User Memasukan Logo
                                          { 
                                                
                                                $model->photopelamar =$random.$model->photopelamar;

                                                Yii::import("ext.EPhpThumb.EPhpThumb");

                                                 $thumb=new EPhpThumb();
                                                 $thumb->init(); // this is needed

                                                 $fullImgName =$model->photopelamar;   
                                                 $fullImgSource = Params::pathIconModulDirectory().$fullImgName;
                                                 $fullThumbSource = Params::pathIconModulThumbsDirectory().'kecil_'.$fullImgName;
                                                 
                                                 if($model->validate()){   
                                                         if($model->save())
                                                          {
                                                                $gambar->saveAs($fullImgSource);
                                                                if(isset($model->fileCV_Pelamar)){
                                                                     $file->saveAs(Params::pathIconModulDirectory().$model->fileCV_Pelamar);
                                                                }

                                                                $thumb->create($fullImgSource)
                                                                      ->resize(200,200)
                                                                      ->save($fullThumbSource);
                                                                $this->redirect(array('view','id'=>$model->pelamar_id));
                                                          }
                                                }
                                                  
                                          }else{
                                             if($model->validate()){   
                                                         if($model->save())
                                                          {
                                                                   $this->redirect(array('admin','id'=>$model->pelamar_id));
                                                          }
                                                }
                                          } 
                                      
		}
                                echo $model->tglmulaibekerja;
		$this->render('create',array(
			'model'=>$model,
                        'modelpro'=>$modelpro,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
        public function actionError(){
            exit();
        }
        
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
//                                $modelk = new KKaryawanM;
//                                $tempphoto = $model->photopelamar;
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['KPelamarT']))
//		{
//                                              $random = rand(000000, 999999);
//                                              $model->attributes=$_POST['KPelamarT'];
//                                              $modelk->Create_User_Id = $model->Create_User_Id = Yii::app()->session['loginpemakai_id'];
//                                              $modelk->Create_Time = $model->Create_Time = date('Y-m-d H:m:s');
//                                              $model->photopelamar = CUploadedFile::getInstance($model, 'photopelamar');
//                                              $model->fileCV_Pelamar = CUploadedFile::getInstance($model, 'fileCV_Pelamar');
//                                              
//                                              $gambar=$model->photopelamar;
//                                              $file = $model->fileCV_Pelamar;
//                                              
//                                              $modelk->attributes = $model->getAttributes();
//                                              $modelk->nama_karyawan = $model->nama_pelamar;
//                                              $modekl->tempatlahir_karyawan = $model->tempatlahir_pelamar;
//                                              $modelk->tgllahir_karyawan = $model->tgl_lahirpelamar;
//                                              $modelk->alamat_karyawan = $model->alamat_pelamar;
//                                              $modelk->nomobile_karyawan = $model->nomobile_pelamar;
//                                              $modelk->warganegara_karyawan = $model->warganegara_pelamar;
//                                              $modelk->photo_karyawan = $model->photopelamar;
//                                              
//                                        if(!empty($model->photopelamar))//Klo User Memasukan Logo
//                                          { 
//                                                
//                                                $model->photopelamar =$random.$model->photopelamar;
//                                                
//                                                Yii::import("ext.EPhpThumb.EPhpThumb");
//
//                                                 $thumb=new EPhpThumb();
//                                                 $thumb->init(); // this is needed
//
//                                                 $fullImgName =$model->photopelamar;   
//                                                 $fullImgSource = Params::pathIconModulDirectory().$fullImgName;
//                                                 $fullThumbSource = Params::pathIconModulThumbsDirectory().'kecil_'.$fullImgName;
//                                                 if($model->validate()){   
//                                                         if($model->save())
//                                                          {
//                                                                   $modelk->save();
//                                                                   $gambar->saveAs($fullImgSource);
//                                                                   $file->saveAs(Params::pathIconModulDirectory().$model->fileCV_Pelamar);
//                                                                   
//                                                                   $thumb->create($fullImgSource)
//                                                                         ->resize(200,200)
//                                                                         ->save($fullThumbSource);
//                                                                   $this->redirect(array('admin'));
//                                                          }
//                                                }
//                                                  
//                                          }else{
//                                              $modelk->photo_karyawan = $model->photopelamar = $tempphoto;
//                                              if($model->validate()){   
//                                                         if($model->save())
//                                                          {
//                                                             $modelk->save();
//                                                                   $this->redirect(array('admin'));
//                                                          }
//                                                }
//                                          } 
//                                      
//		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
                public function actionUpdateCalonKaryawan($id)
                {
                    $modelp=$this->loadModel($id);                                                                                                                                                                                                        
                                $model = new KKaryawanM;
                                $model->lokasi_id = Params::DEFAULT_LOKASI;
                                $format = new CustomFormat();
                                /*inisialisasi model karyawan yang diisi dari model pelamar*/
                                $model->attributes = $modelp->getAttributes();
                                $model->nama_karyawan = $modelp->nama_pelamar;
                                $model->tempatlahir_karyawan = $modelp->tempatlahir_pelamar;
                                $model->tgllahir_karyawan = $modelp->tgl_lahirpelamar;
                                $model->tglditerima = $modelp->tglditerima;
                                $model->alamat_karyawan = $modelp->alamat_pelamar;
                                $model->nomobile_karyawan = $modelp->nomobile_pelamar;
                                $model->warganegara_karyawan = $modelp->warganegara_pelamar;
                                $model->photo_karyawan = $modelp->photopelamar;
                                $model->agama = $modelp->agama;
                                $model->pelamar_id = $modelp->pelamar_id;
                                
		if(isset($_POST['KKaryawanM']))
		{
                                                $model->unsetAttributes();
                                                $model->attributes=$_POST['KKaryawanM'];
                                                $model->tglditerima = $_POST['tglditerima']; //$format->formatDateForDb($_POST['tglditerima']);
                                                $model->karyawan_aktif = 1;
                                                $model->tgllahir_karyawan = $_POST['tgllahir_karyawan'];
                                                $model->create_user_id = Yii::app()->session['loginpemakai_id'];
                                                $model->create_time = date('Y-m-d H:i:s');
                                                $modelp->tglditerima = $model->tglditerima;
                                                $modelp->tglmulaibekerja = isset($_POST['tglmulaibekerja']) ? $_POST['tglmulaibekerja'] : null;
                                               // $modelp->tgllowongan = $format->formatDbtoDate($modelp->tgllowongan);
                                               // $modelp->Create_Time = $format->formatDbToDateTime($modelp->Create_Time);
//                                                print_r($modelp->tgl_lahirpelamar);exit();
                                               // $modelp->tgl_lahirpelamar = $format->formatDbtoDate($modelp->tgl_lahirpelamar);
//                                                print_r($modelp->tgl_lahirpelamar);exit();
                                            $transaksi = Yii::app()->db->beginTransaction();
//                                            try{
                                                if(!empty($model->photo_karyawan))//Klo User Memasukan Logo
                                                {  
                                                
                                                        $model->photo_karyawan =$random.$model->photo_karyawan;

                                                        Yii::import("ext.EPhpThumb.EPhpThumb");

                                                         $thumb=new EPhpThumb();
                                                         $thumb->init(); // this is needed

                                                         $fullImgName =$model->photo_karyawan;   
                                                         $fullImgSource = Params::pathIconModulDirectory().$fullImgName;
                                                         $fullThumbSource = Params::pathIconModulThumbsDirectory().'kecil_'.$fullImgName;
                                                         if($model->validate()){   
                                                                 if($model->save())
                                                                  {
                                                                           $gambar->saveAs($fullImgSource);
                                                                           $thumb->create($fullImgSource)
                                                                                 ->resize(200,200)
                                                                                 ->save($fullThumbSource);
                                                                           $modelp->karyawan_id = $model->karyawan_id;
                                                                           $modelp->save();
                                                                           $transaksi->commit();
                                                                           $this->redirect(array('admin'));
                                                                  }
                                                        }
                                                  
                                              }else{
                                                        $model->photo_karyawan = $modelp->photopelamar;
                                                       
                                                        if($model->validate()){
//                                                         print_r($model->attributes);exit();
                                                            
                                                            if($model->save()){
                                                                    $modelp->karyawan_id = $model->karyawan_id;
                                                                    $modelp->save();
                                                                    $transaksi->commit();
                                                                    $this->redirect(array('admin'));

                                                             }
                                                      }
                                              }
                                              
                                        //}catch(Exception $e){
                                               // $transaksi->rollback();
                                           // }
		}
                               
		$this->render('updatekaryawan',array(
			'model'=>$model,
                        'modelp'=>$modelp,
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
			$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('KPelamarT');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KPelamarT('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KPelamarT']))
			$model->attributes=$_GET['KPelamarT'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=KPelamarT::model()->findByPk($id);
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='kpelamar-t-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
	}
                
                
        public function actionPrint()
        {
            $model= new KPelamarT('searchPrint');
            $model->unsetAttributes();
                    //        $model->tglpengambilan = date($model->tglpengambilan);
                    //        $model->tglAkhir = date($model->tglAkhir);
                    if (isset($_GET['KPelamarT']))
                        $model->attributes = $_GET['KPelamarT'];
            $judulLaporan='Data Pelamar';
            $caraPrint=$_REQUEST['caraPrint'];
            if($caraPrint=='PRINT') {
                $this->layout='//layouts/printWindows';
                $this->render('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
            }
            else if($caraPrint=='EXCEL') {
                $this->layout='//layouts/printExcel';
                $this->render('Print',array('model'=>$model,'judulLaporan'=>$judulLaporan,'caraPrint'=>$caraPrint));
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
        public function actionSetKab()
         {
            $data=  KabupatenkotaM::model()->findAllByAttributes(array('provinsi_id'=>$_POST['haha']));
            $data=CHtml::listData($data,'kabupatenkota_id','kabupatenkota_nama');
            foreach($data as $value=>$name)
            {
                  echo CHtml::tag('option',
                  array('value'=>$value),CHtml::encode($name),true);
            }
         }
                
}
