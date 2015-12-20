<?php

class PresensiTController extends Controller
{
        public $accordionIndx = Params::ACCORDION_PEGAWAI;
        public $IP = Params::IP_FINGER_PRINT;
        public $Key = Params::KEY_FINGER_PRINT;
         
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
				'actions'=>array('index','view','create','update','admin','delete','print', 'ambilData'),
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
		$model=new KPresensiT;
        $modKaryawan = new KaryawanM();
        $model->tglpresensi = date('Y-m-d');
        $model->jampresensi = gmdate("H:i:s", time()+60*60*7);
        $model->create_time = date('Y-m-d H:i:s');
		if(isset($_POST['KPresensiT']))
		{
                    $model->attributes=$_POST['KPresensiT'];
                    $model->user_id = Yii::app()->user->id;
                    $modKaryawan = KaryawanM::model()->findByPk($model->karyawan_id);
                    $jam_presensi = isset($_POST['KPresensiT']['jampresensi']) ? $_POST['KPresensiT']['jampresensi'] : date('H:i:s');
                    if ($model->validate()){
                        
                        $model->tglpresensi = $_POST['KPresensiT']['tglpresensi'].' '.$jam_presensi;
                        if ($model->save()){
                            $this->redirect(array('admin','id'=>$model->presensi_id));
                        }
                    }
		}

		$this->render('create',array(
			'model'=>$model, 'modKaryawan'=>$modKaryawan,
		));
	}
        
        public function actionAmbilData(){
            if (Yii::app()->request->isAjaxRequest){
                $result = $this->retrieveData();
                if (is_array($result)){
                    $insert = $this->insertPerdetik($result);
                    if ($insert == true){
                        $this->deleteAllData();
                    }
                }
                echo AturpresensiM::getStatusAutoRefresh();
                Yii::app()->end();
            }
        }
        
        protected function retrieveData(){
            
            $Connect = fsockopen($this->IP, "80", $errno, $errstr, 1);
            
            if($Connect){
                $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$this->Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
                $newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
                $buffer="";
                while($Response=fgets($Connect, 1024)){
                        $buffer=$buffer.$Response;
                }
                $buffer=$this->ParseData($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
                $buffer=explode("\r\n",$buffer);
                
                $result = array();
                for($a=0;$a<count($buffer);$a++){
                    $data=$this->ParseData($buffer[$a],"<Row>","</Row>");
                    $hasil = $this->ParseData($data,"<PIN>","</PIN>");
                    if (!empty($hasil)){
                        $result[$a]['pin']=$this->ParseData($data,"<PIN>","</PIN>");
                        $result[$a]['date']=$this->ParseData($data,"<DateTime>","</DateTime>");
                        $result[$a]['verified']=$this->ParseData($data,"<Verified>","</Verified>");
                        $result[$a]['status']=$this->ParseData($data,"<Status>","</Status>");
                    }
                }
                if (count($result) == 0){
                    $result = false;
                }
                return $result;
            }else{
                return false;
            }
        }
        
        protected function insertPerdetik($result){
//            $data = $this->retrieveData();
            if (count($result) > 0){
                $transaction = Yii::app()->db->beginTransaction();
                $user_id = Yii::app()->user->id;
                try{
                    $counter = 0;
                    $jumlah = 0;
                    foreach ($result as $i=>$row){
                        $karyawan = KaryawanM::model()->findByAttributes(array('no_fingerprint'=>$row['pin']));
                        if (count($karyawan) == 1){
                            $jumlah++;
                            $model = new PresensiT();
                            $model->tglpresensi = $row['date'];
                            $model->no_fingerprint = $row['pin'];
                            $model->statusscan_id = $row['status']+1;
//                            $model->verifikasi = $row['verified'];
                            $model->karyawan_id = $karyawan->karyawan_id;
                            $model->create_time = date('Y-m-d H:i:s');
                            $model->statuskehadiran_id = 1;
                            $model->user_id = $user_id;
                            if ($model->save()){
                                $counter++;
                            }
                        }
                    }
                    if (($jumlah == $counter) && ($counter != 0)){
                        $transaction->commit();
                        return true;
                    }
                    else{
                        throw new Exception("Gagal");
                    }
                } catch(Exception $ex){
                    return false;
                }
            }
        }
        
        protected function deleteAllData() {
            $Connect = fsockopen($this->IP, "80", $errno, $errstr, 1);
            if ($Connect) {
                $soap_request = "<ClearData><ArgComKey xsi:type=\"xsd:integer\">" . $this->Key . "</ArgComKey><Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg></ClearData>";
                $newLine = "\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0" . $newLine);
                fputs($Connect, "Content-Type: text/xml" . $newLine);
                fputs($Connect, "Content-Length: " . strlen($soap_request) . $newLine . $newLine);
                fputs($Connect, $soap_request . $newLine);
                $buffer = "";
                while ($Response = fgets($Connect, 1024)) {
                    $buffer = $buffer . $Response;
                }
            }else
                echo "Koneksi Gagal";

            $buffer = $this->ParseData($buffer, "<Information>", "</Information>");

            echo $buffer;
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KPresensiT']))
		{
			$model->attributes=$_POST['KPresensiT'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->presensi_id));
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
		$dataProvider=new CActiveDataProvider('KPresensiT');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KPresensiT('search');
                $model->tglAwal = date('Y-m-d 00:00:00');
                $model->tglAkhir = date('Y-m-d 23:59:59');

		if(isset($_GET['KPresensiT']))
			$model->attributes=$_GET['KPresensiT'];

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
		$model=KPresensiT::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='kpresensi-t-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                
                
                public function actionPrint()
                {
                    $model= new KPresensiT;
                    $model->attributes=$_REQUEST['KPresensiT'];
                    $judulLaporan='Laporan Kelompok Menu';
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
}
