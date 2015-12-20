<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KPendidikankaryawanR extends PendidikankaryawanR{

   public static function model($className=__CLASS__)
    {
                return parent::model($className);
    }
    
    public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'kabupatenkota'=>array(self::BELONGS_TO, 'KabupatenkotaM', 'kabupatenkota_id'),
                    'propinsi'=>array(self::BELONGS_TO, 'PropinsiM', 'propinsi_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pendidikankaryawan_id' => 'Pendidikan Karyawan',
			'karyawan_id' => 'Karyawan',
			'jenispendidikan' => 'Jenis Pendidikan',
			'pendidikankaryawan_nourut' => 'No. Urut Pendidikan Karyawan',
			'pendidikankaryawan_nama' => 'Nama Pendidikan Karyawan',
			'pendidikankaryawan_alamat' => 'Alamat Pendidikan Karyawan',
			'pendidikan_nama' => 'Nama Pendidikan',
			'jurusan_nama' => 'Nama Jurusan',
			'propinsi_nama' => 'Propinsi',
			'kabupatenkota_nama' => 'Kota / Kabupaten',
			'fakultas' => 'Fakultas',
			'tglmasuk' => 'Tgl. Masuk',
			'tgllulus' => 'Tgl. Lulus',
			'lamapendidikan' => 'Lama Pendidikan',
			'no_ijazah' => 'No. Ijazah',
			'tgl_ijazah' => 'Tgl. Ijazah',
			'ttd_ijazah' => 'Ttd. Ijazah',
			'nilai_ipk' => 'Nilai IPK',
			'gradelulus' => 'Grade Lulus',
			'keterangan' => 'Keterangan',
                        'kabupatenkota_id' => 'Kabupaten Kota',
                        'propinsi_id'=>'Propinsi'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                $criteria->compare('kabupatenkota_id', $this->kabupatenkota_id);
                $criteria->compare('propinsi_id'. $this->propinsi_id);
		$criteria->compare('pendidikankaryawan_id',$this->pendidikankaryawan_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('jenispendidikan',$this->jenispendidikan,true);
		$criteria->compare('pendidikankaryawan_nourut',$this->pendidikankaryawan_nourut);
		$criteria->compare('pendidikankaryawan_nama',$this->pendidikankaryawan_nama,true);
		$criteria->compare('pendidikankaryawan_alamat',$this->pendidikankaryawan_alamat,true);
		$criteria->compare('pendidikan_nama',$this->pendidikan_nama,true);
		$criteria->compare('jurusan_nama',$this->jurusan_nama,true);
		$criteria->compare('propinsi_nama',$this->propinsi_nama,true);
		$criteria->compare('kabupatenkota_nama',$this->kabupatenkota_nama,true);
		$criteria->compare('fakultas',$this->fakultas,true);
		$criteria->compare('tglmasuk',$this->tglmasuk,true);
		$criteria->compare('tgllulus',$this->tgllulus,true);
		$criteria->compare('lamapendidikan',$this->lamapendidikan,true);
		$criteria->compare('no_ijazah',$this->no_ijazah,true);
		$criteria->compare('tgl_ijazah',$this->tgl_ijazah,true);
		$criteria->compare('ttd_ijazah',$this->ttd_ijazah,true);
		$criteria->compare('nilai_ipk',$this->nilai_ipk,true);
		$criteria->compare('gradelulus',$this->gradelulus,true);
		$criteria->compare('keterangan',$this->keterangan,true);
                $criteria->compare('kabupatenkota_id', $this->kabupatenkota_id, true);
                $criteria->compare('propinsi_id', $this->propinsi_id, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
        public function beforeSave(){
            if($this->tglmasuk == ''){
                $this->tglmasuk = null;
            }
            if($this->tgllulus == ''){
                $this->tgllulus = null;
            }
            if($this->tgl_ijazah == ''){
                $this->tgl_ijazah = null;
            }
            
            return parent::beforeSave();
        }
}

?>
