<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KKontrakkaryawanR extends KontrakkaryawanR{

    public static function model($className=__CLASS__)
     {
                return parent::model($className);
     }
     
     public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'jenissurat'=>array(self::BELONGS_TO, 'JenissuratM', 'jenissurat_id'),
                    'suratelektronik'=>array(self::BELONGS_TO, 'SuratelektronikR', 'suratelektronik_id'),
                    'karyawan'=>array(self::BELONGS_TO, 'KaryawanM', 'karyawan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kontrakkaryawan_id' => 'Kontrak Karyawan',
			'karyawan_id' => 'Karyawan',
			'jabatan_id' => 'Jabatan',
			'subdepartement_id' => 'Sub Departement',
			'departement_id' => 'Departement',
			'nosuratkontrak' => 'No. Surat Kontrak',
			'tglkontrak' => 'Tgl. Kontrak',
			'nourutkontrak' => 'No. Urut Kontrak',
			'tglmulaikontrak' => 'Tgl Mulai Kontrak',
			'tglakhirkontrak' => 'Tgl Akhir Kontrak',
			'lamakontrak' => 'Lama Kontrak',
			'keterangankontrak' => 'Keterangan Kontrak',
                        'jenissurat_id' => 'Id Jenis Surat',
                        'jenissurat_nama' => 'Nama Jenis Surat',
                        'jenissurat_judul'=>'Perihal',
                        'mengetahui' => 'Mengetahui',
                        'jmlprint'=>'Jumlah Print',
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

                $criteria->compare('jenissurat_id', $this->jenissurat_id);
                $criteria->compare('jenissurat_nama', $this->jenissurat_nama);
                $criteria->compare('jenissurat_judul', $this->jenissurat_judul);
                $criteria->compare('mengetahui', $this->mengetahui);
		$criteria->compare('kontrakkaryawan_id',$this->kontrakkaryawan_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('jabatan_id',$this->jabatan_id);
		$criteria->compare('subdepartement_id',$this->subdepartement_id);
		$criteria->compare('departement_id',$this->departement_id);
		$criteria->compare('nosuratkontrak',$this->nosuratkontrak,true);
		$criteria->compare('tglkontrak',$this->tglkontrak,true);
		$criteria->compare('nourutkontrak',$this->nourutkontrak);
		$criteria->compare('tglmulaikontrak',$this->tglmulaikontrak,true);
		$criteria->compare('tglakhirkontrak',$this->tglakhirkontrak,true);
		$criteria->compare('lamakontrak',$this->lamakontrak,true);
		$criteria->compare('keterangankontrak',$this->keterangankontrak,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
              /*  public function beforeSave(){
                    $format = new CustomFormat();
                    //$this->tglrevisimodul = $format->formatDateMediumForDB($this->tglrevisimodul);
                    foreach($this->metadata->tableSchema->columns as $columnName => $column){
                            if ($column->dbType == 'date' && (!empty($this->columnName))){
                                    $this->$columnName = $format->formatDateForDb($this->$columnName);
                            }elseif ($column->dbType == 'timestamp without time zone' && (!empty($this->$columnName))){

                                    $this->$columnName = $format->formatDateTimeforDb($this->$columnName);
                                                         // print_r($this->$columnName);exit();
                            }
                    }

                    return parent::beforeSave();
                }*/
         public function beforeSave(){
            if($this->tglkontrak == ''){
                $this->tglkontrak = null;
            }
            if($this->tglmulaikontrak == ''){
                $this->tglmulaikontrak = null;
            }
            if($this->tglakhirkontrak == ''){
                $this->tglakhirkontrak = null;
            }
            return parent::beforeSave();
        }

}

?>
