<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KMutasiR extends MutasiR{

   public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
     public function relations(){
        
        return array(
            'jenissurat'=>array(self::BELONGS_TO, 'JenissuratM', 'jenissurat_id'),
            'suratelektronik'=>array(self::BELONGS_TO, 'SuratelektronikR', 'suratelektroni_id'),
            'karyawan'=>array(self::BELONGS_TO, 'KaryawanM', 'karyawan_id'),
        );
    }
    
    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'mengetahui' =>'Mengetahui',
                        'jenissurat_nama' => 'Nama Jenis Surat',
                        'jenissurat_judul' => 'Perihal Surat',
			'mutasi_id' => 'ID Mutasi',
			'karyawan_id' => 'ID Karyawan',
			'mutasi_nomorsurat' => 'Nomor Surat',
			'tglmutasi' => 'Tgl. Mutasi',
			'departementawal' => 'Departement Awal',
			'subdepartementawal' => 'Sub Departement Awal',
			'jabatanawal' => 'Jabatan Awal',
			'lokasiawal' => 'Lokasi Awal',
			'departementtujuan' => 'Departement Tujuan',
			'subdepartementtujuan' => 'Sub Departement Tujuan',
			'jabatantujuan' => 'Jabatan Tujuan',
			'lokasitujuan' => 'Lokasi Tujuan',
			'keterangan_mutasi' => 'Keterangan Mutasi',
                        'tglsurat' =>'Tgl Surat',
                        'jmlprint'=> 'Jumlah Print',
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

		$criteria->compare('mutasi_id',$this->mutasi_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('mutasi_nomorsurat',$this->mutasi_nomorsurat,true);
		$criteria->compare('tglmutasi',$this->tglmutasi,true);
		$criteria->compare('departementawal',$this->departementawal,true);
		$criteria->compare('subdepartementawal',$this->subdepartementawal,true);
		$criteria->compare('jabatanawal',$this->jabatanawal,true);
		$criteria->compare('lokasiawal',$this->lokasiawal,true);
		$criteria->compare('departementtujuan',$this->departementtujuan,true);
		$criteria->compare('subdepartementtujuan',$this->subdepartementtujuan,true);
		$criteria->compare('jabatantujuan',$this->jabatantujuan,true);
		$criteria->compare('lokasitujuan',$this->lokasitujuan,true);
		$criteria->compare('keterangan_mutasi',$this->keterangan_mutasi,true);
                $criteria->compare('tglsurat', $this->tglsurat, true);
                $criteria->compare('jmlprint', $this->jmlprint, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave(){
            if($this->tglmutasi == ''){
                $this->tglmutasi = null;
            }
            return parent::beforeSave();
        }
}

?>
