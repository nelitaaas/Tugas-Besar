<?php

class KPelamarT extends PelamarT
{
    
     public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }
    
     public function relations(){
         
         return array(
               'departement'=>array(self::BELONGS_TO, 'DepartementM', 'departement_id'),
               'jabatan'=>array(self::BELONGS_TO, 'JabatanM', 'jabatan_id'),
               'kabupatenkota'=>array(self::BELONGS_TO, 'KabupatenkotaM', 'kabupatenkota_id'),
               'propinsi'=>array(self::BELONGS_TO, 'PropinsiM', 'propinsi_id'),
               
               
         );
     }
     public function attributeLabels()
	{
		return array(
			'pelamar_id' => 'ID Pelamar',
			'departement_id' => 'Departement',
			'pendidikan_id' => 'Pendidikan',
			'propinsi_id' => 'Propinsi',
			'karyawan_id' => 'Karyawan',
			'kabupatenkota_id' => 'Kota / Kabupaten',
			'jabatan_id' => 'Jabatan',
			'jurusan_id' => 'Jurusan',
			'tgllowongan' => 'Tanggal Lowongan',
			'jenisidentitas' => 'Jenis Identitas',
			'noidentitas' => 'Nomor Identitas',
			'nama_pelamar' => 'Nama Pelamar',
			'nama_keluarga' => 'Nama Keluarga',
			'tempatlahir_pelamar' => 'Tempat Lahir',
			'tgl_lahirpelamar' => 'Tanggal Lahir',
			'jeniskelamin' => 'Jenis Kelamin',
			'statusperkawinan' => 'Status Perkawinan',
			'jmlanak' => 'Jumlah Anak',
			'alamat_pelamar' => 'Alamat Pelamar',
			'kodepos' => 'Kode Pos',
			'agama' => 'Agama',
			'alamatemail' => 'E-mail',
			'notelp_karyawan' => 'Nomor Telp',
			'nomobile_pelamar' => 'Nomor Mobile',
			'warganegara_pelamar' => 'Warga Negara ',
			'photopelamar' => 'Photo Pelamar',
			'gajiygdiharapkan' => 'Gaji yang diharapkan',
			'tglditerima' => 'Tgl Diterima',
			'tglmulaibekerja' => 'Tgl Mulai Bekerja',
			'keterangan_pelamar' => 'Keterangan ',
			'karyawan_aktif' => 'Aktif',
                        'create_time'=> 'Create Time',
		);
	}   
        
        public function search()
        {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

//		$criteria->compare('pelamar_id',$this->pelamar_id);
//		
//		$criteria->compare('pendidikan_id',$this->pendidikan_id);
		$criteria->compare('propinsi_id',$this->propinsi_id);
//		$criteria->compare('karyawan_id',$this->karyawan_id);
        	$criteria->compare('kabupatenkota_id',$this->kabupatenkota_id);
//		$criteria->compare('jabatan_id',$this->jabatan_id);
//		$criteria->compare('jurusan_id',$this->jurusan_id);
//		$criteria->compare('tgllowongan',$this->tgllowongan,true);
//		$criteria->compare('jenisidentitas',$this->jenisidentitas,true);
                $criteria->compare('LOWER(nama_pelamar)',strtolower($this->nama_pelamar),true);
		$criteria->compare('noidentitas',$this->noidentitas,true);
                                $criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('jabatan_id',$this->jabatan_id);
                                $criteria->compare('alamat_pelamar',$this->alamat_pelamar,true);
                                $criteria->compare('tglditerima',null);
		$criteria->compare('tglmulaibekerja',null);
                                
		$criteria->compare('nama_keluarga',$this->nama_keluarga,true);
		$criteria->compare('tempatlahir_pelamar',$this->tempatlahir_pelamar,true);
		$criteria->compare('tgl_lahirpelamar',$this->tgl_lahirpelamar,true);
		$criteria->compare('LOWER(jeniskelamin)',strtolower($this->jeniskelamin),true);
		$criteria->compare('statusperkawinan',$this->statusperkawinan,true);
		$criteria->compare('jmlanak',$this->jmlanak);
		
		$criteria->compare('kodepos',$this->kodepos,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('alamatemail',$this->alamatemail,true);
		$criteria->compare('notelp_karyawan',$this->notelp_karyawan,true);
		$criteria->compare('nomobile_pelamar',$this->nomobile_pelamar,true);
		$criteria->compare('warganegara_pelamar',$this->warganegara_pelamar,true);
		$criteria->compare('photopelamar',$this->photopelamar,true);
		$criteria->compare('gajiygdiharapkan',$this->gajiygdiharapkan);
		
		$criteria->compare('keterangan_pelamar',$this->keterangan_pelamar,true);
		$criteria->compare('karyawan_aktif',$this->karyawan_aktif);
		$criteria->compare('Create_Time',$this->Create_Time,true);
		$criteria->compare('Create_User_Id',$this->Create_User_Id);
		$criteria->compare('fileCV_Pelamar',$this->fileCV_Pelamar,true);
                $criteria->compare('kabupatenkota_nama', $this->kabupatenkota_nama);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        
         public function beforeSave(){
            if($this->tgl_lahirpelamar == ''){
                $this->tgl_lahirpelamar = null;
            }
            if($this->tglditerima == ''){
                $this->tglditerima = null;
            }
            if($this->tgllowongan == ''){
                $this->tgllowongan = null;
            }
            if($this->tglmulaibekerja == ''){
                $this->tglmulaibekerja = null;
            }
           if($this->Create_Time == ''){
                $this->Create_Time = null;
            }
            if($this->Create_User_Id == '')
            {
                $this->Create_User_Id = null;
            }
            return parent::beforeSave();
        }
        
        public function getPropinsiItems()
        {
            return PropinsiM::model()->findAllByAttributes(array('propinsi_aktif'=>true),array('order'=>'propinsi_nama'));
        }
        
        /**
         * Mengambil daftar semua kabupaten berdasarkan propinsi
         * @return CActiveDataProvider 
         */
        public function getKabupatenItems($propinsi_id=null)
        {
            if(!empty($propinsi_id))
                return KabupatenkotaM::model()->findAllByAttributes(array('propinsi_id'=>$propinsi_id,'kabupatenkota_aktif'=>true),array('order'=>'kabupatenkota_nama'));
            else {
                return array();
            }
        }
}
?>
