<?php

class KKaryawanM extends KaryawanM {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function relations() {
        return array(
            'kabupatenkota'=>array(self::BELONGS_TO, 'KabupatenkotaM', 'kabupatenkota_id'),
            'golongan' => array(self::BELONGS_TO, 'GolonganM', 'golongan_id'),
            'lokasi' => array(self::BELONGS_TO, 'LokasiM', 'lokasi_id'),
            'jabatan' => array(self::BELONGS_TO, 'JabatanM', 'jabatan_id'),
            'pelamar' => array(self::BELONGS_TO, 'PelamarT', 'pelamar_id'),
            'pendidikan' => array(self::BELONGS_TO, 'PendidikanM', 'pendidikan_id'),
            'departement' => array(self::BELONGS_TO, 'DepartementM', 'departement_id'),
            'subdepartement' => array(self::BELONGS_TO, 'SubdepartementM', 'subdepartement_id'),
            'jurusan' => array(self::BELONGS_TO, 'JurusanM', 'jurusan_id'),
            'propinsi' => array(self::BELONGS_TO, 'PropinsiM', 'propinsi_id'),
            'jenissurat'=>array(self::BELONGS_TO, 'JenissuratM', 'jenissurat_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'karyawan_id' => 'Karyawan',
            'kabupatenkota_id' => 'Kabupaten/Kota',
            'golongan_id' => 'Golongan',
            'lokasi_id' => 'Lokasi',
            'jabatan_id' => 'Jabatan',
            'pelamar_id' => 'Pelamar',
            'pendidikan_id' => 'Pendidikan',
            'subdepartement_id' => 'Sub Departement',
            'departement_id' => 'Departement',
            'jurusan_id' => 'Jurusan',
            'propinsi_id' => 'Propinsi',
            'tglditerima' => 'Tgl Diterima',
            'nomorindukkaryawan' => 'Nomor Induk Karyawan',
            'npwp' => 'Npwp',
            'jenisidentitas' => 'Jenis Identitas',
            'noidentitas' => 'No Identitas',
            'gelardepan' => 'Gelar Depan',
            'nama_karyawan' => 'Nama Karyawan',
            'nama_keluarga' => 'Nama Keluarga',
            'gelarbelakang' => 'Gelar Belakang',
            'tempatlahir_karyawan' => 'Tempat Lahir Karyawan',
            'tgllahir_karyawan' => 'Tgl Lahir Karyawan',
            'jeniskelamin' => 'Jenis Kelamin',
            'statusperkawinan' => 'Status Perkawinan',
            'jmlanak' => 'Jumlah Anak',
            'alamat_karyawan' => 'Alamat Karyawan',
            'kodepos' => 'Kodepos',
            'agama' => 'Agama',
            'golongandarah' => 'Golongan Darah',
            'rhesus' => 'Rhesus',
            'alamatemail' => 'Alamat Email',
            'nomobile_karyawan' => 'No Mobile Karyawan',
            'notelp_karyawan' => 'No Telp Karyawan',
            'warganegara_karyawan' => 'Warga Negara Karyawan',
            'kategorikaryawan' => 'Kategori Karyawan',
            'no_jamsostek' => 'No Jamsostek',
            'photo_karyawan' => 'Photo Karyawan',
            'namabank' => 'Nama Bank',
            'norekeningbank' => 'No Rekening Bank',
            'tglkeluar' => 'Tgl Keluar',
            'pphditanggungperusahaan' => 'Pph',
            'no_fingerprint' => 'No Fingerprint',
            'karyawan_aktif' => 'Karyawan Aktif',
            'create_time' => 'Create Time',
            'create_user_id' => 'Create User',
            'jenissurat_id' => 'Id Jenis Surat',
            'jenissurat_nama' => 'Nama Jenis Surat',
            'karyawanberhenti_id'=>'Karyawan Berhenti',
        );
    }

    public function search() {
       $criteria=new CDbCriteria;
                
                $criteria->compare('karyawanberhenti_id', $this->karyawanberhenti_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('kabupatenkota_id',$this->kabupatenkota_id);
		$criteria->compare('golongan_id',$this->golongan_id);
		$criteria->compare('lokasi_id',$this->lokasi_id);
		$criteria->compare('jabatan_id',$this->jabatan_id);
		$criteria->compare('pelamar_id',$this->pelamar_id);
		$criteria->compare('pendidikan_id',$this->pendidikan_id);
		$criteria->compare('subdepartement_id',$this->subdepartement_id);
		$criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('jurusan_id',$this->jurusan_id);
		$criteria->compare('propinsi_id',$this->propinsi_id);
		$criteria->compare('tglditerima',$this->tglditerima,true);
		$criteria->compare('nomorindukkaryawan',$this->nomorindukkaryawan,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('jenisidentitas',$this->jenisidentitas,true);
		$criteria->compare('noidentitas',$this->noidentitas,true);
		$criteria->compare('gelardepan',$this->gelardepan,true);
		$criteria->compare('LOWER(nama_karyawan)',strtolower($this->nama_karyawan),true);
		$criteria->compare('nama_keluarga',$this->nama_keluarga,true);
		$criteria->compare('gelarbelakang',$this->gelarbelakang,true);
		$criteria->compare('tempatlahir_karyawan',$this->tempatlahir_karyawan,true);
		$criteria->compare('tgllahir_karyawan',$this->tgllahir_karyawan,true);
		$criteria->compare('jeniskelamin',$this->jeniskelamin,true);
		$criteria->compare('statusperkawinan',$this->statusperkawinan,true);
		$criteria->compare('jmlanak',$this->jmlanak);
		$criteria->compare('alamat_karyawan',$this->alamat_karyawan,true);
		$criteria->compare('kodepos',$this->kodepos,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('golongandarah',$this->golongandarah,true);
		$criteria->compare('rhesus',$this->rhesus,true);
		$criteria->compare('alamatemail',$this->alamatemail,true);
		$criteria->compare('nomobile_karyawan',$this->nomobile_karyawan,true);
		$criteria->compare('notelp_karyawan',$this->notelp_karyawan,true);
		$criteria->compare('warganegara_karyawan',$this->warganegara_karyawan,true);
		$criteria->compare('kategorikaryawan',$this->kategorikaryawan,true);
		$criteria->compare('no_jamsostek',$this->no_jamsostek,true);
		$criteria->compare('photo_karyawan',$this->photo_karyawan,true);
		$criteria->compare('namabank',$this->namabank,true);
		$criteria->compare('norekeningbank',$this->norekeningbank,true);
		$criteria->compare('tglkeluar',$this->tglkeluar,true);
		$criteria->compare('pphditanggungperusahaan',$this->pphditanggungperusahaan);
		$criteria->compare('no_fingerprint',$this->no_fingerprint,true);
		$criteria->compare('karyawan_aktif',$this->karyawan_aktif);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
                $criteria->order="nama_karyawan ASC";
                $criteria->addInCondition("karyawanberhenti_id", array(NULL));
                
                    return new CActiveDataProvider($this, array(
                                'criteria' => $criteria,
                            ));
    }
   public function beforeSave(){
            if($this->tgllahir_karyawan == ''){
                $this->tgllahir_karyawan = null;
            }
            if($this->tglditerima == ''){
                $this->tglditerima = null;
            }
            if($this->tglkeluar == ''){
                $this->tglkeluar = null;
            }
           if($this->create_time == ''){
                $this->create_time = null;
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
